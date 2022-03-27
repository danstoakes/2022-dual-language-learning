<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Module;
use App\Models\Phrase;
use App\Rules\HasSVGTag;
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
         $this->middleware('permission:module-list|module-create|module-edit|module-delete', ['only' => ['index','store']]);
         $this->middleware('permission:module-create', ['only' => ['create', 'store']]);
         $this->middleware('permission:module-edit', ['only' => ['edit', 'update']]);
         $this->middleware('permission:module-delete', ['only' => ['destroy']]);
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

    private function getDefaultIconSVG () 
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 14l9-5-9-5-9 5 9 5z" /><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" /></svg>';
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
            'description' => 'required|max:1024',
            'icon_svg' => new HasSVGTag,
        ]);

        if (!isset($request->icon_svg))
            $request->merge(['icon_svg' => $this->getDefaultIconSVG()]);
    
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
        $phrases = $module->phrases()->where('language_id', $module->language_id)->paginate(10);

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
            'description' => 'required|max:1024',
            'icon_svg' => new HasSVGTag,
        ]);

        if (!isset($request->icon_svg))
            $request->merge(['icon_svg' => $this->getDefaultIconSVG()]);

        $module = Module::find($id);
        $module->name = $request->input('name');
        $module->description = $request->input('description');
        $module->icon_svg = $request->input('icon_svg');
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
        $module = Module::find($id);
        $languageId = $module->language_id;

        $module->delete();
        
        return redirect()->route('languages.show', $languageId)
            ->with('success', 'Module deleted successfully');
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
