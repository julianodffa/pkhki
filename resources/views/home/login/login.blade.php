@include('home.layouts.header')

<div id="Page-1" class="vh-100 d-flex justify-content-center align-items-center">
    <div class="container mx-3">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4 bg-white p-5 rounded-5">
                <h1 class="text-start border-bottom pb-2 mb-4 font-poppins-bold">Login</h1>
                <form action="/login" method="post">
                    @csrf
                    @if (session('error'))
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <div>
                                <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
                            </div>
                        </div>
                    @elseif (session('status'))
                        <div class="alert alert-success d-flex align-items-center font-poppins" role="alert">
                            <div>
                                <i class="bi bi-check-circle"></i> {{ session('status') }}
                            </div>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control rounded-pill @error('email') is-invalid @enderror"
                            id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password"
                                class="form-control rounded-start-pill @error('password') is-invalid @enderror"
                                id="password" name="password" required>
                            <button type="button" class="btn btn-outline-secondary rounded-end-pill"
                                id="togglePassword">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <a href="/lupa-password" class="text-decoration-none text-dark font-poppins">Lupa Password?</a>
                    </div>
                    <button type="submit" class="btn btn-blue form-control rounded-pill">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        let passwordField = document.getElementById('password');
        let icon = this.querySelector('i');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            passwordField.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    });
</script>
