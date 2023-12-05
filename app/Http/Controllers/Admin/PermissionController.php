<?php

namespace App\Http\Controllers\Admin;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::with('module')->latest()->paginate();
        return view('admin.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modules = Module::get();
        return view('admin.permission.create', compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, FlasherInterface $flasher)
    {
        $validated = Validator::make($request->all(), ['permission_name' => 'required|string', 'module_id' => 'required|integer'])->validate();
        $validated['permission_slug'] = Str::slug($validated['permission_name']);
        Permission::create($validated);
        $flasher->addSuccess('Permission Successfully Inserted.');
        return redirect()->route('permission.index');
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
        $permission = Permission::findOrFail($id);
        $modules = Module::get();
        return view('admin.permission.edit', compact('permission', 'modules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, FlasherInterface $flasher)
    {
        $permission = Permission::findOrFail($id);
        $validated = Validator::make($request->all(), ['permission_name' => 'required|string', 'module_id' => 'required|integer'])->validate();
        $validated['permission_slug'] = Str::slug($validated['permission_name']);
        $permission->update($validated);
        $flasher->addSuccess('Permission Successfully Updated.');
        return redirect()->route('permission.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, FlasherInterface $flasher)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        $flasher->addSuccess('Permission Successfully Deleted.');
        return back();
    }
}
