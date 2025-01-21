@extends('dashboard.layouts.main')
@section('container')
    <div class="row mt-4">
        <div class="col-12">
            <h4>Members</h4>
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
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Address</th>
                            <th scope="col">Institution</th>
                            <th scope="col">Position</th>
                            <th scope="col">Company Email</th>
                            <th scope="col">Member of Other Legal Association</th>
                            <th scope="col">Accepted By</th>
                            <th scope="col" colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($members) == 0)
                            <tr>
                                <td colspan="10" class="text-center">no one has been accepted as a member yet</td>
                            </tr>
                        @else
                            @foreach ($members as $member)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->phone }}</td>
                                    <td>{{ $member->email }}</td>
                                    <td>{{ $member->address }}</td>
                                    <td>{{ $member->institution }}</td>
                                    <td>{{ $member->position }}</td>
                                    <td>{{ $member->company_email }}</td>
                                    <td>{{ $member->is_member_of_other_legal_association ? 'Yes' : 'No' }}</td>
                                    <td>{{ $member->user->name }}</td>
                                    <td>
                                        <form action="/dashboard/members/{{ $member->id }}/returnAsRegistrant"
                                            method="post">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('return as registrant?')">
                                                <i class="bi bi-exclamation-circle"></i>
                                            </button>
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
            </div>
        </div>
    </div>
@endsection
