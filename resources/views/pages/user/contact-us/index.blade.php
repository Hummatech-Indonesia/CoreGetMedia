@extends('layouts.user.app')

@section('seo')
<meta name="description" content="{{ Str::limit(strip_tags(isset($about_get->description)), 100) }}" />
<meta name="title" content="{{ isset($about_get->slogan) }} - GetMedia" />
<meta name="og:image" content="{{ asset('assets/img/getmedia-logo.png') }}" />
<meta name="og:image:secure_url" content="{{ asset('assets/img/getmedia-logo.png') }}" />
<meta name="og:image:type" content="image/png" />
<meta property="og:image" content="{{ asset('assets/img/getmedia-logo.png') }}" />
<meta property="og:image:alt" content="{{ isset($about_get->slogan) }}" />
<meta property="og:url" content="{{ url('/') }}" />
<meta property="og:type" content="home" />
<link rel="canonical" href="{{ url('/') }}" />
@endsection

@section('style')
<style>
    .social-profile li a {
        border: 1px solid #434343;
    }

    .social-profile li a:hover {
        border-color: transparent;
    }

    .social-profile {
        margin-top: 16px;
    }

    .social-profile li {
        margin-right: 5px;
    }

    .social-profile li:last-child {
        margin-right: 0;
    }

    .social-profile li a {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: rgba(103, 77, 243, 0.1);
    }

    .social-profile li a i {
        color: #434343;
        font-size: 15px;
    }

    .social-profile li a:hover {
        background-color: #175A95;
    }

    .social-profile li a:hover i {
        color: var(--whiteColor);
    }

    .breadcrumb-wrap {
        padding: 80px 0 74px;
        background-image: url("assets/img/contact/contact-bg.jpg");
    }

    .input-group-text {
        background-color: transparent;
    }

    .bg-contact {
        background-image: url("assets/img/contact/circle-bg-png");
    }

    .img-contact {
        background-image: url("assets/img/contact/bg-contact.png");
        background-repeat: no-repeat;
        background-size: cover;
    }

</style>
@endsection

@section('content')
<div class="breadcrumb-wrap">
    <div class="container">
        <h2 class="breadcrumb-title text-white">Hubungi Kami</h2>
        <ul class="breadcrumb-menu list-style text-white">
            <li><a class="text-white" href="/">Beranda</a></li>
            <li>Hubungi Kami</li>
        </ul>
    </div>
</div>

{{-- <div class="container-fluid pb-75 mt-5">

</div> --}}
@if(session('berhasil'))
<div class="alert alert-primary" role="alert">
    {{ session('berhasil') }}
</div>
@endif
<div class="row">
    <div class="col-lg-6">
        <div class="img-contact">
            <div class="" style="padding-left: 250px;padding-right: 50px; padding-top: 150px;">
                <h3>Hubungi Kami</h3>
                <p>Masukan Anda berharga bagi kami. Bantu kami meningkatkan portal berita kami dengan membagikan pemikiran Anda</p>
                <div class="row mt-4">
                    <div class="col-lg-6">
                        <div class="card" style="background-color: #175A95">
                            <div class="card-body text-white">
                                <div class="d-flex flex-row align-items-center">
                                    <div class="round-10 d-flex align-items-center justify-content-center" style="background-color: #fff; border-radius: 8px; padding: 12px">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24">
                                            <path fill="#175a95" d="M4 20q-.825 0-1.412-.587T2 18V6q0-.825.588-1.412T4 4h16q.825 0 1.413.588T22 6v12q0 .825-.587 1.413T20 20zm8-7L4 8v10h16V8zm0-2l8-5H4zM4 8V6v12z" /></svg>
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="mb-0 text-white fs-6">Email</h4>
                                        @if (isset($about_get))
                                            <span class="text-white">{{ $about_get->email }}</span>
                                        @else
                                            <span class="text-white">Email tidak tersedia</span>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card" style="background-color: #222222">
                            <div class="card-body text-white">
                                <div class="d-flex flex-row align-items-center">
                                    <div class="round-10 d-flex align-items-center justify-content-center" style="background-color: #fff; border-radius: 8px; padding: 12px">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 32 32">
                                            <path fill="#222222" d="M26 29h-.17C6.18 27.87 3.39 11.29 3 6.23A3 3 0 0 1 5.76 3h5.51a2 2 0 0 1 1.86 1.26L14.65 8a2 2 0 0 1-.44 2.16l-2.13 2.15a9.37 9.37 0 0 0 7.58 7.6l2.17-2.15a2 2 0 0 1 2.17-.41l3.77 1.51A2 2 0 0 1 29 20.72V26a3 3 0 0 1-3 3M6 5a1 1 0 0 0-1 1v.08C5.46 12 8.41 26 25.94 27a1 1 0 0 0 1.06-.94v-5.34l-3.77-1.51l-2.87 2.85l-.48-.06c-8.7-1.09-9.88-9.79-9.88-9.88l-.06-.48l2.84-2.87L11.28 5Z" /></svg>
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="mb-0 text-white fs-6">Telepon</h4>
                                        @if (isset($about_get))
                                            <span class="text-white">{{ $about_get->phone_number }}</span>
                                        @else
                                            <span class="text-white">Nomer telepon tidak tersedia</span>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="mt-5" style="padding-bottom: 250px;">
                    <ul class="social-profile list-style">
                        @if (isset($about_get))
                        <li>
                            <a href="{{ $about_get->url_facebook }}" target="_blank"><i class="ri-facebook-fill"></i></a>
                        </li>
                        <li>
                            <a href="{{ $about_get->url_twitter }}" target="_blank"><i class="ri-twitter-fill"></i></a>
                        </li>
                        <li>
                            <a href="{{ $about_get->url_instagram }}" target="_blank"><i class="ri-instagram-line"></i></a>
                        </li>
                        <li>
                            <a href="{{ $about_get->url_linkedin }}" target="_blank"><i class="ri-linkedin-fill"></i></a>
                        </li>
                        @else
                        <li>
                            <p>Social media belum tersedia</p>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div style="padding-top: 150px;padding-left: 50px;padding-right: 250px;">
            <h3>Kirimkan Pesan</h3>
            <form action="{{ route('contact.send') }}" method="POST">
            <div class="row">
                    @csrf
                    <div class="col-lg-12 mb-4">
                        <input id="name" class="form-control" type="text" placeholder="Name" name="name">
                    </div>
                    <div class="col-lg-6 mb-4">
                        <input id="email" class="form-control" type="text" placeholder="Email" name="email">
                    </div>
                    <div class="col-lg-6 mb-4">
                        <input id="no_telp" class="form-control" type="text" placeholder="Nomor Telepon" name="no_telp">
                    </div>
                    <div class="col-lg-12 mb-4">
                        <textarea class="form-control" placeholder="Isi Pesan" id="" rows="7" name="description" ></textarea>
                    </div>
                    <div class="col-md-12">
                        <button class="btn-two py-3">
                            Kirim Pesan
                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24"><path fill="#ffffff" d="M3 20v-6l8-2l-8-2V4l19 8z"/></svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
