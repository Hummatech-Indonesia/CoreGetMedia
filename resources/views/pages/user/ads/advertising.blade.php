@extends('layouts.user.app')
@section('style')
<style>
    .line {
        width: 100px;
        height: 5px;
        background-color: #175A95;
        border-radius: 15px;
        margin-inline: auto;


    }

    .image-container {
        position: relative;
    }

    .image-box {
        box-shadow: 0px 0px 4px rgba(0, 0, 0, .3);
        border-radius: 7px;
    }

    .text-overlay {
        padding: 20px;
        position: absolute;
        display: flex;
        align-items: start;
        gap: 20px;
    }

    .number {
        width: fit-content;
        height: fit-content;
        padding-inline: 20px;
        padding-block: 10px;
        background-color: #175A95;
        box-shadow: 0px 0px 10px #175A95;
        border-radius: 7px;
    }

    .number>p {
        color: white;
        margin: auto;
    }

    .content {
        display: flex;
        flex-direction: column;
        align-items: start;
    }

    .content ul>li {
        text-align: left;
    }
</style>
@endsection

@section('content')
<div class="breadcrumb-wrap"
    style="background-image: url('user/dist/images/breadcrumb/ads-bg.png'); background-size: cover; background-position: center center;">
    <div class="container">
        <h3 class="breadcrumb-title text-white">Pengiklanan</h3>
        <ul class="breadcrumb-menu list-style text-white">
            <li><a class="text-white" href="/">Beranda</a></li>
            <li>Pengiklanan</li>
        </ul>
    </div>
</div>

{{-- <div class="container-fluid pb-75 mt-5">

</div> --}}
<div class="row" style="margin-block: 100px;">
    <div class="col-lg-12 text-center">
        <h3>Pasang Iklan di GetMedia</h3>
        <img src="user/dist/images/ads/ads-icon.png" alt="" width="500px" style="margin-block: 30px;">
        <p class="col-md-6 mx-auto" style="font-size: 1.3rem;">Solusi periklanan komprehensif kami memberdayakan bisnis
            dari semua skala untuk
            menjangkau
            audiens yang luas
            dari individu yang terlibat dan terinformasi yang mencari berita dan pembaruan terbaru di berbagai topik,
            memungkinkan Anda untuk secara efektif mempromosikan pesan merek Anda kepada audiens yang reseptif.</p>
    </div>
</div>

<div class="row" style="margin-block: 80px;">
    <div class="col-lg-12 text-center">
        <h3>Tata Cara Pengiklanan di GetMedia</h3>
        <p class="col-md-6 mx-auto" style="font-size: 1.3rem;">Ikuti tata cara berikut untuk mengunggah iklan</p>
        <div class="line"></div>
    </div>
</div>

<div class="row justify-content-center gap-4" style="margin-top: 80px; margin-bottom: 30px;">
    <div class="col-md-4 text-center image-container">
        <div class="text-overlay">
            <div class="number">
                <p style="font-weight: bolder; font-size: 1.2rem;">1</p>
            </div>
            <div class="content">
                <h3 style="color: #434343;">Persiapan</h3>
                <p style=" margin-block: -2px;">Perlengkapan untuk memasang iklan :</p>
                <ul style="">
                    <li>Konten Iklan, bisa berupa video atau gambar</li>
                    <li>Dll</li>
                </ul>
            </div>
        </div>
        <img src="{{asset('user/dist/images/ads/box-ads.png')}}" class="image-box" alt="">
    </div>
    <div class="col-md-4 text-center image-container">
        <div class="text-overlay">
            <div class="number">
                <p style="font-weight: bolder; ">2</p>
            </div>
            <div class="content">
                <h3 style="color: #434343;">Pengisian Biodata</h3>
                <p style=" margin-block: -2px; text-align: left;">Pengisian biodata pengiklan, biodata
                    harus di isi
                    dengan benar :</p>
                <ul style="">
                    <li>Nama Lengkap</li>
                    <li>Alamat Email</li>
                    <li>Nomor Telepon</li>
                </ul>
            </div>
        </div>
        <img src="{{asset('user/dist/images/ads/box-ads.png')}}" class="image-box" alt="">
    </div>
