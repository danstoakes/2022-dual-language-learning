<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

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
}
