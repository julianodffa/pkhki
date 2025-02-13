<header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white font-times" href="#">PKHKI</a>

    <ul class="navbar-nav flex-row">
        {{-- <li class="nav-item text-nowrap">
            <form action="/logout" method="post">
                @csrf
                <button class="nav-link px-3 border-0 text-danger" href="/logout"><i class="bi bi-box-arrow-right"></i>
                    Logout</button>
            </form>
            <a class="nav-link px-3 text-danger" href="/logout">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </li> --}}
        <!-- Profile Dropdown -->
        <div class="dropdown px-3 my-auto position-relative">
            <button class="btn btn-sm btn-secondary" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                {{ Auth::user()->name }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end position-absolute mx-3">
                <li><a class="dropdown-item" href="/dashboard/users/{{ Auth::user()->email }}/change-password"><i class="bi bi-gear"></i> Change Password</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="/logout"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
            </ul>
        </div>
        <li class="nav-item text-nowrap d-md-none">
            <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="bi bi-list"></i>
            </button>
        </li>
        {{-- <li class="nav-item text-nowrap">
            <button class="nav-link px-3 text-white" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSearch" aria-controls="navbarSearch" aria-expanded="false"
                aria-label="Toggle search">
                <i class="bi bi-search"></i>
            </button>
        </li> --}}
    </ul>
    {{-- <div id="navbarSearch" class="navbar-search w-100 collapse">
        <input class="form-control w-100 rounded-0 border-0" type="text" placeholder="Search"
            aria-label="Search">
    </div> --}}
</header>
