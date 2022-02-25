<?php

namespace App\Http\Controllers;

use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;

use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    private $textToSpeechClient;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('test');
    }

    public function __construct ()
    {
        // https://cloud.google.com/text-to-speech/docs/voices
        // https://cloud.google.com/text-to-speech/docs/reference/rpc/google.cloud.texttospeech.v1
        
        putenv('GOOGLE_APPLICATION_CREDENTIALS=/Users/danstoakes/Projects/dual-language-learning-700e1339570b.json');

        $this->textToSpeechClient = new TextToSpeechClient();

        $this->generateSample("Hej, jag heter Dan och jag bor i Sverige med mina föräldrar", "swedish");
        $this->generateSample("Hallo, ich heiße Dan und lebe mit meiner Schwester in Deutschland.", "german");

        // $this->generateSample("こんにちは私はケイトですそして私はシュレックに恋をしています", "japanese");
    }

    public function generateSample ($content, $language) 
    {
        $input = new SynthesisInput();
        $input->setText($content);

        $voice = new VoiceSelectionParams();
        if ($language == "swedish") 
        {
            $this->configureSwedish($voice);
        } else if ($language == "german")
        {
            $this->configureGerman($voice);
        } else {
            $this->configureJapanese($voice);
        }

        $audioConfig = new AudioConfig();
        $audioConfig->setAudioEncoding(AudioEncoding::MP3);

        $resp = $this->textToSpeechClient->synthesizeSpeech($input, $voice, $audioConfig);

        Storage::put("" . rand(0, 99999) . ".mp3", $resp->getAudioContent());

        // Storage::disk('public')->put("" . rand(0, 99999) . ".mp3", $resp->getAudioContent());
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

    public function configureJapanese ($voice) 
    {
        $voice->setLanguageCode("ja-JP");
        $voice->setName("ja-JP-Wavenet-A"); // A, B
        $voice->setSSMLGender(0);
    }
}
