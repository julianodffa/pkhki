@extends('dashboard.layouts.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3 class="font-poppins-bold">Change Password</h3>
    </div>
    <div class="row justify-content-start mt-4">
        <div class="col-md-4">
            <form action="/dashboard/users/{{ Auth::user()->username }}/change-password" method="post">
                @csrf
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
                <div class="mb-3">
                    <label for="old-password" class="form-label">Old Password</label>
                    <input type="password" class="form-control @error('old-password') is-invalid @enderror"
                        id="old-password" name="old-password" autocomplete="off" required>
                    @error('old-password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="new-password" class="form-label">New Password</label>
                    <input type="password" class="form-control @error('new-password') is-invalid @enderror"
                        id="new-password" name="new-password" autocomplete="off" required>
                    @error('new-password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="confirm-new-password" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control @error('confirm-new-password') is-invalid @enderror"
                        id="confirm-new-password" name="confirm-new-password" autocomplete="off" required>
                    @error('confirm-new-password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-blue">Change Password</button>
            </form>
        </div>
    </div>
@endsection
