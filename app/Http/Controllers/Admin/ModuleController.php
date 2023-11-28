<?php

namespace App\Http\Controllers\Admin;

use App\Models\Module;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modules = Module::get();
        return view('admin.module.index', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.module.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, FlasherInterface $flasher)
    {
        $validated = Validator::make($request->all(), [
            'module_name' => 'required|string'
        ])->validate();
        $validated['module_slug'] = Str::slug($validated['module_name']);
        Module::create($validated);
        $flasher->addSuccess('Module Successfully Created.');
        return redirect()->route('module.index');
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
        $module = Module::findOrFail($id);
        return view('admin.module.edit', compact('module'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, FlasherInterface $flasher)
    {
        $module = Module::findOrFail($id);
        $validated = Validator::make($request->all(), ['module_name' => 'required|string'])->validate();
        $validated['module_slug'] = Str::slug($validated['module_name']);
        $module->update($validated);
        $flasher->addSuccess('Module Successfully Updated.');
        return redirect()->route('module.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, FlasherInterface $flasher)
    {

        $module = Module::findOrFail($id);
        $module->delete();
        $flasher->addSuccess('Module Successfully Deleted.');
        return back();
    }
}
