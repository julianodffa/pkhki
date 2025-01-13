@extends('dashboard.layouts.main')
@section('container')
    <div class="container">
        <div class="row justify-content-start my-3">
            <div class="col-md-10">
                <a onclick="history.back()" class="btn btn-success">
                    <span><i class="bi bi-arrow-left-circle-fill"></i></span>
                </a>
                <a href="/dashboard/publications/{{ $publication->id }}/edit" class="btn btn-warning">
                    <span><i class="bi bi-pencil-square"></i></span>
                </a>
                <form action="/dashboard/publications/{{ $publication->id }}" class="d-inline" method="post">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger" onclick="return confirm('Are You Sure?')">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>

                <div class="my-3">
                    <img src="{{ asset($publication->cover) }}" alt="image-of-{{ $publication->slug }}" class="img-fluid">
                </div>

                <h1 class="my-3">{{ $publication->title }}</h1>


                <p class="d-block mt-4">By: <b>{{ $publication->author->name }}</b>
                    in
                    @foreach ($publication->categories as $category)
                        <span class="badge text-bg-secondary">{{ $category->name }}</span>
                    @endforeach
                </p>
                <article class="my-3">
                    {!! $contentHtml !!}
                </article>
            </div>
        </div>
    </div>
@endsection
