<?php

namespace App\Http\Controllers;

use App\Models\Phrase;
use App\Models\Recording;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;

class RecordingController extends Controller
{
    private $textToSpeechClient;
    
    /**
     * Create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:language-list|language-create|language-edit|language-delete', ['only' => ['index','store']]);
        $this->middleware('permission:language-create', ['only' => ['create','store']]);
        $this->middleware('permission:language-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:language-delete', ['only' => ['destroy']]);

        $this->textToSpeechClient = new TextToSpeechClient([
            'credentials' => '/Users/danstoakes/Projects/dual-language-learning-700e1339570b.json'
        ]);
    }

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

        return view("recordings.create", compact("data"));
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

        $phrase = $recording->phrase();
        $phrase->recording_id = null;
        $phrase->save();

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

    public function generate(Phrase $phrase)
    {
        /* $languageSlug = $phrase->getLanguageSlug();

        $input = new SynthesisInput();
        $input->setText($phrase->phrase);

        $voice = new VoiceSelectionParams();
        if ($languageSlug == "swedish") 
        {
            $this->configureSwedish($voice);
        } else if ($languageSlug == "german")
        {
            $this->configureGerman($voice);
        }

        $audioConfig = new AudioConfig();
        $audioConfig->setAudioEncoding(AudioEncoding::MP3);

        $response = $this->textToSpeechClient->synthesizeSpeech($input, $voice, $audioConfig);

        Storage::put($languageSlug . '-' . $phrase->generateSlug() . ".mp3", $response->getAudioContent());

        $recording = $phrase->recording();
        if ($recording) {
            if ($recording->path !== Storage::url($languageSlug . '-' . $phrase->generateSlug() . ".mp3"))
                Storage::delete($recording->path);
        } else {
            $recording = new Recording;
        }

        $recording->file_name = $languageSlug . '-' . $phrase->generateSlug() . ".mp3";
        $recording->path = Storage::url($languageSlug . '-' . $phrase->generateSlug() . ".mp3");
        $recording->save();

        $phrase->recording_id = $recording->id;
        $phrase->save();

        return redirect()->back()
            ->with('success', 'Recording generated successfully!'); */

        $this->getVoices();
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
