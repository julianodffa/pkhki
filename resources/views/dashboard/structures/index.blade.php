@extends('dashboard.layouts.main')
@section('container')
    <div class="row mt-4">
        <div class="col-md-8">
            <h4>Structures</h4>
            <a href="/dashboard/structures/create">Create a Stucture</a>
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
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Position</th>
                            <th scope="col">lawfirm</th>
                            <th scope="col">role</th>
                            <th scope="col" colspan="3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($structures) == 0)
                            <tr>
                                <td colspan="6" class="text-center">No structures</td>
                            </tr>
                        @else
                            @foreach ($structures as $structure)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $structure->name }}</td>
                                    <td>{{ $structure->position }}</td>
                                    <td>{{ $structure->lawfirm }}</td>
                                    <td>{{ $structure->role->name }}</td>
                                    <td>
                                        <a href="/dashboard/structures/{{ $structure->id }}"
                                            class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a>
                                    </td>
                                    <td>
                                        <a href="/dashboard/structures/{{ $structure->id }}/edit"
                                            class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil-square"></i></a>
                                    </td>
                                    <td>
                                        <form action="/dashboard/structures/{{ $structure->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Yakin hapus?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-4 mt-4 mt-md-0">
            <div class="position-sticky" style="top: 4rem">
                <h4>Roles</h4>
                <a href="/dashboard/structures/roles/create">Create a Role</a>
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
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
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
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <a href="/dashboard/structures/roles/{{ $role->id }}/edit"
                                                class="btn btn-sm btn-outline-warning me-1"><i
                                                    class="bi bi-pencil-square"></i></a>
                                        </td>
                                        <td>
                                            <form action="/dashboard/structures/roles/{{ $role->id }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('You will delete category that related to the publication, continue?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
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
