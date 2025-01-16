<!-- Navbar -->
<nav id="navbar-example2" class="navbar navbar-expand-lg fixed-top bg-white shadow" aria-label="Offcanvas navbar large">
    <div class="container-fluid container-xxl">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('assets/icons/pkhki.png') }}" alt="Logo PKHKI">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2"
            aria-controls="offcanvasNavbar2" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-light" tabindex="-1" id="offcanvasNavbar2"
            aria-labelledby="offcanvasNavbar2Label">
            <div class="offcanvas-header">
                <p class="text-blue font-times">PKHKI</p>
                <button type="button" class="ms-auto btn-close btn-close-dark" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body font-opensans">
                <ul class="navbar-nav justify-content-center flex-grow-1">
                    <li class="nav-item {{ $title == "Tentang Kami" ? "active" : "" }} mx-lg-3 my-1 my-lg-0">
                        <a class="nav-link" aria-current="page" href="/tentang-kami">Tentang</a>
                    </li>
                    <li class="nav-item {{ $title == "Struktur Organisasi" ? "active" : "" }} mx-lg-3 my-1 my-lg-0">
                        <a class="nav-link" aria-current="page" href="/struktur">Struktur</a>
                    </li>
                    <li class="nav-item {{ $title == "Kode Etik" ? "active" : "" }} mx-lg-3 my-1 my-lg-0">
                        <a class="nav-link" aria-current="page" href="/kode-etik">Kode Etik</a>
                    </li>
                    <li class="nav-item {{ $title == "Anggota" ? "active" : "" }} mx-lg-3 my-1 my-lg-0">
                        <a class="nav-link" aria-current="page" href="/anggota">Anggota</a>
                    </li>
                    <li class="nav-item {{ $title == "Publikasi" ? "active" : "" }} mx-lg-3 my-1 my-lg-0">
                        <a class="nav-link" aria-current="page" href="/publikasi">Publikasi</a>
                    </li>
                    <li class="nav-item {{ $title == "Kegiatan" ? "active" : "" }} mx-lg-3 my-1 my-lg-0">
                        <a class="nav-link" aria-current="page" href="/kegiatan">Kegiatan</a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <span class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Produk
                        </span>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="products/sinnardigitalsignage">Digital Signage</a></li>
                            <li><a class="dropdown-item" href="products/sinnaranjungan">Sinnar Anjungan</a></li>
                            <li><a class="dropdown-item" href="products/sinnarrouter">Sinnar Router</a></li>
                        </ul>
                    </li> -->
                </ul>
                <div class="d-flex mt-3 mt-lg-0 pe-5">
                    <a href="/daftar-anggota">
                        <button class="btn btn-blue px-3 py-2">Daftar Anggota</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

<div data-bs-spy="scroll" data-bs-target="#navbar-example2">
