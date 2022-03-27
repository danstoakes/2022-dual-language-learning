<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class HomeController extends TextToSpeechController
{
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
            $language->variant_id = $variant->id;

            array_push($languages, $language);
        }

        return view('home', compact('languages', 'variants'));
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

    public function manageLanguage ($languageId, $variantId)
    {
        $language = Language::find($languageId);
        $variant = Region::find($variantId);

        $user = Auth::user();

        $voice = $user->regions()->where('region_id', $variant->id)
            ->pluck('voice')
            ->first();

        $language->currentVoice = $voice;
        $language->voices = $this->listVoices($variant->language_code);

        return view('languages.manage', compact('language', 'variant'));
    }

    public function updateVoice (Request $request, Region $variant)
    {
        if (isset($request->language_voice)) {
            $user = Auth::user();

            $user->regions()->updateExistingPivot($variant->id, [
                'voice' => $request->language_voice
            ]);
        }

        return redirect()->route('home')
            ->with('success', 'Voice updated successfully.');
    }
}
