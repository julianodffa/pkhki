<div class="sidebar border col-md-3 col-lg-2 p-0 bg-body-tertiary position-fixed font-opensans">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu"
        aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header mt-5">
            <h5 class="offcanvas-title" id="sidebarMenuLabel">PKHKI</h5>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 mt-md-5 pt-md-3 overflow-y-auto">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class='nav-link d-flex align-items-center gap-2 {{ $title == 'PKHKI' ? 'active' : '' }}'
                        aria-current="page" href="/dashboard">
                        <i class="bi bi-house"></i>
                        Dashboard
                    </a>
                </li>
            </ul>
            <h6
                class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
                <span>Publications</span>
                <a class="link-secondary" href="#" aria-label="Add a new report">
                </a>
            </h6>
            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 {{ $title == 'Publications' ? 'active' : '' }}"
                        href="/dashboard/publications">
                        <i class="bi bi-file-earmark-richtext-fill"></i>
                        Publications
                    </a>
                </li>
            </ul>

            <h6
                class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
                <span>Structure</span>
                <a class="link-secondary" href="#" aria-label="Add a new report">
                </a>
            </h6>

            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 {{ $title == 'Structures' ? 'active' : '' }}"
                        href="/dashboard/structures">
                        <i class="bi bi-shield"></i>
                        Structures
                    </a>
                </li>
            </ul>

            <h6
                class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
                <span>Members</span>
                <a class="link-secondary" href="#" aria-label="Add a new report">
                </a>
            </h6>

            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 {{ $title == 'Registrants' ? 'active' : '' }}"
                        href="/dashboard/registrants">
                        <i class="bi bi-person-exclamation"></i>
                        Registrants
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 {{ $title == 'Members' ? 'active' : '' }}"
                        href="/dashboard/members">
                        <i class="bi bi-person-badge"></i>
                        Members
                    </a>
                </li>
            </ul>

            <h6
                class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
                <span>Newsletter</span>
                <a class="link-secondary" href="#" aria-label="Add a new report">
                </a>
            </h6>

            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 {{ $title == 'Newsletter Subscribers' ? 'active' : '' }}"
                        href="/dashboard/newsletter">
                        <i class="bi bi-newspaper"></i>
                        Subscribers
                    </a>
                </li>
            </ul>

            </h6>
            @if (Auth::user()->role == 'superadmin')
                <h6
                    class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
                    <span>Users</span>
                    <a class="link-secondary" href="#" aria-label="Add a new report">
                    </a>
                </h6>

                <ul class="nav flex-column mb-auto">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 {{ $title == 'Users' ? 'active' : '' }}"
                            href="/dashboard/users">
                            <i class="bi bi-people"></i>
                            Users
                        </a>
                    </li>
                </ul>
                </h6>
            @endif
        </div>
    </div>
</div>
