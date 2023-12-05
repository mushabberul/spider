@extends('admin.layouts.master')
@section('admin_title', 'Permission Create')
@section('admin_content')
    <div class="row">
        <div class="col-md-6 m-auto">
            <div class="card mb-4">
                <h5 class="card-header">Permission Create</h5>
                <div class="card-body">
                    <div>
                        <form action="{{ route('permission.store') }}" method="post">
                            @csrf
                            <label for="module_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="permission_name" placeholder="Index Create"
                                value="{{ old('permission_name') }}" name="permission_name">
                            <select name="module_id" id="module_id" class="form-control mt-4">
                                @forelse ($modules as $module)
                                    <option value="{{ $module->id }}">{{ $module->module_name }}</option>
                                @empty
                                    <option value="">Not Found</option>
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
