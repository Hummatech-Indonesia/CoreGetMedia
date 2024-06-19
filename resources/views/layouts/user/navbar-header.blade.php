
<head>
    <style>
        .notification {
            content: "";
            position: absolute;
            top: 22px;
            right: 1px;
            width: 13px;
            height: 13px;
        }
        .rounded-circle {
            border-radius: 50% !important;
        }
        .bg-primary {
            --bs-bg-opacity: 1;
            background-color: rgba(var(--bs-danger-rgb), var(--bs-bg-opacity)) !important;
        }
        .btn-two {
            background-color: #175A95;
        }
        .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu {
            width: auto;
        }
    </style>
    <style>
        .nav-link.active {
            color: #E93314;
        }
    </style>
</head>

<div class="navbar-area header-one" id="navbar">
    <div class="header-top">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-6 col-5">
                    {{-- <button class="subscribe-btn" data-bs-toggle="modal" data-bs-target="#newsletter-popup">Berlangganan<i class="flaticon-right-arrow"></i></button> --}}
                </div>
                <div class="col-lg-4 col-md-6 md-none">
                    <a class="navbar-brand" href="index.html">
                        <img class="logo-light" src="{{asset('assets/img/logo/get-media-light.svg')}}" alt="logo" />
                        <img class="logo-dark" src="{{asset('assets/img/logo/get-media-light.svg')}}" alt="logo" />
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 col-7">
                    <ul class="social-profile list-style">
                        <li>
                            <a href="https://www.fb.com/" target="_blank"><i class="ri-facebook-fill"></i></a>
                        </li>
                        <li>
                            <a href="https://www.twitter.com/" target="_blank"><i class="ri-twitter-fill"></i></a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/" target="_blank"><i class="ri-instagram-line"></i></a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com/" target="_blank"><i class="ri-linkedin-fill"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg">
            <a class="sidebar-toggler md-none d-flex" data-bs-toggle="offcanvas" href="#navbarOffcanvas" role="button" aria-controls="navbarOffcanvas">
                <img src="{{asset('assets/img/icons/menubar-white.svg')}}" alt="Image" />
                <div class="ms-4 mt-3">
                    @php
                        use Carbon\Carbon;
                        Carbon::setLocale('id');
                        $today = Carbon::now()->isoFormat('dddd, D MMMM YYYY');
                    @endphp
                    <p class="text-white">{{ $today }}</p>
                </div>
            </a>
            <a class="navbar-brand d-lg-none" href="/">
                <img class="logo-light" src="{{asset('assets/img/logo/get-media-light.svg')}}" alt="logo" />
                <img class="logo-dark" src="{{asset('assets/img/logo/get-media-light.svg')}}" alt="logo" />
            </a>
            <button type="button" class="search-btn d-lg-none" data-bs-toggle="modal" data-bs-target="#searchModal" style="margin-top: 12px;">
                <i class="flaticon-loupe"></i>
            </button>
            <a class="navbar-toggler" data-bs-toggle="offcanvas" href="#navbarOffcanvas" role="button" aria-controls="navbarOffcanvas">
                <span class="burger-menu">
                    <span class="top-bar"></span>
                    <span class="middle-bar"></span>
                    <span class="bottom-bar"></span>
                </span>
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a href="/" class="nav-link" style="{{ request()->routeIs('home') ? 'color: #E93314;' : '' }}">Beranda</a>
                    </li>
                    @foreach ($categories as $category)
                        @php
                            $isActiveCategory = false;

                            if(request()->routeIs('news.subcategory')) {
                                $subCategory = $subCategories->where('slug', request()->route('slug'))->first();
                                if($subCategory && $subCategory->category_id === $category->id) {
                                    $isActiveCategory = true;
                                }
                            }
                        @endphp

                        <li class="nav-item">
                            <a href="{{ route('categories.show.user', ['category' => $category->slug]) }}" class="dropdown-toggle nav-link" style="{{ $isActiveCategory ? 'color: #E93314;' : '' }}">
                                {{ $category->name }}
                            </a>
                            @if (count($subCategories->where('category_id', $category->id)) > 0)
                                <ul class="dropdown-menu">
                                    <div class="d-flex">
                                        <li class="nav-item">
                                            @forelse ($subCategories->where('category_id', $category->id) as $subCategory)
                                                @php
                                                    $isActive = Route::currentRouteName() == 'news.subcategory' && request()->route('slug') == $subCategory->slug;
                                                @endphp

                                                <a href="{{ route('news.subcategory', ['slug' => $subCategory->slug]) }}" class="nav-link {{ $isActive ? 'active' : '' }}" style="{{ $isActive ? 'color: #E93314;' : '' }}">
                                                    {{ Str::limit($subCategory->name, 50) }}
                                                </a>

                                                @if(($loop->iteration % 5) == 0)
                                                    </li>
                                                    <li class="nav-item">
                                                @endif
                                            @empty
                                                <div class="nav-link">
                                                    Data Kosong
                                                </div>
                                            @endforelse
                                        </li>
                                    </div>
                                </ul>
                            @else
                                <ul class="dropdown-menu">
                                    <div class="d-flex">
                                        <div class="nav-item">
                                            <p class="nav-link">
                                                Data Kosong
                                            </p>
                                        </div>
                                    </div>
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
                <div class="others-option d-flex align-items-center">
                    <div class="option-item">
                        <button type="button" class="search-btn" data-bs-toggle="modal" data-bs-target="#searchModal">
                            <i class="flaticon-loupe"></i>
                        </button>
                    </div>

                    @auth
                        <div class="option-item">
                            <ul class="navbar-nav">

                                <li class="nav-item">
                                    <a href="javascript:void(0)" class="nav-link">
                                        <img src="{{ asset( Auth::user()->image ? 'storage/'.Auth::user()->image : "default.png")  }}" class="mb-2" alt="Image" width="40" height="40" style="min-width: 40px;border-radius: 50%;object-fit:cover;min-height: 40px;"/>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            @role('author')
                                            <div class="news-card-img">
                                                <a href="{{ route('profile.index') }}" class="nav-link">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="currentColor" d="M12 12q-1.65 0-2.825-1.175T8 8q0-1.65 1.175-2.825T12 4q1.65 0 2.825 1.175T16 8q0 1.65-1.175 2.825T12 12m-8 8v-2.8q0-.85.438-1.562T5.6 14.55q1.55-.775 3.15-1.162T12 13q1.65 0 3.25.388t3.15 1.162q.725.375 1.163 1.088T20 17.2V20z"/></svg>
                                                    Profile
                                                </a>
                                            </div>
                                            <a href="{{ route('logout') }}/login" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 512 512"><path d="M312 372c-7.7 0-14 6.3-14 14 0 9.9-8.1 18-18 18H94c-9.9 0-18-8.1-18-18V126c0-9.9 8.1-18 18-18h186c9.9 0 18 8.1 18 18 0 7.7 6.3 14 14 14s14-6.3 14-14c0-25.4-20.6-46-46-46H94c-25.4 0-46 20.6-46 46v260c0 25.4 20.6 46 46 46h186c25.4 0 46-20.6 46-46 0-7.7-6.3-14-14-14z" fill="currentColor"/><path d="M372.9 158.1c-2.6-2.6-6.1-4.1-9.9-4.1-3.7 0-7.3 1.4-9.9 4.1-5.5 5.5-5.5 14.3 0 19.8l65.2 64.2H162c-7.7 0-14 6.3-14 14s6.3 14 14 14h256.6L355 334.2c-5.4 5.4-5.4 14.3 0 19.8l.1.1c2.7 2.5 6.2 3.9 9.8 3.9 3.8 0 7.3-1.4 9.9-4.1l82.6-82.4c4.3-4.3 6.5-9.3 6.5-14.7 0-5.3-2.3-10.3-6.5-14.5l-84.5-84.2z" fill="currentColor"/></svg>
                                                Logout
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                            </form>
                                            @endrole
                                        </li>
                                        <li class="nav-item">
                                            @role('user')
                                            <a href="{{ route('profile-user.user') }}" class="nav-link">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="currentColor" d="M12 12q-1.65 0-2.825-1.175T8 8q0-1.65 1.175-2.825T12 4q1.65 0 2.825 1.175T16 8q0 1.65-1.175 2.825T12 12m-8 8v-2.8q0-.85.438-1.562T5.6 14.55q1.55-.775 3.15-1.162T12 13q1.65 0 3.25.388t3.15 1.162q.725.375 1.163 1.088T20 17.2V20z"/></svg>
                                                Profile
                                            </a>
                                            <a href="{{ route('logout') }}/login" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 512 512"><path d="M312 372c-7.7 0-14 6.3-14 14 0 9.9-8.1 18-18 18H94c-9.9 0-18-8.1-18-18V126c0-9.9 8.1-18 18-18h186c9.9 0 18 8.1 18 18 0 7.7 6.3 14 14 14s14-6.3 14-14c0-25.4-20.6-46-46-46H94c-25.4 0-46 20.6-46 46v260c0 25.4 20.6 46 46 46h186c25.4 0 46-20.6 46-46 0-7.7-6.3-14-14-14z" fill="currentColor"/><path d="M372.9 158.1c-2.6-2.6-6.1-4.1-9.9-4.1-3.7 0-7.3 1.4-9.9 4.1-5.5 5.5-5.5 14.3 0 19.8l65.2 64.2H162c-7.7 0-14 6.3-14 14s6.3 14 14 14h256.6L355 334.2c-5.4 5.4-5.4 14.3 0 19.8l.1.1c2.7 2.5 6.2 3.9 9.8 3.9 3.8 0 7.3-1.4 9.9-4.1l82.6-82.4c4.3-4.3 6.5-9.3 6.5-14.7 0-5.3-2.3-10.3-6.5-14.5l-84.5-84.2z" fill="currentColor"/></svg>
                                                Logout
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                            </form>
                                            @endrole
                                        </li>
                                        <li class="nav-item">
                                            @role('admin')
                                            <a href="/dashboard" class="nav-link d-flex">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="me-1" width="23" height="23" viewBox="0 0 24 24"><path fill="currentColor" d="M12 12q-1.65 0-2.825-1.175T8 8q0-1.65 1.175-2.825T12 4q1.65 0 2.825 1.175T16 8q0 1.65-1.175 2.825T12 12m-8 8v-2.8q0-.85.438-1.562T5.6 14.55q1.55-.775 3.15-1.162T12 13q1.65 0 3.25.388t3.15 1.162q.725.375 1.163 1.088T20 17.2V20z"/></svg>
                                                Dashboard
                                            </a>
                                            <a href="{{ route('logout') }}/login" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 512 512"><path d="M312 372c-7.7 0-14 6.3-14 14 0 9.9-8.1 18-18 18H94c-9.9 0-18-8.1-18-18V126c0-9.9 8.1-18 18-18h186c9.9 0 18 8.1 18 18 0 7.7 6.3 14 14 14s14-6.3 14-14c0-25.4-20.6-46-46-46H94c-25.4 0-46 20.6-46 46v260c0 25.4 20.6 46 46 46h186c25.4 0 46-20.6 46-46 0-7.7-6.3-14-14-14z" fill="currentColor"/><path d="M372.9 158.1c-2.6-2.6-6.1-4.1-9.9-4.1-3.7 0-7.3 1.4-9.9 4.1-5.5 5.5-5.5 14.3 0 19.8l65.2 64.2H162c-7.7 0-14 6.3-14 14s6.3 14 14 14h256.6L355 334.2c-5.4 5.4-5.4 14.3 0 19.8l.1.1c2.7 2.5 6.2 3.9 9.8 3.9 3.8 0 7.3-1.4 9.9-4.1l82.6-82.4c4.3-4.3 6.5-9.3 6.5-14.7 0-5.3-2.3-10.3-6.5-14.5l-84.5-84.2z" fill="currentColor"/></svg>
                                                Logout
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                            </form>
                                            @endrole
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        @if (Auth::check() && Auth::user()->roles() == "author")
                        @endif
                        @else

                        <div class="">
                            <div class="option-item">
                                <a href="/login" class="btn-two" id="signInBtn">Masuk</a>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </nav>
    </div>
</div>

<div class="modal fade searchModal" id="searchModal" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="#" method="GET">
                <input type="search" name="q" id="search-input"  class="form-control" placeholder="Search here...." />
                <button type="submit"><i class="fi fi-rr-search"></i></button>
            </form>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ri-close-line"></i></button>
        </div>
    </div>
</div>
