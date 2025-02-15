@extends('home.layouts.main')

@section('contain')
    <div id="section-1" class="container py-5">
        @if (count($publications) >= 1)
            <div class="row g-5">
                <div class="col-lg-8">
                    <div class="row p-4 border">
                        <h1 class="font-times fw-bold mb-4 pb-3 border-bottom">{{ $title }}</h1>
                        @foreach ($publications as $publication)
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
                                            <small><i class="bi bi-clock"></i>
                                                {{ $publications[0]->created_at->diffForHumans() }}</small>
                                            <a href="/{{ $publications[0]->slug }}" class="text-decoration-none text-dark">
                                                <h4 class="card-title mb-2 hover-blue">{{ $publication->title }}</h4>
                                            </a>
                                            <p class="card-text">{!! $publication->excerpt !!}</p>
                                            <a href="/{{ $publication->slug }}"
                                                class="btn btn-blue text-decoration-none">Baca selengkapnya</a>
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
        @else
            <div class="p-3 m-3 p-lg-5 m-lg-5 rounded text-body-emphasis bg-body-secondary text-center">
                <b class="text-center">Tidak Ada Publikasi yang dapat ditemukan</b>
            </div>
        @endif
    </div>
@endsection
