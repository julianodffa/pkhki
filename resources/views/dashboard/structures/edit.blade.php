@extends('dashboard.layouts.main')
@section('container')
    <div class="container py-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h3 class="font-poppins-bold">Edit Structure</h3>
        </div>
        <div class="row">
            <div class="col-12 col-md-4">
                <form action="/dashboard/structures/{{ $structure->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text"
                            class="form-control @error('name')
                    is-invalid
                @enderror"
                            id="name" name="name" value="{{ old('name', $structure->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
            </div>

            <div class="col-12 col-md-4">
                <form action="/dashboard/structures" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="text"
                            class="form-control @error('position')
                    is-invalid
                @enderror"
                            id="position" name="position" value="{{ old('position', $structure->position) }}" required>
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
                        id="lawfirm" name="lawfirm" value="{{ old('lawfirm', $structure->lawfirm) }}" required>
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
                        id="email" name="email" value="{{ old('email', $structure->email) }}" required>
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
                    <select class="form-select" name="role_id">
                        @foreach ($roles as $role)
                            @if (old('role_id', $structure->role_id) == $role->id)
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
                    <label for="cover" class="form-label">Image</label>
                    @if ($structure->image)
                        <img src="{{ asset($structure->image) }}" class="cover-preview img-fluid mb-3 col-sm-5 d-block">
                    @else
                        <img class="cover-preview img-fluid mb-3 col-sm-5">
                    @endif
                    <input
                        class="form-control 
                @error('image')
                    is-invalid
                @enderror"
                        type="file" id="cover" name="image" onchange="previewCover()">
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-blue">Update</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewCover() {
            const cover = document.querySelector("#cover");
            const imgPreview = document.querySelector(".cover-preview");

            imgPreview.style.display = "block";

            const oFReader = new FileReader();
            oFReader.readAsDataURL(cover.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
