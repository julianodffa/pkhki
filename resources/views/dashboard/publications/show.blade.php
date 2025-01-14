@extends('dashboard.layouts.main')
@section('container')
    <div class="container">
        <div class="row justify-content-start my-3">
            <div class="col-md-10">
                <a href="/dashboard/publications">
                    Back
                </a>
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
