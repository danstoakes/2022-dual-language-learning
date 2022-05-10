<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Services\Question\QuestionManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    private $questionManager;

    function __construct ()
    {
        $this->questionManager = new QuestionManager();
    }

    public function startQuiz ($languageId)
    {
        $language = Language::find($languageId);
        $user = Auth::user();

        $questions = $this->questionManager->generateQuestions($language, $user, 10);
    }
}
