<script src="https://unpkg.com/feather-icons"></script>
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div style="background-color: #183249;">
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="Javascript:void(0)" class="text-nowrap logo-img">
                <img src="{{ asset('assets/img/logo/get-media-light.svg') }}" class="dark-logo" width="180" alt="" />
            </a>
            <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8 text-muted"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu text-white">BERANDA</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/profile-user" aria-expanded="false">
                        <span>
                            <i data-feather="home"></i>
                        </span>
                        <span class="hide-menu">Beranda</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu text-white">Berita</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <span class="d-flex">
                            <i data-feather="trello"></i>
                        </span>
                        <span class="hide-menu">Berita</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('news-liked.user') }}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i data-feather="thumbs-up"></i>
                                </div>
                                <span class="hide-menu">Berita Disukai</span>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu text-white">BERLANGGANAN</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link ps-3" {{ request()->routeIs('subscribe-history.user') || request()->routeIs('subscribe-history') || request()->routeIs('index') ? 'active' : '' }}
                        href="{{ route('subscribe-history') }}" aria-expanded="false">                     
                        <svg width="15" height="19" viewBox="0 0 15 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill="currentColor" d="M11.7649 7.74467C11.5514 7.46132 11.2915 7.21576 11.0501 6.9702C10.428 6.40352 9.72246 5.99739 9.12828 5.40238C7.74496 4.02345 7.43859 1.74727 8.32057 0C7.43859 0.217228 6.66802 0.708354 6.00885 1.2467C3.60429 3.2112 2.65732 6.67741 3.78997 9.6525C3.82711 9.74694 3.86424 9.84139 3.86424 9.96417C3.86424 10.172 3.72499 10.3609 3.5393 10.4364C3.32577 10.5309 3.10296 10.4742 2.92656 10.3231C2.87355 10.2785 2.82943 10.224 2.79658 10.1625C1.74749 8.81192 1.58038 6.87575 2.28596 5.32682C0.735532 6.6113 -0.109313 8.78358 0.0113792 10.8331C0.0670833 11.3053 0.122787 11.7776 0.280616 12.2498C0.410592 12.8165 0.66126 13.3832 0.939781 13.8837C1.94245 15.5177 3.67857 16.6888 5.54465 16.9249C7.53143 17.1799 9.65747 16.8116 11.1801 15.4138C12.879 13.846 13.4732 11.3337 12.6005 9.18026L12.4798 8.9347C12.2848 8.50024 11.7649 7.74467 11.7649 7.74467ZM8.83119 13.6948C8.57124 13.9215 8.14418 14.1671 7.80995 14.2615C6.77014 14.6393 5.73033 14.1104 5.11759 13.4871C6.22239 13.2226 6.88155 12.3915 7.07651 11.5509C7.23434 10.7953 6.93725 10.172 6.81656 9.44471C6.70515 8.7458 6.72372 8.15079 6.97439 7.4991C7.15079 7.858 7.33647 8.2169 7.55928 8.50024C8.27415 9.44471 9.39752 9.86028 9.6389 11.1448C9.67604 11.277 9.69461 11.4092 9.69461 11.5509C9.72246 12.3254 9.38823 13.1754 8.83119 13.6948Z" fill="#175A95"/>
                        </svg>    
                        <span class="hide-menu ms-1">Berlanganan</span>
                    </a>
                </li>   

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu text-white">IKLAN</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('status-advertisement.user') }}" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                            <path fill="#ffffff" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z" />
                        </svg>
                        <span class="hide-menu">Iklan</span>
                    </a>
                </li>

                {{-- <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                <path fill="#ffffff" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z" />
                            </svg>
                        </div>
                        <span class="hide-menu">Iklan</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('status-advertisement.user') }}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                        <path fill="#ffffff" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z" />
                                    </svg>
                                </div>
                                <span class="hide-menu">Status Iklan</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="currentColor" d="M12 20c4.4 0 8-3.6 8-8s-3.6-8-8-8s-8 3.6-8 8s3.6 8 8 8m0-18c5.5 0 10 4.5 10 10s-4.5 10-10 10S2 17.5 2 12S6.5 2 12 2m5 11.9l-.7 1.3l-5.3-2.9V7h1.5v4.4z"/></svg>
                                </div>
                                <span class="hide-menu">Riwayat Iklan</span>
                            </a>
                        </li>
                    </ul>
                </li> --}}
            </ul>
        </nav>
    </div>
