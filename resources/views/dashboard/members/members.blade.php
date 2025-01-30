@extends('dashboard.layouts.main')
@section('container')
    <div class="row">
        <div class="col-12 col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h1 class="font-poppins-bold text-warning">{{ $countMembers }}</h1>
                    <h5 class="card-title font-poppins-bold">Members</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h3 class="font-poppins-bold">Members</h3>
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
                            <th scope="col">Accepted By</th>
                            <th scope="col" colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($countMembers == 0)
                            <tr>
                                <td colspan="10" class="text-center">No one has been accepted as a member yet</td>
                            </tr>
                        @else
                            @foreach ($members as $member)
                                <tr>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->phone }}</td>
                                    <td>{{ $member->email }}</td>
                                    <td>{{ $member->institution }}</td>
                                    <td>{{ $member->user->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick='customConfirmation(event, {{ $member->id }}, "members", "Return {{ $member->name }} as Registrant?", "Yes", "Membership", "warning")'>
                                            <i class="bi bi-exclamation-circle"></i>

                                        </button>
                                        <form id="confirm-members-{{ $member->id }}" method="POST"
                                            action="/dashboard/members/{{ $member->id }}/returnAsRegistrant"
                                            style="display: none;">
                                            @csrf
                                            @method('PUT')
                                        </form>
                                    </td>
                                    <td>
                                        <a href="/dashboard/members/{{ $member->id }}"
                                            class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    {{ $members->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
