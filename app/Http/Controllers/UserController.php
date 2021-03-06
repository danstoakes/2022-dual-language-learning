<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware("permission:user-list|user-create|user-edit|user-delete", ["only" => ["index", "store"]]);
        $this->middleware("permission:user-list", ["only" => ["show"]]);
        $this->middleware("permission:user-create", ["only" => ["create", "store"]]);
        $this->middleware("permission:user-edit", ["only" => ["edit", "update"]]);
        $this->middleware("permission:user-delete", ["only" => ["destroy"]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::orderBy("id", "ASC")->paginate(10);

        return view("users.index", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view("users.create", compact("roles"));
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
            "name" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required|confirmed",
            "role" => "required"
        ]);
    
        $input = $request->all();
        $input["password"] = Hash::make($input["password"]);
    
        $user = User::create($input);
        $user->assignRole($request->role);
    
        return redirect()->route("users.index")
            ->with("success", "User created successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        $user = User::find($user);

        return view("users.show", compact("user"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user)
    {
        $user = User::find($user);
        $roles = Role::all();
        $userRole = $user->roles->pluck("name", "id")->all();
    
        return view("users.edit", compact("user", "roles", "userRole"));
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
            "name" => "required",
            "email" => "required|email|unique:users,email," . $id,
            "password" => "confirmed",
            "role" => "required"
        ]);
    
        $input = $request->all();
        
        if(!empty($input["password"])) { 
            $input["password"] = Hash::make($input["password"]);
        } else {
            $input = Arr::except($input, array("password"));    
        }
    
        $user = User::find($id);
        $user->update($input);

        DB::table("model_has_roles")
            ->where("model_id", $id)
            ->delete();
    
        $user->assignRole($request->role);
    
        return redirect()->route("users.index")
            ->with("success", "User updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();

        return redirect()->route("users.index")
            ->with("success", "User deleted successfully.");
    }

    public function showEnrolLanguage ($user)
    {
        $user = User::find($user);
        $userLanguages = $user->languages()->get();

        $languages = Language::whereNotIn('id', $userLanguages->pluck("id"))->orderBy("id", "ASC")->paginate(4);

        return view("users.enrol", compact("user", "languages"));
    }
}