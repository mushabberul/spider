@extends('admin.layouts.master')
@section('admin_title', 'Module Index')
@section('admin_content')
    <div class="card">
        <div class="top-header justify-content-between align-items-center d-flex">
            <h5 class="card-header">Module List</h5>
            <a class="btn btn-primary" href="{{ route('module.create') }}">Create</a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($modules as $module)
                        <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                <strong>{{ $module->module_name }}</strong>
                            </td>
                            <td>{{ $module->module_slug }}</td>

                            <td><span class="badge bg-label-primary me-1">{{ $module->created_at->format('d M,Y') }}</span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('module.edit', $module->id) }}"><i
                                                class="bx bx-edit-alt me-1"></i>
                                            Edit</a>
                                        <form action="{{ route('module.destroy', $module->id) }}" method="post">
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
