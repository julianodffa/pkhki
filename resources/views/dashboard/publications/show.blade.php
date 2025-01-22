@extends('dashboard.layouts.main')
@section('container')
    <div class="container py-4">
        <div class="row justify-content-start">
            <div class="col-md-10">
                <a class="btn btn-success" href="/dashboard/publications">
                    Back
                </a>
                <a class="btn btn-warning text-white" href="/dashboard/publications/{{ $publication->slug }}/edit">Edit</a>
                <div class="my-3">
                    <img src="{{ asset($publication->cover) }}" alt="image-of-{{ $publication->slug }}" class="img-fluid">
                </div>

                <h1 class="mt-3">{{ $publication->title }}</h1>

                <span><i class="bi bi-calendar"></i> {{ $publication->created_at->diffForHumans() }}</span>
                <p class="d-block">By: <b>{{ $publication->user->name }}</b>
                    in
                    @foreach ($publication->categories as $category)
                        <b>{{ $category->name }}</b>
                    @endforeach
                </p>
                <article class="my-3">
                    {!! $contentHtml !!}
                </article>
            </div>
        </div>
    </div>
@endsection
