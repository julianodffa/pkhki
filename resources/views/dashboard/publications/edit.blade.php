@extends('dashboard.layouts.main')
@section('container')
    <div class="container py-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h3 class="font-poppins-bold">Edit Publication</h3>
        </div>
        <form action="/dashboard/publications/{{ $publication->id }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text"
                            class="form-control @error('title')
                    is-invalid
                @enderror"
                            id="title" name="title" value="{{ old('title', $publication->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 mb-3">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select id="multiple-select-field"
                            class="form-select @error('categories')
                    is-invalid
                @enderror"
                            multiple name="categories[]">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if ($publication->categories->contains($category->id)) selected @endif>
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
                <div class="mb-3">
                    <label for="cover" class="form-label">Publication Cover</label>
                    @if ($publication->cover)
                        <img src="{{ asset($publication->cover) }}" class="cover-preview img-fluid mb-3 col-sm-5 d-block">
                    @else
                        <img class="cover-preview img-fluid mb-3 col-sm-5">
                    @endif
                    <input
                        class="form-control 
                    @error('cover')
                        is-invalid
                    @enderror"
                        type="file" id="cover" name="cover" onchange="previewCover()">
                    @error('cover')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    @error('content')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <textarea id="summernote" name="content">{!! old('content', $contentHtml) !!}</textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-blue">Update</button>
        </form>
    </div>
    </div>

    <script>
        // $(document).ready(function() {
        //     $('#summernote').summernote();
        // });

        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300, // Ukuran tinggi editor
                toolbar: [
                    ['style', ['style']], // Menambahkan opsi Style (heading, dll)
                    ['font', ['bold', 'underline']], // Menambahkan Bold dan Underline
                    ['para', ['ul', 'ol',
                        'paragraph'
                    ]], // Menambahkan Unordered list, Ordered list, dan Paragraph
                    ['insert', ['table', 'link', 'picture',
                        'video'
                    ]] // Menambahkan Table, Link, Gambar dan Video
                ],
            });

            $('#multiple-select-field').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                closeOnSelect: false,
            });
        });

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
