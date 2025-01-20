@extends('home.layouts.main')

@section('contain')
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
                @if (session('success'))
                    <div class="col-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                <div class="col-10 col-lg-6 ms-lg-auto me-lg-auto">
                    <form action="/memberRegister" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h1 class="text-blue">Data Diri</h1>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control rounded-pill @error('name') is-invalid @enderror"
                                id="nama" name="name" placeholder="Type here" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="noTelp" class="form-label">Nomor Telepon</label>
                            <input type="number" class="form-control rounded-pill @error('phone') is-invalid @enderror"
                                id="noTelp" name="phone" placeholder="Type here" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control rounded-pill @error('email') is-invalid @enderror"
                                id="email" name="email" placeholder="Type here" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat Domisili</label>
                            <input type="text" class="form-control rounded-pill @error('address') is-invalid @enderror"
                                id="alamat" name="address" placeholder="Type here" value="{{ old('address') }}">
                            @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="ktp" class="form-label">Salinan KTP</label>
                            <input class="form-control @error('ktp') is-invalid @enderror" type="file" id="ktp"
                                name="ktp" value="{{ old('ktp') }}">
                            @error('ktp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="pasFoto" class="form-label">Pas Foto</label>
                            <input class="form-control @error('photo') is-invalid @enderror" type="file" name="photo"
                                id="pasFoto" value="{{ old('photo') }}">
                            @error('photo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                </div>
                <div class="col-10 col-lg-6 mt-4 mt-lg-0">
                    <h1 class="text-blue">Informasi Pekerjaan</h1>
                    <div class="mb-3">
                        <label for="namaInstansi" class="form-label">Nama Instansi/Firma Hukum/Perusahaan</label>
                        <input type="text" class="form-control rounded-pill @error('institution') is-invalid @enderror"
                            id="namaInstansi" name="institution" placeholder="Type here" value="{{ old('institution') }}">
                        @error('institution')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" class="form-control rounded-pill @error('position') is-invalid @enderror"
                            id="jabatan" name="position" placeholder="Type here" value="{{ old('position') }}">
                        @error('position')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="CompanyEmail" class="form-label">Email Perusahaan</label>
                        <input type="email"
                            class="form-control rounded-pill @error('company_email') is-invalid @enderror"
                            id="CompanyEmail" name="company_email" placeholder="Type here"
                            value="{{ old('company_email') }}">
                        @error('company_email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <span class="text-justify mb-5">Apakah sudah menjadi anggota asosiasi hukum lain?</span> <br>
                        <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" type="radio" name="is_member_of_other_legal_association"
                                id="inlineRadio1" value="1"
                                {{ old('is_member_of_other_legal_association', false) ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio1">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_member_of_other_legal_association"
                                id="inlineRadio2" value="0"
                                {{ old('is_member_of_other_legal_association', false) ? '' : 'checked' }}>
                            <label class="form-check-label" for="inlineRadio2">Belum Pernah</label>
                        </div>
                        @error('is_member_of_other_legal_association')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="sertifikatKHKI" class="form-label">Sertifikat Konsultan Hukum Keimigrasian</label>
                        <input class="form-control @error('immigration_law_consultant_certificate') is-invalid @enderror"
                            type="file" id="sertifikatKHKI" name="immigration_law_consultant_certificate"
                            value="{{ old('immigration_law_consultant_certificate') }}">
                        @error('immigration_law_consultant_certificate')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="sertifikasiLain" class="form-label">Sertifikasi Lain yang Relevan</label>
                        <input
                            class="form-control @error('other_certificates') is-invalid @enderror @error('other_certificates.*') is-invalid @enderror"
                            type="file" id="sertifikasiLain" name="other_certificates[]"
                            value="{{ old('other_certificates') }}" multiple>
                        @error('other_certificates')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        @error('other_certificates.*')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-10 col-lg-6 mt-4">
                    <b>Pernyataan Persetujuan</b>
                    <p><i>Dengan ini saya menyatakan bahwa data yang diberikan ini adalah benar dan bersedia mematuhi <a
                                href="/home/kodeEtik" target="_blank">kode
                                etik</a> PKHKI.</i></p>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                    </div>
                    <button type="submit" class="btn btn-blue rounded-pill w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- End Form Daftar Anggota -->
@endsection
