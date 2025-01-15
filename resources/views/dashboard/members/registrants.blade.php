@extends('dashboard.layouts.main')
@section('container')
    <div class="row mt-4">
        <div class="col-12">
            <h4>Registrants</h4>
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
                            <th scope="col" colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($registrants) == 0)
                            <tr>
                                <td colspan="10" class="text-center">No one has registered yet</td>
                            </tr>
                        @else
                            @foreach ($registrants as $registrant)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $registrant->name }}</td>
                                    <td>{{ $registrant->phone }}</td>
                                    <td>{{ $registrant->email }}</td>
                                    <td>{{ $registrant->address }}</td>
                                    <td>{{ $registrant->institution }}</td>
                                    <td>{{ $registrant->position }}</td>
                                    <td>{{ $registrant->company_email }}</td>
                                    <td>{{ $registrant->is_member_of_other_legal_association ? 'Yes' : 'No' }}</td>
                                    <td>
                                        <a href="/dashboard/registrants/{{ $registrant->id }}"
                                            class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a>
                                    </td>
                                    <td>
                                        <form action="/dashboard/members/{{ $registrant->id }}" method="post">
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
    </div>
@endsection
