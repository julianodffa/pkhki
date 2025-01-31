    <!-- Footer -->
    <div class="footer bg-light-gray text-white" id="footer">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center text-center py-5">
                <div class="col-lg-3 text-start">
                    <img src="{{ asset('assets/icons/pkhki-footer.png') }}" alt="Logo Sinnar" class="img-fluid ms-auto">
                </div>
                <div class="col-lg-5 ms-lg-auto text-start">
                    <ul class>
                        <li><i class="me-3 bi bi-geo-alt-fill"></i>Artha Graha Building, Lv. 26, SCBD, South Jakarta</li>
                        <li><i class="me-3 bi bi-telephone-fill"></i>(123) 456-7890</li>
                        <li><i class="me-3 bi bi-printer-fill"></i>(123) 456-7890</li>
                        <li>Social Media <i class="ms-3 bi bi-facebook"></i><i class="ms-4 bi bi-linkedin"></i><i
                                class="ms-4 bi bi-youtube"></i><i class="ms-4 bi bi-instagram"></i></li>
                    </ul>
                </div>
                <div class="border-bottom mt-4 mb-3"></div>
                <div class="col-12 col-lg-6 menu">
                    <a href="/tentang-kami">TENTANG</a>
                    <a href="/anggota">ANGGOTA</a>
                    <a href="/kode-etik">KODE ETIK</a>
                    <a href="/publikasi">PUBLIKASI</a>
                    <a href="/kontak">KONTAK</a>
                </div>
                <div class="col-12 col-lg-6 copyright mt-3 mt-lg-0">
                    <p class="text-center mb-0">Copyright © 2024 • Perhimpunan Konsultasi Hukum Keimigrasian</p>
                </div>
            </div>
        </div>
    </div>

    {{-- JS --}}
    {{-- Important --}}
    {{-- Bootstrap Bundle --}}
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    {{-- Scroll Reveal --}}
    <script src="{{ asset('assets/js/scrollreveal/scrollreveal.js') }}"></script>
    <script src="{{ asset('assets/js/scrollreveal/scrollreveal-trigger.js') }}"></script>
    {{-- Custom JS --}}
    <script src="{{ asset('assets/js/home/app.js') }}"></script>

    {{-- Optional --}}
    @if (!empty($javascript))
        @foreach ($javascript as $js)
            <script src="{{ $js }}"></script>
        @endforeach
    @endif
    </body>

    </html>
