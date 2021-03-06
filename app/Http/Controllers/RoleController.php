<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware("permission:role-list|role-create|role-edit|role-delete", ["only" => ["index", "store"]]);
        $this->middleware("permission:role-list", ["only" => ["show"]]);
        $this->middleware("permission:role-create", ["only" => ["create", "store"]]);
        $this->middleware("permission:role-edit", ["only" => ["edit", "update"]]);
        $this->middleware("permission:role-delete", ["only" => ["destroy"]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::orderBy("id", "ASC")->paginate(10);

        return view("roles.index", compact("roles"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get();

        return view("roles.create", compact("permissions"));
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
            "name" => "required|unique:roles,name",
            "description" => "required|max:128",
            "permission" => "required"
        ]);

        $role = new Role;
        $role->name = $request->name;
        $role->description = $request->description;
        $role->save();

        $permissions = $request->permission;
        $role->syncPermissions($permissions);
    
        return redirect()->route("roles.index")
            ->with("success", "Role created successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();
    
        return view("roles.show", compact("role", "rolePermissions"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
        $rolePermissions = DB::table("role_has_permissions")
            ->where("role_has_permissions.role_id", $id)
            ->pluck("role_has_permissions.permission_id", "role_has_permissions.permission_id")
            ->all();
    
        return view("roles.edit", compact("role", "permissions", "rolePermissions"));
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
            "name" => "required|unique:roles,name," . $id,
            "description" => "required|max:128",
            "permission" => "required"
        ]);
    
        $role = Role::find($id);
        $role->name = $request->name;
        $role->description = $request->description;
        $role->save();

        $permissions = $request->permission;
        $role->syncPermissions($permissions);
    
        return redirect()->route("roles.show", $role)
            ->with("success", "Role updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::find($id)->delete();
        
        return redirect()->route("roles.index")
            ->with("success", "Role deleted successfully");
    }
}