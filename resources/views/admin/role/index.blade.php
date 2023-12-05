@extends('admin.layouts.master')
@section('admin_title', 'Role Index')
@section('admin_content')
    <div class="card">
        <div class="top-header justify-content-between align-items-center d-flex">
            <h5 class="card-header">Role List</h5>
            <a class="btn btn-primary" href="{{ route('role.create') }}">Create</a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Permission</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($roles as $role)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                <strong>{{ $role->role_name }}</strong>
                            </td>
                            <td>{{ $role->role_slug }}</td>
                            <td>
                                @foreach ($role->permissions->chunk(5) as $chunks)
                                    <div>
                                        @foreach ($chunks as $permission)
                                            <span class="badge badge bg-dark">{{ $permission->permission_name }}</span>
                                        @endforeach
                                    </div>
                                @endforeach
                            </td>

                            <td><span class="badge bg-label-primary me-1">{{ $role->created_at->format('d M,Y') }}</span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('role.edit', $role->id) }}"><i
                                                class="bx bx-edit-alt me-1"></i>
                                            Edit</a>
                                        <form action="{{ route('role.destroy', $role->id) }}" method="post">
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
