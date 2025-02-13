@include('home.layouts.header')

<div id="Page-1" class="vh-100 d-flex justify-content-center align-items-center">
    <div class="container mx-3">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4 bg-white p-5 rounded-5">
                <h1 class="text-start border-bottom pb-2 mb-4 font-poppins-bold">Lupa Password?</h1>
                <form action="/lupa-password" method="post">
                    @csrf
                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif
                    <div class="mb-3">
                        <p class="text-center font-poppins">Masukkan email Anda, kami akan mengirimkan tautan untuk
                            kembali ke akun Anda.</p>
                        <input type="text" class="form-control rounded-pill @error('email') is-invalid @enderror"
                            id="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-blue form-control rounded-pill mb-2">Reset</button>
                    <a href="/login" class="btn btn-secondary form-control rounded-pill">Kembali ke
                        Halaman Login</a>

                </form>
            </div>
        </div>
    </div>
</div>
