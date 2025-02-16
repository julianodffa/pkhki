@extends('home.layouts.main')

@section('contain')
    <div id="section-1" class="container py-5">
        <div class="row justify-content-center mb-3">
            <div class="col-md-6">
                <form action="/publikasi">
                    <div class="input-group">
                        <input type="text" id="search" class="form-control" placeholder="Cari..." name="s"
                            value="{{ request('s') }}" autocomplete="off">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </div>
                </form>
                <div class="position-relative">
                    <ul id="suggestion-list" class="suggestion-list list-group mt-2">
                    </ul>
                </div>
            </div>
        </div>
        <!-- resources/views/post/show.blade.php -->

        @if (count($publications) != 0)
            <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary"
                style="background-image: url('{{ asset($publications[0]->cover_webp) }}'); background-size: cover; background-position: center; position: relative;">

                <!-- Overlay Gelap -->
                <div class="overlay"
                    style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.5);"></div>

                <div class="col-lg-12 px-0 position-relative z-index-2">
                    <a href="/{{ $publications[0]->slug }}" class="text-decoration-none">
                        <h1 class="display-4 fst-italic font-times text-white">{{ $publications[0]->title }}</h1>
                    </a>
                    <p class="lead my-3 text-white font-poppins"><i class="bi bi-clock"></i>
                        {{ $publications[0]->created_at->diffForHumans() }}</p>
                    <p class="lead my-3 text-white font-opensans">
                        {{ $publications[0]->excerpt }}
                    </p>
                    <p class="lead mb-0"><a href="/{{ $publications[0]->slug }}" class="btn btn-blue">Baca
                            Selengkapnya</a>
                    </p>
                </div>
            </div>
        @else
            <div class="p-3 m-3 p-lg-5 m-lg-5 rounded text-body-emphasis bg-body-secondary text-center">
                <b class="text-center">Tidak Ada Publikasi yang dapat ditemukan</b>
            </div>
        @endif

        @if (count($publications) > 1)
            <div class="row g-0 gy-5 g-sm-5">
                <div class="col-lg-8">
                    <div class="row p-4 border">
                        @foreach ($publications->skip(1) as $publication)
                            <div class="col-12 mb-2 mb-md-4">
                                <div class="row justify-content-center">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <picture class="img-fluid">
                                            <source srcset="{{ asset($publication->cover_webp) }}" type="image/jpg">
                                            <img src="{{ asset($publication->cover) }}" class="w-100" alt="Fallback image">
                                        </picture>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="py-3 py-md-0">
                                            <small>
                                                <i class="bi bi-clock"></i>
                                                {{ $publication->created_at->format('F d, Y') }}</small>
                                            <a href="/{{ $publications[0]->slug }}" class="text-decoration-none text-dark">
                                                <h4 class="card-title mb-2 hover-blue">{{ $publication->title }}</h4>
                                            </a>
                                            <p class="card-text">{!! $publication->excerpt !!}</p>
                                            <a href="{{ $publication->slug }}"
                                                class="btn btn-blue text-decoration-none">Baca
                                                selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- Pagination Links -->
                        <div class="d-flex justify-content-start">
                            {{ $publications->links() }}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('home.layouts.sidebarPublikasi')
                </div>
            </div>
        @endif
    </div>
@endsection
