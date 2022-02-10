<?php

namespace App\Http\Controllers;

use App\Models\Phrase;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PhraseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Phrase::orderBy("id", "ASC")->paginate(10);

        return view("phrases.index", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('phrases.create');
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
            'phrase' => 'required'
        ]);
    
        if (!$request->batch_id)
            $request->merge(["batch_id" => Str::random(10)]);
            
        $phrase = Phrase::create($request->all());

        if ($phrase != null)
            return redirect()->route('phrases.index')
                ->with('success', 'Phrase created successfully.');

        return redirect()->back()->with('error', 'There was a problem adding the phrase.');
    }
}
