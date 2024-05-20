<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $permissions = Permission::all();
        return view('admin.roles-permissions.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.roles-permissions.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name', // Ensuring the name is unique in the roles table
        ]);

        // Create or update the Role
        $permission = Permission::updateOrCreate(
            ['name' => $validatedData['name']], // Assuming 'name' is the unique attribute
            $validatedData
        );
        return redirect()->route('permissions.index')->with('success', 'Permission Added succesfully!');
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
        $permission = Permission::find($id);
        return view('admin.roles-permissions.permissions.edit', compact( 'permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|string|max:255', // Ensuring the name is unique in the roles table
            // Add other validation rules as necessary
        ]);

        // Create or update the Role
        $role = Permission::updateOrCreate(
            ['name' => $validatedData['name']], // Assuming 'name' is the unique attribute
            $validatedData
        );
        return redirect()->route('permissions.index')->with('success', 'Permission Updated succesfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Permission::find($id)->delete();
        return redirect()->route('permissions.index')->with('success', 'Permission Deleted succesfully!');
    }
}
