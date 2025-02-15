@extends('home.layouts.main')


@section('contain')
    <!-- Carousel Tentang -->
    <section id="section-1" class="section-1">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-white">
                    <h1 class="font-times text-shadow fw-bold">TENTANG PKHKI</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Carousel Tentang -->

    <!-- Sejarah -->
    <section id="section-2" class="section-2 bg-lg-gray text-white">
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
                <div class="col-10 col-lg-5 me-lg-auto ms-lg-auto scroll-left">
                    <h1 class="text-center text-lg-start font-times text-shadow fw-bold">SEJARAH</h1>
                    <p class="font-poppins text-justify">PKHKI merupakan perhimpunan yang didirikan sebagai wadah untuk
                        meningkatkan kredibilitas konsultan hukum keimigrasian melalui pengembangan profesionalisme,
                        standarisasi praktik serta meningkatkan kerja sama dengan otoritas terkait.</p>
                </div>
                <div class="col-10 col-lg-5 order-first order-lg-last wrapper d-none d-lg-block scroll-right">
                    <img src="{{ asset('assets/images/sejarah.png') }}" alt="Sejarah Image" class="img-fluid">
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- End Sejarah -->

    <!-- Visi & Misi Judul -->
    <section id="section-3" class="section-3">
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
                <div class="col-12">
                    <h1 class="text-blue font-times text-shadow text-center fw-bolder">VISI & MISI</h1>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- End Visi & Misi Judul -->

    <!-- Visi -->
    <section id="section-4" class="section-4 bg-blue text-white">
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
                <div class="col-10 col-lg-5 me-lg-auto ms-lg-auto scroll-right">
                    <h1 class="text-center text-lg-end font-times text-shadow fw-bolder">VISI</h1>
                    <p class="font-poppins text-justify">PKHKI bertujuan untuk menjadi himpunan pelaksana pelatihan jasa
                        keimigrasian yang memiliki kompetensi dalam menyelenggarakan dan memberikan sertifikasi berupa
                        keahlian konsultan hukum dalam memberikan konsultasi hukum keimigrasian serta menjembatani
                        disparitas kebijakan pemerintah melalui solusi praktis untuk meningkatkan efisiensi serta kepatuhan
                        hukum dalam proses keimigrasian dengan memastikan perlindungan terhadap kepentingan umum dan publik.
                    </p>
                </div>
                <div class="col-12 col-lg-5 order-first wrapper d-none d-lg-block p-0 scroll-left">
                    <img src="{{ asset('assets/images/visi.jpg') }}" alt="Sejarah Image" class="img-fluid">
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- End Visi -->

    <!-- BG-Image -->
    <section id="section-5" class="section-5">
    </section>

    <!-- Visi -->
    <section id="section-6" class="section-6 bg-blue text-white">
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
                <div class="col-10 col-lg-5 me-lg-auto ms-lg-auto scroll-left">
                    <h1 class="text-center text-lg-start font-times text-shadow fw-bolder">MISI</h1>
                    <ol class="font-poppins text-justify">
                        <li>Memfasilitasi kebijakan lembaga pemerintah dalam menyederhanakan dan meningkatkan kebijakan
                            keimigrasian;</li>
                        <li>Mengakomodir perkembangan dan penyempurnaan terhadap regulasi keimigrasian terhadap terhadap
                            kebutuhan hukum pada masa yang akan datang; dan</li>
                        <li>Melaksanakan kolaborasi dengan Kementerian Imigrasi dan Pemasyarakatan dengan menyediakan sarana
                            dan prasarana berupa pelatihan kemahiran hukum keimigrasian dan sertifikasi kepada calon
                            konsultan hukum keimigrasian dengan memastikan standar praktik yang terintegrasi.</li>
                    </ol>
                </div>
                <div class="col-12 col-lg-5 wrapper d-none d-lg-block p-0 scroll-right">
                    <img src="{{ asset('assets/images/misi.jpg') }}" alt="Sejarah Image" class="img-fluid">
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- End Visi -->

    @include('home.layouts.newsletter')
@endsection
