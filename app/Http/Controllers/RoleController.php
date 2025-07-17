<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('permission:view-roles|create-roles|edit-roles|delete-roles', ['only' => ['index','show']]);
        $this->middleware('permission:create-roles', ['only' => ['create','store']]);
        $this->middleware('permission:edit-roles', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-roles', ['only' => ['destroy']]);
    }
    public function index()
    {
        $roles = Role::withCount('users')->paginate(10);
        $permissions = Permission::all();
        return view('roles.index', compact('roles', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles',
        ]);
        $role = Role::create([
            'name' => $validated['name'],
            'guard_name' => 'web', // Add this line
        ]);
        $permissions = Permission::whereIn('id', $request->permissions)->pluck('name');
        $role->syncPermissions($permissions);
        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $role = Role::with('users', 'permissions')->findOrFail($id);

        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
        ]);
        $role->update($validated); 
        $permissions = Permission::whereIn('id', $request->permissions)->pluck('name');
        $role->syncPermissions($permissions);  // Sync the permissions with the role   // Sync the permissions with the role       
        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
