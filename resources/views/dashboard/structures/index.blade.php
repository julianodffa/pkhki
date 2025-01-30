@extends('dashboard.layouts.main')
@section('container')
    <div class="row">
        <div class="col-12 col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h1 class="font-poppins-bold text-warning">{{ $countStructures }}</h1>
                    <h5 class="card-title font-poppins-bold">Structures</h5>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h1 class="font-poppins-bold text-warning">{{ count($roles) }}</h1>
                    <h5 class="card-title font-poppins-bold">Roles</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h3 class="font-poppins-bold">Structures</h3>
            </div>
            <a href="/dashboard/structures/create" class="btn btn-blue">Create</a>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                    <strong>{{ session('error') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="table-responsive mt-4">
                <table class="table table-bordered text-center">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Position</th>
                            <th scope="col">Law Firm</th>
                            <th scope="col">Role</th>
                            <th scope="col" colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($countStructures == 0)
                            <tr>
                                <td colspan="6" class="text-center">No structures</td>
                            </tr>
                        @else
                            @foreach ($structures as $structure)
                                <tr>
                                    <td class="align-middle">{{ $structure->name }}</td>
                                    <td class="align-middle">{{ $structure->position }}</td>
                                    <td class="align-middle">{{ $structure->lawfirm }}</td>
                                    <td class="align-middle">{{ $structure->role->name }}</td>
                                    <td class="align-middle">
                                        <a href="/dashboard/structures/{{ $structure->id }}"
                                            class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a>
                                    </td>
                                    <td class="align-middle">
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="deleteConfirmation(event, {{ $structure->id }}, 'structures', '{{ $structure->name }}')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <form id="delete-structures-{{ $structure->id }}" method="POST"
                                            action="/dashboard/structures/{{ $structure->id }}" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    {{ $structures->links() }}
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-4 mt-md-0">
            <div class="position-sticky" style="top: 4rem">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h4 class="font-poppins-bold">Roles</h4>
                </div>
                <a href="/dashboard/structures/roles/create" class="btn btn-blue">Create</a>
                @if (session('success-role'))
                    <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                        <strong>{{ session('success-role') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session('error-role'))
                    <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                        <strong>{{ session('error-role') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="table-responsive mt-4">
                    <table class="table table-bordered text-center">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($roles) == 0)
                                <tr>
                                    <td colspan="5" class="text-center">No roles</td>
                                </tr>
                            @else
                                @foreach ($roles as $role)
                                    <tr>
                                        <td class="align-middle">{{ $role->name }}</td>
                                        <td class="align-middle">
                                            <a href="/dashboard/structures/roles/{{ $role->id }}/edit"
                                                class="btn btn-sm btn-outline-warning me-1"><i
                                                    class="bi bi-pencil-square"></i></a>
                                        </td>
                                        <td class="align-middle">
                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="deleteConfirmation(event, {{ $role->id }}, 'roles', '{{ $role->name }}')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            <form id="delete-roles-{{ $role->id }}" method="POST"
                                                action="/dashboard/structures/roles/{{ $role->id }}"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
@endsection
