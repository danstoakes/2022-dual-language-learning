<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Module;
use App\Models\Phrase;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class ModuleController extends Controller
{
    /**
     * Create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
         $this->middleware('permission:language-list|language-create|language-edit|language-delete', ['only' => ['index','store']]);
         $this->middleware('permission:language-create', ['only' => ['create', 'store']]);
         $this->middleware('permission:language-edit', ['only' => ['edit', 'update']]);
         $this->middleware('permission:language-delete', ['only' => ['destroy']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($languageId)
    {
        return view('modules.create', ['languageId' => $languageId]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required|max:1024'
        ]);
    
        $module = Module::create($request->all());

        if ($module != null)
            return redirect()->route('languages.show', $request->language_id)
                ->with('success', 'Module created successfully.');

        return redirect()->back()->with('error', 'There was a problem creating the module.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $module = Module::find($id);
        $phrases = $module->phrases()->paginate(10);

        return view('modules.show', compact('module'), compact('phrases'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $module = Module::find($id);
        return view('modules.edit', compact('module'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'max:1024',
            'logo' => 'required'
        ]);

        $module = Module::find($id);
        $module->name = $request->input('name');
        $module->description = $request->input('description');
        $module->icon_svg = $request->input('logo');
        $module->save();
        
        return redirect()->route('modules.show', $module->id)
            ->with('success', 'Module updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function managePhrases ($module)
    {
        $phrasesPerPage = count(Language::all()) * 3;

        $data = DB::table("phrases")
            ->select(DB::raw("batch_id, GROUP_CONCAT(DISTINCT phrase SEPARATOR ' <span>|</span> ') as 'phrase'"))
            ->groupBy("batch_id")
            ->get();

        return view("phrases.manage-module-phrases", compact("data", "module"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePhrases (Request $request, $moduleId)
    {
        if ($request->ajax()) 
        {
            if ($moduleId)
            {
                $module = Module::find($moduleId);

                if ($request->batch) {
                    $batchId = $request->batch;
                    $phraseIds = Phrase::where("batch_id", $batchId)->pluck("id")->toArray() ?? [];

                    if (count($phraseIds) > 0) {
                        $isChecked = filter_var($request->isChecked, FILTER_VALIDATE_BOOLEAN);

                        if ($isChecked) {
                            foreach ($phraseIds as $phrase)
                                $module->phrases()->attach($phrase);
                        } else {
                            foreach ($phraseIds as $phrase)
                                $module->phrases()->detach($phrase);
                        }
                    }
                }
            }
        }
        /*         
        Session::flash("error", "Module could not be updated");
        return View::make("partials/popup");
        */
    }
}
