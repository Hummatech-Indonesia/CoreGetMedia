@section('style')
    <style>
        .btn-home {
            color: black;
            text-decoration: none;
        }

        .btn-home:hover {
            color: #175A95;
        }
    </style>
@endsection

<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link sidebartoggler nav-icon-hover ms-n3" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav quick-links d-none d-lg-flex">
            <div class="d-flex">
                <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                </button>
                <div>
                    <a href="/" class="btn-home">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 24"
                            class="mb-1">
                            <path fill="currentColor"
                                d="M6 19h3v-5q0-.425.288-.712T10 13h4q.425 0 .713.288T15 14v5h3v-9l-6-4.5L6 10zm-2 0v-9q0-.475.213-.9t.587-.7l6-4.5q.525-.4 1.2-.4t1.2.4l6 4.5q.375.275.588.7T20 10v9q0 .825-.588 1.413T18 21h-4q-.425 0-.712-.288T13 20v-5h-2v5q0 .425-.288.713T10 21H6q-.825 0-1.412-.587T4 19m8-6.75" />
                        </svg>
                        <span class="ms-1">Beranda</span>
                    </a>
                </div>
            </div>
        </ul>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <div class="d-flex align-items-center justify-content-between">
                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
                    <li class="nav-item">
                        <div class="d-none d-md-flex flex-column align-items-end justify-content-center me-2">
                            <span class="text-dark fs-3 fw-semibold lh-1 mb-1 username"></span>
                            <span class="text-dark fs-3 fw-bold lh-1 role"></span>
                        </div>
                    </li>
                    <li class="nav item">
                        <div class="d-flex align-items-center">
                            <span class="badge bg-light-primary text-primary me-1"
                                style="font-size: 16px">{{ auth()->user()->roles->pluck('name')[0] }}</span>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <div class="">
                                    <img src="{{ asset(Auth::user()->image ? 'storage/' . Auth::user()->image : 'default.png') }}"
                                        class="rounded-circle user-profile" style="object-fit: cover" width="35"
                                        height="35" alt="" />
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                            aria-labelledby="drop1">
                            <div class="profile-dropdown position-relative" data-simplebar>
                                <div class="py-3 px-7 pb-0">
                                    <h5 class="mb-0 fs-5 fw-semibold">User Profile</h5>
                                </div>
                                <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                                    <img src="{{ asset(Auth::user()->image ? 'storage/' . Auth::user()->image : 'default.png') }}"
                                        class="rounded-circle user-profile" style="object-fit: cover" width="80"
                                        height="80" alt="" />
                                    <div class="ms-3">
                                        <h5 class="mb-1 fs-3 username">{{ auth()->user()->name }}</h5>
                                        <span
                                            class="mb-1 d-block text-dark role">{{ auth()->user()->roles->pluck('name')[0] }}</span>
                                        <p class="mb-0 d-flex text-dark align-items-center gap-2 email">
                                            <i class="ti ti-mail fs-4"></i>
                                            {{ auth()->user()->email }}
                                        </p>
                                    </div>
                                </div>
                                <div class="message-body">
                                    <a class="py-8 px-7 mt-8 d-flex align-items-center"
                                        href="{{ route('profile-update.user') }}">
                                        <span
                                            class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                                            <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-account.svg"
                                                alt="" width="24" height="24">
                                        </span>
                                        <div class="w-75 d-inline-block v-middle ps-3">
                                            <h6 class="mb-1 bg-hover-primary fw-semibold"> Profile Ku </h6>
                                            <span class="d-block text-dark">Setting Akun</span>
                                        </div>
                                    </a>
                                </div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <div class="d-grid py-4 px-7 pt-8">
                                        <button class="btn btn-outline-primary" id="logoutBtn">Log Out</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
