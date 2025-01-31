@extends('dashboard.layouts.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3 class="font-poppins-bold">Create Publication</h3>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <form action="/dashboard/publications" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text"
                        class="form-control input-lg @error('title')
                    is-invalid
                @enderror"
                        id="title" name="title" value="{{ old('title') }}" autocomplete="off"
                        placeholder="Create Title" required>
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="categories" class="form-label">Category</label>
                <select id="multiple-select-field" class="form-select @error('categories') is-invalid @enderror" multiple
                    name="categories[]" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if (in_array($category->id, old('categories', []))) selected @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('categories')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-12 mb-3">
        <div class="mb-3">
            <label for="cover" class="form-label">Publication Cover
                <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"
                    data-bs-title="Allowed" data-bs-html="true"
                    data-bs-content="
                    Image Ratio Must be <strong>16/9</strong><br>
                Max Cover size is <strong>1MB</strong>
                    ">
                    <i class="bi bi-question-circle"></i></span>
            </label>
            <img class="img-preview img-fluid mb-3 col-sm-5">
            <input
                class="form-control 
                @error('cover')
                    is-invalid
                @enderror"
                type="file" id="cover" name="cover" onchange="previewCover()" required>
            @error('cover')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="summernote" class="form-label">Content</label>
            @error('content')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <textarea id="summernote" name="content">{{ old('content') }}</textarea>
        </div>
        <button type="submit" class="btn btn-blue">Publish</button>
        </form>
    </div>
@endsection
