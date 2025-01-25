@extends('home.layouts.main')

@section('contain')
    <div id="section-1" class="container py-5">
        @if (count($publications) >= 1)
            <div class="row g-5">
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-12 border border-bottom-0 p-4">
                            <h1 class="font-times">{{ $title }}</h1>
                        </div>
                    </div>
                    <div class="row border p-4">
                        @foreach ($publications as $publication)
                            <div class="col-12 mb-2 mb-md-4">
                                <div class="row justify-content-center">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <img src="{{ asset($publication->cover) }}" alt="{{ $publication->name }}"
                                            class="w-100">
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="py-3 py-md-0">
                                            <small><i class="bi bi-clock"></i>
                                                {{ $publications[0]->created_at->diffForHumans() }}</small>
                                            <h3 class="card-title mb-2">{{ $publication->title }}</h3>
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
        @else
            <div class="p-3 m-3 p-lg-5 m-lg-5 rounded text-body-emphasis bg-body-secondary text-center">
                <b class="text-center">Tidak Ada Publikasi yang dapat ditemukan</b>
            </div>
        @endif

    </div>
@endsection
