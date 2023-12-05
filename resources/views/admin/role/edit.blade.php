@extends('admin.layouts.master')
@section('admin_title', 'Role Edit')
@section('admin_content')
    <div class="row">
        <div class="col-md-10 m-auto">
            <div class="card mb-4">
                <h5 class="card-header">Role Edit</h5>
                <div class="card-body">
                    <div>
                        <form action="{{ route('role.update', $role->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <label for="role_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="role_name" placeholder="Admin"
                                value="{{ $role->role_name }}" name="role_name">

                            <p class="mt-3">Manage permission for role</p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="selectAllPermission">
                                <label class="form-check-label" for="selectAllPermission">Select All </label>
                            </div>

                            @foreach ($modules->chunk(2) as $item)
                                <div class="row">
                                    @foreach ($item as $module)
                                        <div class="col-6">
                                            <h6 class="text-primary mt-3">Module: {{ $module->module_name }}</h6>
                                            @foreach ($module->permissions as $permission)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $permission->id }}" id="permissions" name="permissions[]"
                                                        @foreach ($role->permissions as $rPermission)
                                                        {{ $rPermission->id == $permission->id ? 'checked' : '' }} @endforeach>
                                                    <label class="form-check-label"
                                                        for="permissions">{{ $permission->permission_name }} </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-primary mt-4">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
