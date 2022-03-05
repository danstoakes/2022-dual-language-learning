<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Rules\HasSVGTag;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:language-list|language-create|language-edit|language-delete', ['only' => ['index','store']]);
        $this->middleware('permission:language-create', ['only' => ['create','store']]);
        $this->middleware('permission:language-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:language-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Language::orderBy('id', 'ASC')->paginate(4);
        return view('languages.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('languages.create');
    }

    public static function generateSlug ($text, string $divider = '-')
    {
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
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
            'excerpt' => 'max:255',
            'description' => 'required|max:1024',
            'logo_path' => ['required', new HasSVGTag],
        ]);
    
        $language = new Language;
        $language->name = $request->input('name');
        $language->slug = $this->generateSlug($request->name);
        $language->excerpt = $request->input('excerpt');
        $language->description = $request->input('description');
        $language->logo_path = $request->input('logo_path');
        $language->save();
    
        return redirect()->route('languages.index')
            ->with('success', 'Language created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $language = Language::find($id);
        $modules = $language->modules->toArray();
 
        return view('languages.show', compact('language'), compact('modules'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $language = Language::find($id);
        return view('languages.edit', compact('language'));
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
            'excerpt' => 'max:255',
            'description' => 'required|max:1024',
            'logo_path' => ['required', new HasSVGTag],
        ]);

        $language = Language::find($id);
        $language->name = $request->input('name');
        $language->excerpt = $request->input('excerpt');
        $language->description = $request->input('description');
        $language->logo_path = $request->input('logo_path');
        $language->save();
        
        return redirect()->route('languages.show', $language->id)
            ->with('success', 'Language updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Language::find($id)->delete();
        
        return redirect()->route('languages.index')
            ->with('success', 'Language deleted successfully');
    }
}
