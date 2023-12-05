@extends('admin.layouts.master')
@section('admin_title', 'Permission Index')
@section('admin_content')
    <div class="row">
        <div class="col-md-6 m-auto">
            <div class="card mb-4">
                <h5 class="card-header">Permission Edit</h5>
                <div class="card-body">
                    <div>
                        <form action="{{ route('permission.update', $permission->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <label for="module_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="permission_name" placeholder="User Index"
                                value="{{ $permission->permission_name }}" name="permission_name">
                            <select name="module_id" class="form-control mt-3" id="module_id">
                                @forelse ($modules as $module)
                                    <option value="{{ $module->id }}"
                                        {{ $permission->module_id == $module->id ? 'selected' : '' }}>
                                        {{ $module->module_name }}</option>
                                @empty
                                @endforelse
                            </select>
                            <button type="submit" class="btn btn-primary mt-4">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
