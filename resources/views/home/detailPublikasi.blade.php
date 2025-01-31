@extends('home.layouts.main')

@section('contain')
    <div id="section-1" class="container py-5">
        <div class="row g-5">
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-12 border p-4">
                        <h1 class="font-times"><b>{{ $publication->title }}</b></h1>
                        <div class="row py-3">
                            <div class="col-lg-6 text-start">
                                <span><i class="bi bi-person"></i> {{ $publication->user->name }} <i
                                        class="bi bi-calendar ms-2"></i>
                                    {{ $publication->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-6 text-lg-end">
                                @if ($publication->clicks > 1000)
                                    <span class="text-danger"><i class="bi bi-eye"></i> {{ $publication->clicks }}</span>
                                @else
                                    <span><i class="bi bi-eye"></i> {{ $publication->clicks }}</span>
                                @endif
                            </div>
                        </div>
                        <article id="contentHtml" class="my-3 font-opensans">
                            {!! $contentHtml !!}
                        </article>
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
    </div>
@endsection
