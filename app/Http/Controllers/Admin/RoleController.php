<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('permissions')->latest()->get();
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modules = Module::with('permissions:id,permission_name,module_id')->select(['id', 'module_name'])->get();
        return view('admin.role.create', compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, FlasherInterface $flasher)
    {

        $validated = Validator::make($request->all(), [
            'role_name' => 'required|string',
            'permissions' => 'required|array',
            'permissions.*' => 'integer',
        ])->validate();
        $validated['role_slug'] = Str::slug($validated['role_name']);
        $role = Role::create($validated);
        $role->permissions()->sync($request->permissions);
        $flasher->addSuccess('Role Successfully Inserted.');
        return redirect()->route('role.index');
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
        $role = Role::findOrFail($id);
        $modules = Module::with('permissions:id,permission_name,module_id')->get();

        return view('admin.role.edit', compact('role', 'modules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, FlasherInterface $flasher)
    {
        $role = Role::findOrFail($id);
        $validated = Validator::make($request->all(), [
            'role_name' => 'required|string',
            'permissions' => 'required|array',
            'permissions.*' => 'integer'
        ])->validate();
        $validated['role_slug'] = Str::slug($validated['role_name']);
        $role->update($validated);
        $role->permissions()->sync($validated['permissions']);
        $flasher->addSuccess('Role Successfully Updated.');
        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, FlasherInterface $flasher)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        $flasher->addSuccess('Role Successfully Deleted.');
        return back();
    }
}
