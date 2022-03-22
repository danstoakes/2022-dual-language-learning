<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Region;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $variants = $user->regions()->get();

        $languages = [];
        foreach ($variants as $variant) {
            $language = Language::find($variant->language_id);
            $language->code = $variant->language_code;

            array_push($languages, $language);
        }

        return view('home', compact('languages'));
    }

    public function addLanguage ()
    {
        $user = Auth::user();
        $variants = $user->regions()->get();

        // get the regions that the user has not worked with
        $regions = Region::whereNotIn('language_code', $variants->pluck('language_code'))->get();

        // get the languages of the regions
        $languageId = $regions->pluck('language_id');
        $supportedLanguages = Language::whereIn('id', $languageId)->get();

        for ($i = 0; $i < count($supportedLanguages); $i++) {
            $existingLanguageCodes = $variants->where('language_id', $supportedLanguages[$i]->id)
                ->pluck('language_code');

            // remove used language codes from languages which still have valid codes left
            $supportedLanguages[$i]->codes = array_diff($supportedLanguages[$i]->codes(), $existingLanguageCodes->toArray());
        }

        return view('languages.create', compact("supportedLanguages"));
    }
}
