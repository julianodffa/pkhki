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
                    @csrf
                    <input type="email" placeholder="Enter your email address" name="email" autocomplete="off" required>
                    <button type="submit">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- End Newsletter -->