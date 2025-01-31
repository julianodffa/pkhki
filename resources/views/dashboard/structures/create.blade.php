@extends('dashboard.layouts.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3 class="font-poppins-bold">Create Structure</h3>
    </div>
    <div class="row">
        <div class="col-12 col-md-4">
            <form action="/dashboard/structures" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text"
                        class="form-control @error('name')
                    is-invalid
                @enderror"
                        id="name" name="name" value="{{ old('name') }}" autocomplete="off" required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="mb-3">
                <label for="position" class="form-label">Position</label>
                <input type="text"
                    class="form-control @error('position')
                    is-invalid
                @enderror"
                    id="position" name="position" value="{{ old('position') }}" autocomplete="off" required>
                @error('position')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="mb-3">
                <label for="lawfirm" class="form-label">Law Firm</label>
                <input type="text"
                    class="form-control @error('lawfirm')
                    is-invalid
                @enderror"
                    id="lawfirm" name="lawfirm" value="{{ old('lawfirm') }}" autocomplete="off" required>
                @error('lawfirm')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email"
                    class="form-control @error('email')
                    is-invalid
                @enderror"
                    id="email" name="email" value="{{ old('email') }}" autocomplete="off" required>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="role_id" class="form-label">Role</label>
                <select class="form-select" name="role_id" required>
                    @foreach ($roles as $role)
                        @if (old('role_id') == $role->id)
                            <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                        @else
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-12 mb-3">
            <div class="mb-3">
                <label for="cover" class="form-label">Image <span class="d-inline-block" tabindex="0"
                        data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-title="Allowed" data-bs-html="true"
                        data-bs-content="
                <ul class='py-0 my-0'>
                        <li>Image dimension must have <strong>300px Width</strong> and <strong>450px Height</strong>
                        </li>
                        <li>Max Image size is <strong>1MB</strong></li>
                        </ul>
                        ">
                        <i class="bi bi-question-circle"></i>
                    </span></label>
                <img class="img-preview img-fluid mb-3 col-sm-3">
                <input
                    class="form-control 
                @error('image')
                    is-invalid
                @enderror"
                    type="file" id="cover" name="image" onchange="previewCover()" required>
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-blue">Save</button>
            </form>
        </div>
    </div>
    <script src="{{ asset('assets/js/dashboard/preview-cover.js') }}"></script>
    <script src="{{ asset('assets/js/popovers.js') }}"></script>
@endsection
