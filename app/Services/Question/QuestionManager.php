<?php 

namespace App\Services\Question;

use App\Models\Language;
use App\Models\Phrase;
use App\Models\User;

class QuestionManager 
{
    private function generatePhrases (Language $language, $size)
    {
        return Phrase::inRandomOrder()->where("language_id", $language->id)->limit($size)->get();
    }

    public function generateQuestions (Language $language, User $user, $size = 10)
    {
        $languages = $user->languages()->get();
        $phrases = $this->generatePhrases($language, $size);

        $questions = [];
        foreach ($phrases as $phrase) 
        {
            $batchId = $phrase->batch_id;

            foreach ($languages as $userLanguage) 
            {
                $relatedPhrasesCollection = Phrase::where("language_id", $userLanguage->id)->where("batch_id", $batchId)->get();
                foreach ($relatedPhrasesCollection as $relatedPhrase)
                {
                    $questions[count($questions)] = [
                        "phrase" => $relatedPhrase->phrase,
                        "language_name" => Language::find($relatedPhrase->language_id)->name,
                        "question" => "Write '" . $relatedPhrase->phrase . "' in English"
                    ];
                }
            }
        }

        return $questions;
    }
}