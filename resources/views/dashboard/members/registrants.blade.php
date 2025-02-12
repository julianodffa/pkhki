@extends('dashboard.layouts.main')
@section('container')
    <div class="row">
        <div class="col-12 col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h1 class="font-poppins-bold text-warning">{{ $countRegistrants }}</h1>
                    <h5 class="card-title font-poppins-bold">Registrants</h5>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h1 class="font-poppins-bold text-warning">{{ $countNewRegistrants }}</h1>
                    <h5 class="card-title font-poppins-bold"><sup class="text-warning">New</sup> Registrants</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h3 class="font-poppins-bold">Registrants</h3>
            </div>
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
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Institution</th>
                            <th scope="col">Register On</th>
                            <th scope="col" colspan="3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($countRegistrants == 0)
                            <tr>
                                <td colspan="10" class="text-center">No one has registered yet</td>
                            </tr>
                        @else
                            @foreach ($registrants as $registrant)
                                <tr @if ($registrant->checked == true) class="table-secondary" @endif>
                                    <td class="align-middle @if ($registrant->checked == false) fw-bold @endif">{{ $registrant->name }}</td>
                                    <td class="align-middle">{{ $registrant->phone }}</td>
                                    <td class="align-middle">{{ $registrant->email }}</td>
                                    <td class="align-middle">{{ $registrant->institution }}</td>
                                    <td class="align-middle @if ($registrant->checked == false) fw-bold @endif">{{ $registrant->created_at->isToday() ? $registrant->created_at->format('H:i') : $registrant->created_at->format('d M Y') }}</td>
                                    <td class="align-middle">
                                        <button type="button" class="btn btn-sm btn-success"
                                            onclick='customConfirmation(event, {{ $registrant->id }}, "registrants", "Accept {{ $registrant->name }} as Member?", "Yes", "Membership Admission", "success")'>
                                            <i class="bi bi-check2-circle"></i>
                                        </button>
                                        <form id="confirm-registrants-{{ $registrant->id }}" method="POST"
                                            action="/dashboard/members/{{ $registrant->id }}/acceptAsMember"
                                            style="display: none;">
                                            @csrf
                                            @method('PUT')
                                        </form>
                                    </td>
                                    <td class="align-middle">
                                        <a href="/dashboard/registrants/{{ $registrant->id }}"
                                            class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a>
                                    </td>
                                    <td class="align-middle">
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="deleteConfirmation(event, {{ $registrant->id }}, 'members', '{{ $registrant->name }}')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <form id="delete-members-{{ $registrant->id }}" method="POST"
                                            action="/dashboard/members/{{ $registrant->id }}" style="display: none;">
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
                    {{ $registrants->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
