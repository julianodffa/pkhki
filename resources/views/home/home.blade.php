@extends('home.layouts.main')

@section('contain')
    <!-- Section 1 -->
    <section id="section-1" class="section-1 py-5">
        <div class="container">
            <div class="row d-flex justify-content-center text-center align-items-center text-white">
                <div class="col-10 ">
                    <h1 class="font-times text-shadow fw-bold mt-5 mb-5 pb-5">PERHIMPUNAN KONSULTAN <br> HUKUM KEIMIGRASIAN
                    </h1>
                </div>
                <div class="col-4 mb-5 text-center">
                    <div class="custom-box font-poppins fw-bold">
                        <p class="text-center">Kode Etik</p>
                    </div>
                </div>
                <div class="col-4 mb-5">
                    <div class="custom-box font-poppins fw-bold">
                        <p class="text-center">Standar Profesi</p>
                    </div>
                </div>
                <div class="col-4 mb-5">
                    <div class="custom-box font-poppins fw-bold">
                        <p class="text-center">Kegiatan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section 1 -->

    <!-- Berita -->
    <section id="section-2" class="section-2 py-5 bg-gray">
        <div class="container">
            <h1 class="text-white text-center mt-5 mb-5 pb-4 pb-lg-5 mb-lg-0 font-times text-shadow fw-bold">BERITA</h1>
            <div class="row d-flex justify-content-evenly text-center align-items-center">
                @if ($news->isNotEmpty())
                    @foreach ($news->take(3) as $n)
                        <div class="col-12 col-lg-4 mb-3 mb-lg-5">
                            <div class="card text-start border-0 text-blue">
                                <img src="{{ asset($n->cover) }}" class="card-img-top" alt="{{ $n->slug }}">
                                <div class="card-body mx-3">
                                    <p class="card-text">{!! $n->excerpt !!}</p>
                                    <a href="/{{ $n->slug }}" class="scroll-right">Read More <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 col-lg-3 mb-3 mb-lg-5">
                        <div class="card text-start border-0 w-100 text-blue" style="width: 18rem;">
                            <img src="{{ asset('assets/images/berita-card-1.png') }}" class="card-img-top" alt="...">
                            <div class="card-body mx-3">
                                <p class="card-text">Live Animal Air Freight According to WLive Animal Air Freight According
                                    to Warsaw Convention</p>
                                <a href="#">Read More <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3 mb-3 mb-lg-5">
                        <div class="card text-start border-0 w-100 text-blue" style="width: 18rem;">
                            <img src="{{ asset('assets/images/berita-card-2.png') }}" class="card-img-top" alt="...">
                            <div class="card-body mx-3">
                                <p class="card-text">Law No. 1 Year 2050
                                    Concerning Super Train
                                    Regulation Matrix</p>
                                <a href="#">Read More <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3 mb-3 mb-lg-5">
                        <div class="card text-start border-0 w-100 text-blue" style="width: 18rem;">
                            <img src="{{ asset('assets/images/berita-card-3.png') }}" class="card-img-top" alt="...">
                            <div class="card-body mx-3">
                                <p class="card-text">PT Laut Abadi Meneer was
                                    Reported of e-Bill of
                                    Lading Fraud</p>
                                <a href="#">Read More <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-12 scroll-down">
                    <a href="/kategori/berita" class="text-white fs-1 text-center">
                        <i class="bi bi-arrow-right-circle"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- End Berita -->

    <!-- Kegiatan -->
    <section id="section-3" class="section-3 py-lg-5 pt-3 pb-4">
        <div class="container">
            <h1 class="text-blue text-start mt-3 mt-lg-5 mb-3 mb-lg-0 pb-lg-5 font-times text-shadow fw-bold">KEGIATAN</h1>
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12 col-lg-11">
                    <img src="{{ asset('assets/images/kegiatan.png') }}" class="card-img-top" alt="...">
                </div>
                <div class="col-12 col-lg-1 text-center mt-3 scroll-right">
                    <a href="/kategori/kegiatan" class="fs-1 text-blue">
                        <i class="bi bi-arrow-right-circle"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- End Kegiatan -->

    <!-- Publikasi -->
    <section id="section-4" class="section-4 bg-blue">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="p-0 col-6 col-lg-8">
                    <img src="{{ asset('assets/images/publikasi.png') }}" class="card-img-top" alt="...">
                </div>
                <div class="p-0 col-6 col-lg-4 text-center">
                    <h1 class="text-white mt-3 mt-lg-5 mb-lg-0 pb-md-3 pb-lg-5 font-times text-shadow fw-bold">PUBLIKASI
                    </h1>
                    <a href="/publikasi" class="text-white fs-1 fade-in">
                        <i class="bi bi-arrow-right-circle"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- End Publikasi -->

    <!-- Asosiasi -->
    <section id="section-5" class="section-5">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center text-center py-5 my-5">
                <div class="col-12 top-frame mb-5 mb-lg-5">
                    <h1 class="text-blue mb-lg-0 pb-3 font-times fw-bold">Our Association in Numbers</h1>
                    <p class="text-blue font-poppins sub-title">Our Associates track record is backed by measurable success
                        in immigration law.</p>
                </div>
                <div class="number col-12 col-md-6 col-lg-2 mb-4 mb-md-5 mb-lg-0 px-0">
                    <h1 class="font-poppins-bold text-gray" data-number="120">120</h1>
                    <p class="font-opensans text-blue">TOTAL CASES</p>
                </div>
                <div class="number col-12 col-md-6 col-lg-2 mb-4 mb-md-5 mb-lg-0 px-0">
                    <h1 class="font-poppins-bold text-gray" data-number="100">100</h1>
                    <p class="font-opensans text-blue">SUCCESS CASE</p>
                </div>
                <div class="number col-12 col-md-6 col-lg-2 mb-4 mb-md-5 mb-lg-0 px-0">
                    <h1 class="font-poppins-bold text-gray" data-number="22">22</h1>
                    <p class="font-opensans text-blue">EXPERTISE AREA</p>
                </div>
                <div class="number col-12 col-md-6 col-lg-2 mb-4 mb-md-5 mb-lg-0 px-0">
                    <h1 class="font-poppins-bold text-gray" data-number="8">8</h1>
                    <p class="font-opensans text-blue">GLOBAL REACH</p>
                </div>
            </div>
        </div>
    </section>
    <!-- End Asosiasi -->

    <!-- Partnership -->
    <section id="section-6" class="section-6 py-5 bg-gray">
        <div class="container">
            <h1 class="text-white mt-5 mb-5 mb-lg-0 pb-4 pb-lg-5 text-center font-times text-shadow fw-bold">
                PARTNERSHIP
            </h1>
            <div class="row d-flex justify-content-evenly text-start align-items-center">
                <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-5">
                    <img src="{{ asset('assets/images/partnership.png') }}" class="img-fluid" alt="...">
                    <p class="text-white mt-4">World Law Alliance (WLA) is a global law practice and service platform with
                        member firms in 70+ jurisdictions. As part of the world's largest Law Alliance, Murzal & Partners
                        ("MNP") offers global expertise, helping businesses navigate complex regulatory landscapes
                        worldwide.</p>
                    <a class="font-poppins scroll-right" href="#">Go to link <i class="bi bi-arrow-right"></i></a>
                </div>
                <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-5">
                    <img src="{{ asset('assets/images/partnership.png') }}" class="img-fluid" alt="...">
                    <p class="text-white mt-4">Xpath.Global, a global mobility service provider since 2007, addresses
                        industry challenges through a tech suite developed since 2018. Launched in 2019, Xpath's Beta
                        version responds to the evolving needs of the Global Mobility sector. As a member, Murzal & Partners
                        recognizes.</p>
                    <a class="font-poppins scroll-right" href="#">Go to link <i class="bi bi-arrow-right"></i></a>
                </div>
                <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-5">
                    <img src="{{ asset('assets/images/partnership.png') }}" class="img-fluid" alt="...">
                    <p class="text-white mt-4">Xpath.Global, a global mobility service provider since 2007, addresses
                        industry challenges through a tech suite developed since 2018. Launched in 2019, Xpath's Beta
                        version responds to the evolving needs of the Global Mobility sector. As a member, Murzal & Partners
                        recognizes.</p>
                    <a class="font-poppins scroll-right" href="#">Go to link <i class="bi bi-arrow-right"></i></a>
                </div>
                <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-5">
                    <img src="{{ asset('assets/images/partnership.png') }}" class="img-fluid" alt="...">
                    <p class="text-white mt-4">Xpath.Global, a global mobility service provider since 2007, addresses
                        industry challenges through a tech suite developed since 2018. Launched in 2019, Xpath's Beta
                        version responds to the evolving needs of the Global Mobility sector. As a member, Murzal & Partners
                        recognizes.</p>
                    <a class="font-poppins scroll-right" href="#">Go to link <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- End Partnership -->

    <!-- Newsletter -->
    <section id="newsletter" class="newsletter">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center text-center py-5 my-5">
                <div class="col-12 top-frame mb-4 mb-lg-5">
                    <p class="text-blue mb-0"><b>Newsletter</b></p>
                    <p class="text-dark-blue font-times fw-bold fs-1">Subscribe PKHKI’s Latest Update</p>
                </div>
                <div class="col-12 col-lg-8">
                    <form class="subscribe-form" action="/subscribe" method="POST">
                        <input type="email" placeholder="Enter your email address" name="email" autocomplete="off"
                            required>
                        <button type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- End Newsletter -->
@endsection