</div>
<div class="row justify-content-center gap-4" style="margin-top: 40px; margin-bottom: 30px;">
    <div class="col-md-4 text-center image-container">
        <div class="text-overlay">
            <div class="number">
                <p style="font-weight: bolder; ">3</p>
            </div>
            <div class="content">
                <h3 style="color: #434343;">Pengisian Iklan</h3>
                <p style=" margin-block: -2px;">Mengisi form pengiklanan :</p>
                <ul style="">
                    <li>Jenis Iklan</li>
                    <li>Pilih Halaman</li>
                    <li>Posisi Iklan dan Layout</li>
                </ul>
            </div>
        </div>
        <img src="{{asset('user/dist/images/ads/box-ads.png')}}" class="image-box" alt="">
    </div>
    <div class="col-md-4 text-center image-container">
        <div class="text-overlay">
            <div class="number">
                <p style="font-weight: bolder; ">4</p>
            </div>
            <div class="content">
                <h3 style="color: #434343;">Pembayaran</h3>
                <p style=" margin-block: -2px; text-align: left;">Setelah mengisi form pengiklnanan,
                    user dikenakan
                    anggaran untuk mengunggah iklan :</p>
                <!-- <ul style="">
                    <li>Konten Iklan, bisa berupa video atau gambar</li>
                    <li>Dll</li>
                </ul> -->
            </div>
        </div>
        <img src="{{asset('user/dist/images/ads/box-ads.png')}}" class="image-box" alt="">
    </div>
</div>
<div class="row justify-content-center gap-4" style="margin-top: 40px; margin-bottom: 30px;">
    <div class="col-md-4 text-center image-container">
        <div class="text-overlay">
            <div class="number">
                <p style="font-weight: bolder; ">5</p>
            </div>
            <div class="content">
                <h3 style="color: #434343;">Menunggu Konfirmasi</h3>
                <p style=" margin-block: -2px; text-align: left;">Setelah melewati tahap-tahap
                    pengiklanan iklan yang diajukan akan di review oleh tim GetMedia
                </p>
                <!-- <ul style="">
                    <li>Konten Iklan, bisa berupa video atau gambar</li>
                    <li>Dll</li>
                </ul> -->
            </div>
        </div>
        <img src="{{asset('user/dist/images/ads/box-ads.png')}}" class="image-box" alt="">
    </div>
    <div class="col-md-4 text-center image-container">
        <div class="text-overlay">
            <div class="number">
                <p style="font-weight: bolder; ">6</p>
            </div>
            <div class="content">
                <h3 style="color: #434343;">Iklan Diunggah</h3>
                <p style=" margin-block: -2px; text-align: left;">Iklan setelah lolos dari review
                    admin, iklan akan
                    diunggah dan sesuai durasi yang di tentukan pengiklan</p>
                <!-- <ul style="">
                    <li>Konten Iklan, bisa berupa video atau gambar</li>
                    <li>Dll</li>
                </ul> -->
            </div>
        </div>
        <img src="{{asset('user/dist/images/ads/box-ads.png')}}" class="image-box" alt="">
    </div>
</div>

<button class="btn btn-sm mx-auto px-4 py-2 text-white" type="submit" data-bs-toggle="modal"
    data-bs-target="#exampleModal1"
    style="background-color: #175A95; font-size: large; display: block; margin: 20px auto; font-size: 1rem;">
    @auth
        <a href="{{ route('status-advertisement.user') }}" style="color: white;">Pasang Iklan Sekarang</a>
    @else
        <a href="{{ route('login') }}" style="color: white;">Pasang Iklan Sekarang</a>
    @endauth
    <i data-feather="chevron-right"></i>
</button>

<script>
    feather.replace();
</script>
@endsection