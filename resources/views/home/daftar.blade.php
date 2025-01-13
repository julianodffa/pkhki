@extends("home.layouts.main")

@section("contain")
<!-- Carousel Daftar Anggota -->
<section id="section-1" class="section-1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-white">
                <h1 class="font-times fw-bold text-shadow">DAFTAR ANGGOTA</h1>
            </div>
        </div>
    </div>
</section>
<!-- End Carousel Daftar Anggota -->

<!-- Form Daftar Anggota -->
<section id="section-2" class="section-2">
    <div class="container">
        <div class="row my-5 justify-content-lg-start justify-content-center">
            <div class="col-10 col-lg-6 ms-lg-auto me-lg-auto">
                <form id="file-form">
                    <h1 class="text-blue">Data Diri</h1>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control rounded-pill" id="nama" placeholder="Type here">
                    </div>
                    <div class="mb-3">
                        <label for="noTelp" class="form-label">Nomor Telepon</label>
                        <input type="number" class="form-control rounded-pill" id="noTelp" placeholder="Type here">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control rounded-pill" id="email" placeholder="Type here">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Domisili</label>
                        <input type="text" class="form-control rounded-pill" id="alamat" placeholder="Type here">
                    </div>
                    <div class="mb-3">
                        <label for="ktp" class="form-label">Salinan KTP</label>
                        <input class="form-control" type="file" id="ktp">
                    </div>
                    <div class="mb-3">
                        <label for="pasFoto" class="form-label">Pas Foto</label>
                        <input class="form-control" type="file" id="pasFoto">
                    </div>
            </div>
            <div class="col-10 col-lg-6 mt-4 mt-lg-0">
                <h1 class="text-blue">Informasi Pekerjaan</h1>
                <div class="mb-3">
                    <label for="namaInstansi" class="form-label">Nama Instansi/Firma Hukum/Perusahaan</label>
                    <input type="text" class="form-control rounded-pill" id="namaInstansi" placeholder="Type here">
                </div>
                <div class="mb-3">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <input type="text" class="form-control rounded-pill" id="jabatan" placeholder="Type here">
                </div>
                <div class="mb-3">
                    <label for="bidangPraktik" class="form-label">Email</label>
                    <input type="text" class="form-control rounded-pill" id="bidangPraktik" placeholder="Type here">
                </div>
                <div class="mb-3">
                    <span class="text-justify mb-5">Apakah sudah menjadi anggota asosiasi hukum lain?</span> <br>
                    <div class="form-check form-check-inline mt-3">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                        <label class="form-check-label" for="inlineRadio1">Ya</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                        <label class="form-check-label" for="inlineRadio2">Belum Pernah</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="sertifikatKHKI" class="form-label">Sertifikat Konsultan Hukum Keimigrasian</label>
                    <input class="form-control" type="file" id="sertifikatKHKI">
                </div>
                <div class="mb-3">
                    <label for="sertifikasiLain" class="form-label">Sertifikasi Lain yang Relevan</label>
                    <input class="form-control" type="file" id="sertifikasiLain">
                </div>
            </div>
            <div class="col-10 col-lg-6 mt-4">
                <b>Pernyataan Persetujuan</b>
                <p><i>Dengan ini saya menyatakan bahwa data yang diberikan ini adalah benar dan bersedia mematuhi kode etik PKHKI.</i></p>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                </div>
                <button type="submit" class="btn btn-blue rounded-pill w-100">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- End Form Daftar Anggota -->
@endsection