<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $roles = Role::all();
        return view('admin.roles-permissions.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permisions = Permission::all();
        return view('admin.roles-permissions.roles.create', compact('permisions'));
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name', // Ensuring the name is unique in the roles table
            'permissions' => 'required', // Ensuring the name is unique in the roles table
            // Add other validation rules as necessary
        ]);
        $permissions = $request->permissions;

        // Create or update the Role
        $role = Role::updateOrCreate(
            ['name' => $validatedData['name']], // Assuming 'name' is the unique attribute
            $validatedData
        );
        if($permissions){
            $role->syncPermissions($permissions);
        }
        return redirect()->route('roles.index')->with('success', 'Role Added succesfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $role = Role::find($id);
        $permisions = Permission::all();
        return view('admin.roles-permissions.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|string|max:255', // Ensuring the name is unique in the roles table
            'permissions' => 'required', // Ensuring the name is unique in the roles table
            // Add other validation rules as necessary
        ]);
        $permissions = $request->permissions;

        // Create or update the Role
        $role = Role::updateOrCreate(
            ['name' => $validatedData['name']], // Assuming 'name' is the unique attribute
            $validatedData
        );
        if($permissions){
            $role->syncPermissions($permissions);
        }
        return redirect()->route('roles.index')->with('success', 'Role Updated succesfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Role::find($id)->delete();
        return redirect()->route('roles.index')->with('success', 'Role Deleted succesfully!');
    }
}
