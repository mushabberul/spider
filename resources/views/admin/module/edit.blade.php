@extends('admin.layouts.master')
@section('admin_title', 'Module Index')
@section('admin_content')
    <div class="row">
        <div class="col-md-6 m-auto">
            <div class="card mb-4">
                <h5 class="card-header">Module Edit</h5>
                <div class="card-body">
                    <div>
                        <form action="{{ route('module.update', $module->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <label for="module_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="module_name" placeholder="Profile Mangement"
                                value="{{ $module->module_name }}" name="module_name">

                            <button type="submit" class="btn btn-primary mt-4">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
