<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Phrase;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;

class PhraseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $phrasesPerPage = count(Language::all()) * 3;

        $data = Phrase::orderBy("batch_id", "ASC")
            ->orderBy("language_id", "DESC")->paginate($phrasesPerPage);

        return view("phrases.index", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $phrases = DB::table("phrases")
            ->select(DB::raw("batch_id, GROUP_CONCAT(DISTINCT phrase SEPARATOR ' | ') as 'phrase'"))
            ->groupBy("batch_id")
            ->get();

        $languages = Language::all();

        return view('phrases.create', compact("phrases", "languages"));
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
            'language_id' => 'required',
            'phrase' => 'required'
        ]);
    
        if (!$request->batch_id)
            $request->merge(["batch_id" => Str::random(10)]);
            
        $phrase = Phrase::create($request->all());

        if ($phrase != null)
            return redirect()->route('phrases.index')
                ->with('success', 'Phrase added successfully.');

        return redirect()->back()->with('error', 'There was a problem adding the phrase.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($phraseId)
    {
        $phrase = Phrase::find($phraseId);
    
        return view("phrases.show", compact("phrase"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit ($phraseId)
    {
        $phrase = Phrase::find($phraseId);

        $phrases = DB::table("phrases")
            ->select(DB::raw("batch_id, GROUP_CONCAT(DISTINCT phrase SEPARATOR ' | ') as 'phrase'"))
            ->groupBy("batch_id")
            ->get();

        $languages = Language::all();

        return view('phrases.edit', compact("phrase", "phrases", "languages"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $phraseId)
    {
        $this->validate($request, [
            'language_id' => 'required',
            'phrase' => 'required'
        ]);
    
        if (!$request->batch_id)
            $request->merge(["batch_id" => Str::random(10)]);

        $phrase = Phrase::find($phraseId);    
        $phrase->language_id = $request->language_id;
        $phrase->batch_id = $request->batch_id;
        $phrase->phrase = $request->phrase;
        $phrase->save();
        
        return redirect()->route("phrases.index")
            ->with("success", "Phrase updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($phraseId)
    {
        Phrase::find($phraseId)->delete();
        
        return redirect()->route("phrases.index")
            ->with("success", "Phrase deleted successfully");
    }
}
