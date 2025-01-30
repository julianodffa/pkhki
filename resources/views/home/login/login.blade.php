@include('home.layouts.header')

<div id="Page-1" class="vh-100 d-flex justify-content-center align-items-center">
    <div class="container mx-3">
        <div class="row justify-content-center">
            <div class="col-md-4 bg-white p-5 rounded-5">
                <h1 class="text-start">Login</h1>
                <form action="/login" method="post">
                    @csrf
                    @if (session('error'))
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <div>
                                <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
                            </div>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control rounded-pill @error('username') is-invalid @enderror"
                            id="username" name="username" value="{{ old('username') }}" required>
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control rounded-pill @error('password') is-invalid @enderror"
                            id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary form-control rounded-pill">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
