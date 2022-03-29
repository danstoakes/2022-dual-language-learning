<?php

namespace App\Http\Controllers;

use App\Services\GoogleCloud\TextToSpeech;

class TextToSpeechController extends Controller
{
    private $textToSpeech;

    public function __construct ()
    {
        $this->middleware('auth');
        
        $this->textToSpeech = new TextToSpeech();
    }

    // pass these in as attributes in the <select>
    public function setVoice ($languageCode, $name /*, $gender */)
    {
    $this->textToSpeech->setVoice($languageCode, $name /*, $gender */);
    }

    private function getSynthesisInput ()
    {
        return $this->textToSpeech->getSynthesisInput();
    }

    public function listVoices ($languageCode)
    {
        return $this->textToSpeech->getVoices($languageCode);
    }

    public function performTextToSpeech ($text, $voiceData = [])
    {
        $input = $this->getSynthesisInput();
        $input->setText($text);

        $this->setVoice(
            $voiceData["languageCode"],
            $voiceData["voiceName"]
        );

        $response = $this->textToSpeech->synthesizeSpeech($input);

        return $response->getAudioContent();
    }
}

?>