<?php 

namespace App\Services\GoogleCloud;

use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;

class TextToSpeech 
{
    private $textToSpeechClient;

    private $voice;

    function __construct ()
    {
        $this->textToSpeechClient = new TextToSpeechClient([
            'credentials' => '/Users/danstoakes/Projects/dual-language-learning-700e1339570b.json'
        ]);
    }

    public function setVoice ($languageCode, $name /*, $gender */) 
    {
        $this->voice = new VoiceSelectionParams();
        $this->voice->setLanguageCode($languageCode);
        $this->voice->setName($name);
        // $this->voice->setSSMLGender($gender);
    }

    public function getVoice ()
    {
        return $this->voice;
    }

    public function getAudioConfig ()
    {
        $audioConfig = new AudioConfig();
        $audioConfig->setAudioEncoding(AudioEncoding::MP3);

        return $audioConfig;
    }

    public function getSynthesisInput ()
    {
        return new SynthesisInput();
    }

    public function getVoices ($languageCode) 
    {
        $response = $this->textToSpeechClient->listVoices([
            'languageCode' => $languageCode
        ]);
        $voices = $response->getVoices();

        $ssmlVoiceGenders = ["Not specified", "Male", "Female", "Neutral"];

        $voiceArray = [];
        foreach ($voices as $key => $voice) {
            $gender = $ssmlVoiceGenders[$voice->getSsmlGender()];

            $voiceArray[$key] = [
                "id" => $voice->getName(),
                "display_name" => $voice->getName() . " (" . $gender . ")",
                "gender" => $gender,
                "gender_id" => $voice->getSsmlGender(),
                "sample_rate" => $voice->getNaturalSampleRateHertz(),
            ];
        }

        return $voiceArray;
    }

    public function synthesizeSpeech ($text)
    {
        return $this->textToSpeechClient->synthesizeSpeech(
            $text, $this->getVoice(), $this->getAudioConfig());
    }
}