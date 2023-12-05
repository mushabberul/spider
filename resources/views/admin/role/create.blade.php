@extends('admin.layouts.master')
@section('admin_title', 'Role Create')
@section('admin_content')
    <div class="row">
        <div class="col-md-10 m-auto">
            <div class="card mb-4">
                <h5 class="card-header">Role Create</h5>
                <div class="card-body">
                    <div>
                        <form action="{{ route('role.store') }}" method="post">
                            @csrf
                            <label for="role_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="role_name" placeholder="Admin"
                                value="{{ old('role_name') }}" name="role_name">

                            <p class="mt-4">Manage Permission for Role</p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="selectAllPermission">
                                <label class="form-check-label" for="selectAllPermission">Select All </label>
                            </div>

                            @foreach ($modules->chunk(2) as $items)
                                <div class="row mt-4">
                                    @foreach ($items as $module)
                                        <div class="col-6">
                                            <h6 class="text-primary">Module: {{ $module->module_name }}</h6>
                                            @foreach ($module->permissions as $permission)
                                                <div class="form-check">
                                                    <input class="form-check-input" name="permissions[]"
                                                        value="{{ $permission->id }}" type="checkbox"
                                                        id="permission-{{ $permission->id }}">
                                                    <label class="form-check-label" for="permission-{{ $permission->id }}">
                                                        {{ $permission->permission_name }}
                                                    </label>
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

@push('script')
    <script>
        $('#selectAllPermission').on('click', function() {
            if (this.checked) {
                $(':checkbox').each(function(event) {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function(event) {
                    this.checked = false;
                });
            }
        });
    </script>
@endpush
