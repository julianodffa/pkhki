<!-- Newsletter -->
<section id="newsletter" class="newsletter">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center text-center py-5 my-5">
            <div class="col-12 top-frame mb-4 mb-lg-5">
                <p class="text-blue mb-0"><b>Newsletter</b></p>
                <p class="text-dark-blue font-times fw-bold fs-1">Subscribe PKHKI’s Latest Update</p>
            </div>
            <div class="col-12 col-lg-8">
                <form class="subscribe-form" action="/newsletter/subscribe" method="POST">
                    @csrf
                    <input type="email" placeholder="Enter your email address" name="email" autocomplete="off"
                        value="{{ old('email') }}" required>
                    <button type="submit">Subscribe</button>
                </form>
                @error('email')
                    <div class="alert alert-danger d-flex align-items-center font-poppins mt-2" role="alert">
                        <div>
                            <i class="bi bi-exclamation-triangle-fill"></i> {{ $message }}
                        </div>
                    </div>
                @enderror
                @if (session('status'))
                    <div class="alert alert-success d-flex align-items-center font-poppins mt-2" role="alert">
                        <div>
                            <i class="bi bi-check-circle"></i> {{ session('status') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- End Newsletter -->
