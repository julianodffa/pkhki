<div class="position-sticky" style="top: 2rem;">
    <div class="row mb-4">
        <div class="col border p-4">
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
    @if (count($topPublications) >= 1)
        <div class="row">
            <div class="col border p-4 pb-0">
                <div>
                    <h4 class="font-times border-bottom pb-2 mb-3 fw-bold">Populer</h4>
                    @foreach ($topPublications as $topPublication)
                        <div class="col-12 mb-2 mb-md-4">
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-4 col-lg-6">
                                    <picture class="img-fluid">
                                        <source srcset="{{ asset($topPublication->cover_webp) }}" type="image/webp">
                                        <img src="{{ asset($topPublication->cover) }}" class="w-100" alt="Fallback image">
                                    </picture>
                                </div>
                                <div class="col-12 col-md-8 col-lg-6">
                                    <div class="py-3 py-md-0">
                                        <a href="/{{ $topPublication->slug }}" class="text-decoration-none text-dark hover-blue"><b
                                                class="card-title mb-2">{{ $topPublication->title }}</b></a>
                                        <br>
                                        <small>
                                            <i class="bi bi-clock"></i>
                                            {{ $topPublication->created_at->format('F d, Y') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
