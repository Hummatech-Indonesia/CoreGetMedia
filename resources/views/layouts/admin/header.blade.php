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
                <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                </button>

                <a href="/" class="btn btn-primary">
                    Beranda
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 36 36"><path fill="currentColor" d="M33 19a1 1 0 0 1-.71-.29L18 4.41L3.71 18.71A1 1 0 0 1 2.3 17.3l15-15a1 1 0 0 1 1.41 0l15 15A1 1 0 0 1 33 19" class="clr-i-solid clr-i-solid-path-1"/><path fill="currentColor" d="M18 7.79L6 19.83V32a2 2 0 0 0 2 2h7V24h6v10h7a2 2 0 0 0 2-2V19.76Z" class="clr-i-solid clr-i-solid-path-2"/><path fill="none" d="M0 0h36v36H0z"/></svg> --}}
                </a>
            </div>
        </ul>

        <ul class="navbar-nav d-lg-none">
            <li class="nav-item dropdown">
                <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown"
                aria-expanded="false">
                <div class="d-flex align-items-center">
                        <div class="">
                            <img src="{{asset('admin/dist/images/profile/user-10.jpg')}}" class="rounded-circle user-profile"
                                style="object-fit: cover" width="35" height="35" alt="" />
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
                            <img src="{{asset('admin/dist/images/profile/user-10.jpg')}}" class="rounded-circle user-profile" style="object-fit: cover"
                                width="80" height="80" alt="" />
                            <div class="ms-3">
                                <h5 class="mb-1 fs-3 username">{{ auth()->user()->name }}</h5>
                                <span class="mb-1 d-block text-dark role">Admin</span>
                                <p class="mb-0 d-flex text-dark align-items-center gap-2 email">
                                    <i class="ti ti-mail fs-4"></i>
                                    {{ auth()->user()->email }}
                                </p>
                            </div>
                        </div>

                        <div class="message-body">
                            <a class="py-8 px-7 mt-8 d-flex align-items-center" href="#">
                                <span
                                    class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                                    {{-- <img src="{{ asset( Auth::user()->photo ? 'storage/'.Auth::user()->photo : "https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-account.svg")  }}" width="24" height="24" alt="" /> --}}
                                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-account.svg" alt="" width="24" height="24">
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
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                 {{ __('Logout') }}
                                </a>
                                {{-- <button class="btn btn-outline-primary" id="logoutBtn">Log Out</button> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </li>
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
                        <div class="d-none d-md-flex flex-column align-items-end justify-content-center">
                            <span class="mt-2 fs-4 lh-1 text-end fw-semibold">{{ auth()->user()->name }}</span>
                            <span class="fs-4 text-end">{{ auth()->user()->email }}</span>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <div class="">
                                    <img src="{{ asset( Auth::user()->image ? 'storage/'.Auth::user()->image : "default.png")  }}" class="rounded-circle user-profile"
                                        style="object-fit: cover" width="35" height="35" alt="" />
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
                                    <img src="{{asset('admin/dist/images/profile/user-10.jpg')}}" class="rounded-circle user-profile" style="object-fit: cover"
                                        width="80" height="80" alt="" />
                                    <div class="ms-3">
                                        <h5 class="mb-1 fs-3 username">{{ auth()->user()->name }}</h5>
                                        <span class="mb-1 d-block text-dark role">Admin</span>
                                        <p class="mb-0 d-flex text-dark align-items-center gap-2 email">
                                            <i class="ti ti-mail fs-4"></i>
                                            {{ auth()->user()->email }}
                                        </p>
                                    </div>
                                </div>
                                <div class="message-body">
                                    <a class="py-8 px-7 mt-8 d-flex align-items-center" href="#">
                                        <span
                                            class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                                            {{-- <img src="{{ asset( Auth::user()->photo ? 'storage/'.Auth::user()->photo : "https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-account.svg")  }}" width="24" height="24" alt="" /> --}}
                                            <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-account.svg" alt="" width="24" height="24">
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
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();">
                                         {{ __('Logout') }}
                                        </a>
                                        {{-- <button class="btn btn-outline-primary" id="logoutBtn">Log Out</button> --}}
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
