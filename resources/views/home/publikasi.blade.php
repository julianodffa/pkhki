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
                style="background-image: url('{{ asset($publications[0]->cover) }}'); background-size: cover; background-position: center; position: relative;">

                <!-- Overlay Gelap -->
                <div class="overlay"
                    style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.5);"></div>

                <div class="col-lg-12 px-0 position-relative z-index-2">
                    <h1 class="display-4 fst-italic font-times text-white">{{ $publications[0]->title }}</h1>
                    <p class="lead my-3 text-white font-poppins"><i class="bi bi-clock"></i> {{ $publications[0]->created_at->diffForHumans() }}</p>
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
            <div class="row g-5">
                <div class="col-lg-9">
                    <div class="row p-4 border">
                        @foreach ($publications->skip(1) as $publication)
                            <div class="col-12 mb-2 mb-md-4">
                                <div class="row justify-content-center">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <img src="{{ asset($publication->cover) }}" alt="{{ $publication->name }}"
                                            class="w-100">
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="py-3 py-md-0">
                                            <small>
                                                <i class="bi bi-clock"></i>{{ $publication->created_at->diffForHumans() }}</small>
                                            <h3 class="card-title mb-2">{{ $publication->title }}</h3>
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

                <div class="col-lg-3 p-4 border">
                    <div class="position-sticky" style="top: 2rem;">
                        <div>
                            <h4 class="fst-italic font-times">Kunjungi Sosial Media Kami</h4>
                            <ol class="list-unstyled">
                                <li><a href="#">Facebook</a></li>
                                <li><a href="#">Linked In</a></li>
                                <li><a href="#">Youtube</a></li>
                                <li><a href="#">Instagram</a></li>
                            </ol>
                        </div>
                        <div class="p-4">
                            <h4 class="fst-italic">Lainnya</h4>
                            <ol class="list-unstyled mb-0">
                                @foreach ($categories as $category)
                                    <li><a href="/kategori/{{ $category->slug }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
