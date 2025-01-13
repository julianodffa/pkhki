@extends("home.layouts.main")

@section("contain")
<!-- Carousel Kontak -->
<section id="section-1" class="section-1">
</section>
<!-- End Carousel Kontak -->

<!-- Form Kontak -->
<section id="section-2" class="section-2">
    <div class="container">
        <div class="row justify-content-start">
            <div class="col-12 col-lg-6">
                <h1 class="pb-3 pt-5">Informasi Terbaru</h1>
                <form>
                    <div class="mb-3">
                        <input class="rounded-pill form-control" type="text" placeholder="Nama">
                    </div>
                    <div class="mb-3">
                        <input class="rounded-pill form-control" type="email" placeholder="Email">
                    </div>
                    <button type="submit" class="rounded-pill btn btn-blue w-100">Berlangganan</button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- End Form Kontak -->

<!-- Divider -->
<section id="divider" class="container mt-5 mb-3">
    <div class="text-center custom-divider">
        <h1>Kontak</h1>
    </div>
</section>
<!-- End Divider -->

<!-- Kontak -->
<section id="section-3" class="section-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td style="width: 20%;">Email</td>
                            <td>info@pkhki.org</td>
                        </tr>
                        <tr>
                            <td>Sosial Media</td>
                            <td>
                                <div class="social-icons d-flex">
                                    <a href="#"><img src="https://img.icons8.com/color/48/instagram-new--v1.png" alt="Instagram"></a>
                                    <a href="#"><img src="https://img.icons8.com/color/48/facebook.png" alt="Facebook"></a>
                                    <a href="#"><img src="https://img.icons8.com/color/48/linkedin.png" alt="LinkedIn"></a>
                                    <a href="#"><img src="https://img.icons8.com/color/48/youtube-play.png" alt="YouTube"></a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>
                                ARTHA GRAHA BUILDING 26TH FLOOR, SUDIRMAN CENTRAL BUSINESS DISTRICT, LOT 25.
                                JL. JEND. SUDIRMAN KAV 52-53, Senayan Sub-district, Kebayoran Baru District,
                                South Jakarta City, DKI Jakarta Province 12190. <br>
                                <a href="https://maps.app.goo.gl/AytKkFEasWRE1tJ9A" target="_blank">klik di sini</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- End Kontak -->

<!-- Map  -->


<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15865.1881591759!2d106.8111093!3d-6.2245096!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5a08159a3b5%3A0x5d4414a7e8dbf154!2sMurzal%20%26%20Partners%20Law%20Firm!5e0!3m2!1sen!2sid!4v1732514237315!5m2!1sen!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" id="map"></iframe>


<!-- End Map  -->
@endsection