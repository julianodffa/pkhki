@extends('dashboard.layouts.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3 class="font-poppins-bold">Create Role</h3>
    </div>
    <div class="row">
        <div class="col-12 col-md-4">
            <form action="/dashboard/structures/roles" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Role Name</label>
                    <input type="text"
                        class="form-control @error('name')
                    is-invalid
                @enderror"
                        id="name" name="name" value="{{ old('name') }}" placeholder="Role Name" required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-blue">Save</button>
        </div>
        </form>
    </div>
@endsection
