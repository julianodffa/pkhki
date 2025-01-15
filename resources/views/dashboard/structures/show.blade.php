@extends('dashboard.layouts.main')
@section('container')
    <div class="row justify-content-start my-3">
        <div class="col-md-12">
            <a href="/dashboard/structures">
                Back
            </a>
            <div class="table-responsive mt-4">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Position</th>
                            <th scope="col">lawfirm</th>
                            <th scope="col">email</th>
                            <th scope="col">role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $structure->name }}</td>
                            <td>{{ $structure->position }}</td>
                            <td>{{ $structure->lawfirm }}</td>
                            <td>{{ $structure->email }}</td>
                            <td>{{ $structure->role->name }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-4 mt-4">
            <b class="d-block">Picture:</b>
            <img src="{{ asset($structure->image) }}" alt="{{ $structure->name }}"
                style="max-width: 300px; max-height: 450px;">
        </div>
    </div>
@endsection
