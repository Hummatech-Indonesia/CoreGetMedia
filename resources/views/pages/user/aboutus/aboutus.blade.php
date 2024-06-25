@extends('layouts.user.app')

@section('style')

<style>
.image {
    background-image: url("assets/img/Frame 27 (1).png");
    background-size: cover;
    height: 100px;
    width: 45%;
}

.breadcrumb-wrap {
    background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("assets/img/banner 1.svg");
    background-size: cover;
}

.li::after {
    color: #FFFFFF !important;
}
</style>
@endsection

@section('content')
<div class="breadcrumb-wrap">
    <div class="container">
        <h2 class="breadcrumb-title text-white">About Us</h2>
        <ul class="breadcrumb-menu list-style">
            <li class="li"><a href="/" style="color: #FFFFFF">Beranda</a></li>
            <li>About Us</li>
        </ul>
    </div>
</div>
<div class="container-fluid pb-75 mt-5">
    <div class="row">
        <div class="col-6 mt-5">
            <div class="row ps-5">
                <div class="col-2 mt-2 mb-3" style="background-color:#175A95"></div>
                <div class="col-10">
                    Who We Are
                </div>
                <div class="col">
                    <h1>
                        {{ $about_get->header }}
                        {{-- KAMI ADALAH PORTAL BERITA TERBAIK DAN PROFESSIONAL --}}
                    </h1>
                </div>
                <div class="col-12">
                    <p class="fs-5">
                        {!! $about_get->description !!}
                        {{-- Di era digital yang penuh dengan informasi yang tak terhingga, kami hadir sebagai sumber berita
                        yang terpercaya dan mudah diakses oleh Anda. Kami bukan sekadar portal berita biasa, tetapi
                        sebuah komunitas yang berkomitmen untuk menyajikan informasi yang akurat, objektif, dan
                        mencerahkan bagi masyarakat --}}
                    </p>
                </div>
                <div class="image col">
                    <h4 class="mt-4" style="color: #FFFFFF">
                        {{ $about_get->slogan }}
                        {{-- MENGHUBUNGKAN ANDA DENGAN BERITA TERKINI DAN TERHANGAT SETIAP SAAT --}}
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-6 mt-5">
            <img class="m-auto me-5 pe-4" style="display: block; width: 420px;"
                src="{{ asset('assets/img/getmedia-logo.png') }}" alt="">
        </div>
    </div>
</div>
@endsection
