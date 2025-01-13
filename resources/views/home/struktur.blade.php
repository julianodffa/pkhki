@extends("home.layouts.main")


@section("contain")
<!-- Carousel Struktur -->
<section id="section-1" class="section-1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-white">
                <h1 class="font-times fw-bold text-shadow">DEWAN KEHORMATAN</h1>
            </div>
        </div>
    </div>
</section>
<!-- End Carousel Struktur -->

<section id="section-2" class="section-2 mt-5">
    <div class="container">
        <!-- Navigation Tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="dewan-kehormatan-tab" data-bs-toggle="tab" data-bs-target="#dewan-kehormatan" type="button" role="tab" aria-controls="dewan-kehormatan" aria-selected="true">Dewan Kehormatan</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pengurus-tab" data-bs-toggle="tab" data-bs-target="#pengurus" type="button" role="tab" aria-controls="pengurus" aria-selected="false">Pengurus</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="dewan-standar-tab" data-bs-toggle="tab" data-bs-target="#dewan-standar" type="button" role="tab" aria-controls="dewan-standar" aria-selected="false">Dewan Standar</button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content my-5" id="tab-content">
            <!-- Dewan Kehormatan -->
            <div class="tab-pane fade show active" id="dewan-kehormatan" role="tabpanel" aria-labelledby="dewan-kehormatan-tab">
                <div class="row justify-content-evenly">
                    <div class="col col-10 col-lg-3 align-self-center p-0 text-center">
                        <img src="{{ asset('assets/images/struktur-card.png') }}" alt="Avatar" class="img-fluid">
                        <div class="title">
                            <p class="h-100 p-2 row justify-content-center align-items-center">
                                <span>
                                    <b>Jufrian Murzal</b><br>
                                    <i>Ketua Umum</i>
                                </span>
                            </p>
                        </div>
                        <div class="overlay">
                            <div class="row justify-content-center h-100 text-start py-4">
                                <div class="col-10 align-self-start">
                                    <b class="d-block">Jufrian Murzal</b>
                                    <i>Ketua Umum</i>
                                </div>
                                <div class="col-10 align-self-end">
                                    <b class="d-block">Kantor Hukum</b>
                                    Murzal and Partners <br>
                                    <b class="d-block">Kontak</b>
                                    jufrianmurzal@pkhki.com
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column Break -->
                    <div class="w-100 mb-3"></div>
                    <div class="col col-10 col-lg-3 align-self-center p-0 text-center mb-3">
                        <img src="{{ asset('assets/images/struktur-card.png') }}" alt="Avatar" class="img-fluid">
                        <div class="title">
                            <p class="h-100 p-2 row justify-content-center align-items-center">
                                <span>
                                    <b>James Junior</b><br>
                                    <i>Wakil Ketua Umum Bidang Pendidikan dan Sertifikasi</i>
                                </span>
                            </p>
                        </div>
                        <div class="overlay">
                            <div class="row justify-content-center h-100 text-start py-4">
                                <div class="col-10 align-self-start">
                                    <b class="d-block">James Junior</b>
                                    <i>Wakil Ketua Umum Bidang Pendidikan dan Sertifikasi</i>
                                </div>
                                <div class="col-10 align-self-end">
                                    <b class="d-block">Kantor Hukum</b>
                                    Murzal and Partners <br>
                                    <b class="d-block">Kontak</b>
                                    jamesjunior@pkhki.com
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col col-10 col-lg-3 align-self-center p-0 text-center mb-3">
                        <img src="{{ asset('assets/images/struktur-card.png') }}" alt="Avatar" class="img-fluid">
                        <div class="title">
                            <p class="h-100 p-2 row justify-content-center align-items-center">
                                <span>
                                    <b>Yanma Aditya Pratama</b><br>
                                    <i>Wakil Ketua Umum Bidang Pendidikan dan Sertifikasi</i>
                                </span>
                            </p>
                        </div>
                        <div class="overlay">
                            <div class="row justify-content-center h-100 text-start py-4">
                                <div class="col-10 align-self-start">
                                    <b class="d-block">Yanma Aditya Pratama</b>
                                    <i>Wakil Ketua Umum Bidang Pendidikan dan Sertifikasi</i>
                                </div>
                                <div class="col-10 align-self-end">
                                    <b class="d-block">Kantor Hukum</b>
                                    Murzal and Partners <br>
                                    <b class="d-block">Kontak</b>
                                    yanmap@pkhki.com
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col col-10 col-lg-3 align-self-center p-0 text-center mb-3">
                        <img src="{{ asset('assets/images/struktur-card.png') }}" alt="Avatar" class="img-fluid">
                        <div class="title">
                            <p class="h-100 p-2 row justify-content-center align-items-center">
                                <span>
                                    <b>Salsabila</b><br>
                                    <i>Wakil Ketua Umum Bidang Pendidikan dan Sertifikasi</i>
                                </span>
                            </p>
                        </div>
                        <div class="overlay">
                            <div class="row justify-content-center h-100 text-start py-4">
                                <div class="col-10 align-self-start">
                                    <b class="d-block">Salsabila</b>
                                    <i>Wakil Ketua Umum Bidang Pendidikan dan Sertifikasi</i>
                                </div>
                                <div class="col-10 align-self-end">
                                    <b class="d-block">Kantor Hukum</b>
                                    Murzal and Partners <br>
                                    <b class="d-block">Kontak</b>
                                    salsabila@pkhki.com
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 mb-3"></div>
                </div>
            </div>

            <!-- Pengurus -->
            <div class="tab-pane fade" id="pengurus" role="tabpanel" aria-labelledby="pengurus-tab">
                <div class="mt-4">
                    <h4>Pengurus</h4>
                    <p>Konten untuk pengurus akan ditampilkan di sini.</p>
                </div>
            </div>

            <!-- Dewan Standar -->
            <div class="tab-pane fade" id="dewan-standar" role="tabpanel" aria-labelledby="dewan-standar-tab">
                <div class="mt-4">
                    <h4>Dewan Standar</h4>
                    <p>Konten untuk dewan standar akan ditampilkan di sini.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection