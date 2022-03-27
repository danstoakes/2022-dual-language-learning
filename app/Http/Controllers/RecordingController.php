<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Phrase;
use App\Models\Recording;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecordingController extends TextToSpeechController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $limit = 18;
        $recordings = Recording::orderBy('id', 'ASC')->paginate($limit);
        return view('recordings.index', compact('recordings', 'limit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Phrase::orderBy("batch_id", "ASC")
            ->orderBy("language_id", "DESC")->paginate(20);

        $phraseVoices = [];
        foreach ($data as $phraseKey => $phrase) {
            $language = Language::find($phrase->language_id);
            $codes = $language->codes();

            $voices = [];
            foreach ($codes as $key => $code)
                $voices = array_unique(array_merge($voices, $this->listVoices($code)), SORT_REGULAR);

            $phraseVoices[$phrase->id] = [
                "voices" => $voices
            ];
        }

        return view("recordings.create", compact("data"), compact("phraseVoices"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recording  $recording
     * @return \Illuminate\Http\Response
     */
    public function show(Recording $recording)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recording  $recording
     * @return \Illuminate\Http\Response
     */
    public function edit(Recording $recording)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recording  $recording
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recording $recording)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recording  $recording
     * @return \Illuminate\Http\Response
     */
    public function destroy (Recording $recording)
    {
        Storage::delete($recording->path);
        $recording->delete();
        
        return redirect()->route("recordings.create")
            ->with("success", "Recording deleted successfully");
    }

    public function configureSwedish ($voice)
    {
        $voice->setLanguageCode("sv-SE");
        $voice->setName("sv-SE-Wavenet-D"); // A, B, D
        $voice->setSSMLGender(0);
    }

    public function configureGerman ($voice)
    {
        $voice->setLanguageCode("de-DE");
        $voice->setName("de-DE-Wavenet-C"); // A, C, F
        $voice->setSSMLGender(0);
    }

    public function generate(Request $request, Phrase $phrase)
    {
        $this->validate($request, [
            'phrase' => 'language_voice'
        ]);

        $languageCodeComponents = explode('-', $request->language_voice);

        $audio = $this->performTextToSpeech($phrase->phrase, [
            "languageCode" => $languageCodeComponents[0] . '-' . $languageCodeComponents[1],
            "voiceName" => $request->language_voice
        ]);

        $fileName = $request->language_voice . '-' . $phrase->generateSlug() . ".mp3";

        Storage::put($fileName, $audio);

        $recording = $phrase->recordings($request->language_voice);
        if ($recording) {
            if ($recording->path !== Storage::url($fileName))
                Storage::delete($recording->path);
        } else {
            $recording = new Recording;
        }

        $recording->phrase_id = $phrase->id;
        $recording->file_name = $fileName;
        $recording->path = Storage::url($fileName);
        $recording->voice_name = $request->language_voice;
        $recording->save();

        return redirect()->back()
            ->with('success', 'Recording generated successfully!');
    }

    public function getLanguages ()
    {

    }

    public function getVoices () 
    {
        echo "<pre>";
        // perform list voices request

        $response = $this->textToSpeechClient->listVoices([
            'languageCode' => 'sv_SE'
        ]);
        $voices = $response->getVoices();

        foreach ($voices as $voice) {
            // display the voice's name. example: tpc-vocoded
            printf('Name: %s' . PHP_EOL, $voice->getName());

            // display the supported language codes for this voice. example: 'en-US'
            foreach ($voice->getLanguageCodes() as $languageCode) {
                printf('Supported language: %s' . PHP_EOL, $languageCode);
            }

            // SSML voice gender values from TextToSpeech\V1\SsmlVoiceGender
            $ssmlVoiceGender = ['SSML_VOICE_GENDER_UNSPECIFIED', 'MALE', 'FEMALE',
            'NEUTRAL'];

            // display the SSML voice gender
            $gender = $voice->getSsmlGender();
            printf('SSML voice gender: %s' . PHP_EOL, $ssmlVoiceGender[$gender]);

            // display the natural hertz rate for this voice
            printf('Natural Sample Rate Hertz: %d' . PHP_EOL,
            $voice->getNaturalSampleRateHertz());
        }
        echo "</pre>";
    }
}
