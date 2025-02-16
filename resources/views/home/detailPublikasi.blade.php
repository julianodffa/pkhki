@extends('home.layouts.main')

@section('contain')
    <div id="section-1" class="container py-5">
        <div class="row g-0 gy-5 g-sm-5">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-12 border p-4">
                        @foreach ($publication->categories as $category)
                            <a href="/kategori/{{ $category->slug }}"><button
                                    class="btn btn-sm btn-blue">{{ $category->name }}</button></a>
                        @endforeach
                        <h1 class="font-times mb-4 mt-3 pb-2 border-bottom"><b>{{ $publication->title }}</b></h1>
                        <div class="row">
                            <div class="col-lg-6 text-start">
                                <span><i class="bi bi-person-circle"></i> {{ $publication->user->name }} <i
                                        class="bi bi-clock ms-2"></i>
                                    {{ $publication->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-6 text-lg-end">
                                @if ($publication->clicks > 100)
                                    <span class="text-danger"><i class="bi bi-fire"></i> {{ $publication->clicks }}</span>
                                @else
                                    <span><i class="bi bi-eye-fill"></i> {{ $publication->clicks }}</span>
                                @endif
                            </div>
                        </div>
                        <article id="contentHtml" class="my-3 font-opensans">
                            {!! $contentHtml !!}
                        </article>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                @include('home.layouts.sidebarPublikasi')
            </div>
        </div>
    </div>
    @endsection