</aside>
<script>
feather.replace();
</script>


{{-- <li class="sidebar-item">
    <a class="sidebar-link {{ request()->routeIs('inbox-user.user' ? 'active' : '') }}"
href="{{route('inbox-user.user')}}" aria-expanded="false">
<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
    <path fill="currentColor"
        d="M22 6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2zm-2 0l-8 5l-8-5zm0 12H4V8l8 5l8-5z" />
</svg>
<span class="hide-menu">Kotak Surat</span>
@if ($countMessage > 0)
<span id="total" class="badge total ms-auto bg-danger ">{{ $countMessage }}</span>
@endif
</a>
</li> --}}

{{-- <li class="nav-small-cap">
    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
    <span class="hide-menu text-white">Berita & Iklan</span>
</li> --}}
{{-- <ul aria-expanded="false" class="collapse first-level">
    <li class="sidebar-item">
        <a href="{{route('berita.upload')}}" class="sidebar-link">
<div class="round-16 d-flex align-items-center justify-content-center">
    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
        <path fill="#ffffff" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z" />
    </svg>
</div>
<span class="hide-menu">Unggah Berita</span>
</a>
</li>
<ul class="sidebar-item">
    <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
        <svg xmlns="http://www.w3.org/2000/sv width=" 25" height="25" viewBox="0 0 24 24">
            <path fill="currentColor"
                d="M18.75 20H5.25a3.25 3.25 0 0 1-3.245-3.066L2 16.75V6.25a2.25 2.25 0 0 1 2.096-2.245L4.25 4h12.5a2.25 2.25 0 0 1 2.245 2.096L19 6.25V7h.75a2.25 2.25 0 0 1 2.245 2.096L22 9.25v7.5a3.25 3.25 0 0 1-3.066 3.245zH5.25zm-13.5-1.5h13.5a1.75 1.75 0 0 0 1.744-1.607l.006-.143v-7.5a.75.75 0 0 0-.648-.743L19.75 8.5H19v7.75a.75.75 0 0 1-.648.743L18.25 17a.75.75 0 0 1-.743-.648l-.007-.102v-10a.75.75 0 0 0-.648-.743L16.75 5.5H4.25a.75.75 0 0 0-.743.648L3.5 6.25v10.5a1.75 1.75 0 0 0 1.606 1.744zh13.5zm6.996-4h3.006a.75.75 0 0 1 .102 1.493l-.102.007h-3.006a.75.75 0 0 1-.102-1.493zh3.006zm-3.003-3.495a.75.75 0 0 1 .75.75v3.495a.75.75 0 0 1-.75.75H5.748a.75.75 0 0 1-.75-.75v-3.495a.75.75 0 0 1 .75-.75zm-.75 1.5H6.498V14.5h1.995zm3.753-1.5h3.006a.75.75 0 0 1 .102 1.493l-.102.007h-3.006a.75.75 0 0 1-.102-1.494zh3.006zM5.748 7.502h9.504a.75.75 0 0 1 .102 1.494l-.102.006H5.748a.75.75 0 0 1-.102-1.493zh9.504z" />
        </svg>
        <span class="hide-menu">Iklan</span>
    </a>
    <ul aria-expanded="false" class="collapse first-level">
        <li class="sidebar-item">
            <a href="#" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                        <path fill="#ffffff" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z" />
                    </svg>
                </div>
                <span class="hide-menu">Unggah Iklan</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('status-advertisement.user') }}" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 56 56">
                        <path fill="#ffffff"
                            d="M28 51.906c13.055 0 23.906-10.828 23.906-23.906c0-13.055-10.875-23.906-23.93-23.906C14.899 4.094 4.095 14.945 4.095 28c0 13.078 10.828 23.906 23.906 23.906m0-3.984C16.937 47.922 8.1 39.062 8.1 28c0-11.04 8.813-19.922 19.876-19.922c11.039 0 19.921 8.883 19.945 19.922c.023 11.063-8.883 19.922-19.922 19.922m-.023-15.68c1.124 0 1.757-.633 1.78-1.851l.352-12.375c.024-1.196-.914-2.086-2.156-2.086c-1.266 0-2.156.867-2.133 2.062l.305 12.399c.023 1.195.68 1.851 1.852 1.851m0 7.617c1.335 0 2.53-1.078 2.53-2.437c0-1.383-1.171-2.438-2.53-2.438c-1.383 0-2.532 1.078-2.532 2.438c0 1.336 1.172 2.437 2.532 2.437" />
                    </svg>
                </div>
                <span class="hide-menu">Status Iklan</span>
            </a>
        </li>


    </ul>
    <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu text-white">Koin</span>
    </li>

    <li class="sidebar-item">
        <a class="sidebar-link {{ request()->routeIs('coin.user' ? 'active' : '') }}" href="{{route('coin.user')}}"
            aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                <g fill="none">

                    <path
                        d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                    <path fill="currentColor"
                        d="M12 3c2.314 0 4.456.408 6.058 1.109c.799.35 1.509.792 2.032 1.334c.485.5.845 1.128.902 1.856L21 7.5v10c0 .814-.381 1.51-.91 2.057c-.523.542-1.233.984-2.032 1.334C16.456 21.591 14.314 22 12 22c-2.314 0-4.456-.408-6.058-1.109c-.799-.35-1.509-.792-2.032-1.334c-.485-.5-.845-1.128-.902-1.856L3 17.5v-10c0-.814.381-1.51.91-2.057c.523-.542 1.233-.984 2.032-1.334C7.544 3.409 9.686 3 12 3m7 12.407a8.13 8.13 0 0 1-.942.484C16.456 16.591 14.314 17 12 17c-2.314 0-4.456-.408-6.058-1.109A8.122 8.122 0 0 1 5 15.407V17.5c0 .152.066.376.348.667c.286.296.748.608 1.396.892C8.038 19.625 9.895 20 12 20c2.105 0 3.962-.375 5.256-.941c.648-.284 1.11-.596 1.396-.892c.282-.29.348-.515.348-.667zm0-5a8.13 8.13 0 0 1-.942.484C16.456 11.591 14.314 12 12 12c-2.314 0-4.456-.408-6.058-1.109A8.122 8.122 0 0 1 5 10.407V12.5c0 .152.066.376.348.667c.286.296.748.608 1.396.892C8.038 14.625 9.895 15 12 15c2.105 0 3.962-.375 5.256-.941c.648-.284 1.11-.596 1.396-.892c.282-.29.348-.515.348-.667zM12 5c-2.105 0-3.962.375-5.256.941c-.648.284-1.11.596-1.396.892c-.282.29-.348.515-.348.667c0 .152.066.376.348.667c.286.296.748.608 1.396.892C8.038 9.625 9.895 10 12 10c2.105 0 3.962-.375 5.256-.941c.648-.284 1.11-.596 1.396-.892c.282-.29.348-.515.348-.667c0-.152-.066-.376-.348-.667c-.286-.296-.748-.608-1.396-.892C15.962 5.375 14.105 5 12 5" />
                </g>

            </svg>
            <span class="hide-menu">Tukarkan Koin</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link " href="#" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M17.66 11.2c-.23-.3-.51-.56-.77-.82c-.67-.6-1.43-1.03-2.07-1.66C13.33 7.26 13 4.85 13.95 3c-.95.23-1.78.75-2.49 1.32c-2.59 2.08-3.61 5.75-2.39 8.9c.04.1.08.2.08.33c0 .22-.15.42-.35.5c-.23.1-.47.04-.66-.12a.6.6 0 0 1-.14-.17c-1.13-1.43-1.31-3.48-.55-5.12C5.78 10 4.87 12.3 5 14.47c.06.5.12 1 .29 1.5c.14.6.41 1.2.71 1.73c1.08 1.73 2.95 2.97 4.96 3.22c2.14.27 4.43-.12 6.07-1.6c1.83-1.66 2.47-4.32 1.53-6.6l-.13-.26c-.21-.46-.77-1.26-.77-1.26m-3.16 6.3c-.28.24-.74.5-1.1.6c-1.12.4-2.24-.16-2.9-.82c1.19-.28 1.9-1.16 2.11-2.05c.17-.8-.15-1.46-.28-2.23c-.12-.74-.1-1.37.17-2.06c.19.38.39.76.63 1.06c.77 1 1.98 1.44 2.24 2.8c.04.14.06.28.06.43c.03.82-.33 1.72-.93 2.27" />
            </svg>
            <span class="hide-menu">Berlangganan</span>
        </a>
    </li>
</ul>
</ul> --}}
