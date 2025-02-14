@include('home.layouts.header')

<div id="Page-1" class="vh-100 d-flex justify-content-center align-items-center">
    <div class="container mx-3">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4 bg-white p-5 rounded-5">
                <h1 class="text-start mb-3 pb-2 border-bottom">Verifikasi Email</h1>
                <form action="/newsletter/verify" method="post">
                    @csrf
                    <input type="hidden" class="form-control rounded-start-pill" name="email"
                        value="{{ $email }}">
                    @error('email')
                        <div class="alert alert-danger d-flex align-items-center font-poppins mt-2" role="alert">
                            <div>
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </div>
                        </div>
                    @enderror

                    @if (session('error'))
                        <div class="alert alert-danger d-flex align-items-center font-poppins mt-2" role="alert">
                            <div>
                                <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
                            </div>
                        </div>
                    @elseif (session('success'))
                        <div class="alert alert-success d-flex align-items-center font-poppins mt-2" role="alert">
                            <div>
                                <i class="bi bi-check-circle"></i> {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    <div class="mb-3">
                        <input type="text" class="form-control rounded-pill @error('otp_code') is-invalid @enderror"
                            id="otp_code" name="otp_code" placeholder="Masukkan OTP disini"
                            value="{{ old('otp_code') }}" required>
                        @error('otp_code')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-blue form-control rounded-pill mb-2">Verifikasi Email</button>
                    <a href="/" class="btn btn-secondary form-control rounded-pill">Kembali ke
                        Halaman Home</a>
                </form>
            </div>
        </div>
    </div>
</div>
