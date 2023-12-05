@extends('admin.layouts.master')
@section('admin_title', 'Permission Index')
@section('admin_content')
    <div class="card">
        <div class="top-header justify-content-between align-items-center d-flex">
            <h5 class="card-header">Permission List</h5>
            <a class="btn btn-primary" href="{{ route('permission.create') }}">Create</a>
        </div>
        <div class="table-responsive text-nowrap p-4">
            <table class="table" id="permissionTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Module</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($permissions as $permission)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                <strong>{{ $permission->permission_name }}</strong>
                            </td>
                            <td>{{ $permission->permission_slug }}</td>
                            <td>{{ $permission->module->module_name }}</td>

                            <td><span
                                    class="badge bg-label-primary me-1">{{ $permission->created_at->format('d M,Y') }}</span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('permission.edit', $permission->id) }}"><i
                                                class="bx bx-edit-alt me-1"></i>
                                            Edit</a>
                                        <form action="{{ route('permission.destroy', $permission->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-denger"><i
                                                    class="bx bx-trash me-2"></i>Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>Data Not Found</td>
                        </tr>
                    @endforelse


                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('script')
    <script>
        new DataTable('#permissionTable');
    </script>
@endpush
