<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Phrase;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class AJAXController extends Controller
{     
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function POST (Request $request)
    {
        if ($request->ajax()) 
        {
            if ($request->module_id != -1) 
            {
                $module = Module::find($request->module_id);
                $modulePhraseIds = $module->phrases->pluck("id")->toArray();
    
                if ($request->batch_id) 
                {
                    $batch_Ids = $request->batch_id;
    
                    $selectedPhrases = [];
                    foreach ($batch_Ids as $batchId) 
                    {
                        $selectedPhraseIds = Phrase::where("batch_id", $batchId)->pluck("id")->toArray() ?? [];
                        $selectedPhrases = array_merge($selectedPhrases, $selectedPhraseIds);
                    }
    
                    $newPhrases = array_diff($selectedPhrases, $modulePhraseIds);
                    $oldPhrases = array_diff($modulePhraseIds, $selectedPhrases);

                    if (count($newPhrases) > 0) {
                        foreach ($newPhrases as $phrase)
                            $module->phrases()->attach($phrase);

                        Session::flash("success", "Phrase added successfully");
                    } else if (count($oldPhrases) > 0) {
                        foreach ($oldPhrases as $phrase)
                            $module->phrases()->detach($phrase);

                        Session::flash("success", "Phrase removed successfully");
                    }
                } else 
                {
                    foreach ($modulePhraseIds as $phrase)
                        $module->phrases()->detach($phrase);
                    
                    Session::flash("success", "Phrase removed successfully");
                }

                return View::make("partials/popup");
            }
        }

        Session::flash("error", "Module could not be updated");
        return View::make("partials/popup");
    }
}
