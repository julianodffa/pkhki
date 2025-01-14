@extends('dashboard.layouts.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4>Edit Role</h4>
        <a href="/dashboard/structures">
            Back
        </a>
    </div>
    <div class="row">
        <div class="col-12 col-md-4">
            <form action="/dashboard/structures/roles/{{ $role->id }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text"
                        class="form-control @error('name')
                is-invalid
            @enderror" id="name"
                        name="name" value="{{ old('name', $role->name) }}" placeholder="Role Name" required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
        </div>
        </form>
    </div>
@endsection
