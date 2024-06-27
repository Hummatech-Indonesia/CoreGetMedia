@extends('layouts.admin.app')

@section('style')
<style>
    .nav-tabs .nav-link.active {
        background-color: #175A95 !important;
        color: #fff !important;
    }

    .nav-underline .nav-link.active,
    .nav-underline .show>.nav-link {
        font-weight: 500;
        color: #175A95;
        border-bottom-color: currentcolor;
        padding-left: 15px;
        padding-right: 15px;
    }

</style>
@endsection

@section('content')

<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Paket Berlangganan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('voucher.store.admin') }}" method="POST">
                @method('post')
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <label class="form-label mt-2">Kode Voucher</label>
                            <input class="form-control" type="text" name="code">
                            <ul class="error-text"></ul>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label mt-2">Potongan Harga</label>
                            <input class="form-control" type="text" name="presentation">
                            <ul class="error-text"></ul>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label mt-2">Jenis Voucher</label>
                            <select class="form-control" name="status" id="jenis-voucher">
                                <option disabled selected>Pilih Jenis</option>
                                <option value="unlimited">Unlimited</option>
                                <option value="quota">Quota</option>
                            </select>
                            <ul class="error-text"></ul>
                        </div>
                        <div class="col-lg-12" id="stok-wrapper">
                            <label class="form-label mt-2">Stok</label>
                            <input id="update-quota" class="form-control" class="stok" type="text" name="quota">
                            <ul class="error-text"></ul>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-rounded btn-light-danger text-danger"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-rounded btn-light-success text-success">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="card shadow-sm position-relative overflow-hidden" style="background-color: #175A95;">
    <div class="card-body px-4 py-4">
        <div class="row justify-content-between">
            <div class="col-8 text-white">
                <h4 class="fw-semibold mb-3 mt-2 text-white">Fitur Berlangganan</h4>
                <p>Jadikan pengalaman membaca menjadi lebih baik</p>
            </div>
            <div class="col-3">
                <div class="text-center mb-n4">
                    <img src="{{ asset('assets/img/bg-ajuan.svg') }}" width="250px" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-1">
    <div class="p-2">

        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" data-bs-toggle="tab" href="#navpill-paket" role="tab" aria-selected="true">
                    <span>Paket</span>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" href="#navpill-statistik" role="tab" aria-selected="false">
                    <span>Statistik</span>
                </a>
            </li>
        </ul>

    </div>
</div>

<div class="tab-content">

    <div id="navpill-paket" class="tab-pane fade show active" role="tabpanel">
        <div class="d-flex justify-content-between">
            <ul class="nav nav-underline" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" style="padding-right: 15px; padding-left: 15px;" id="active-tab"
                        data-bs-toggle="tab" href="#active" role="tab" aria-controls="active" aria-expanded="true">
                        <span>Semua</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="padding-right: 15px; padding-left: 15px;" id="link1-tab" data-bs-toggle="tab"
                        href="#link1" role="tab" aria-controls="link1">
                        <span>Basic</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="padding-right: 15px; padding-left: 15px;" id="link2-tab" data-bs-toggle="tab"
                        href="#link2" role="tab" aria-controls="link2">
                        <span>Premium</span>
                    </a>
                </li>
                <div class="d-flex ml-auto">
                    <button class="btn btn-create text-white" style="background-color: #175A95;" data-bs-toggle="modal" data-bs-target="#modal-create">
                        Tambah Paket
                    </button>
                </div>
            </ul>
        </div>

        <div class="tab-content tabcontent-border p-3" id="myTabContent">
            <div role="tabpanel" class="tab-pane fade show active" id="active" aria-labelledby="active-tab">

                <div class="row mx-">
                    <div class="col-md-4 mb-3">
                        <div class="card" style="background-image: url({{asset('assets/img/frame-subscribe.png')}}); background-size: cover; background-position: center;">
                            <div class="card-body mx-4">
                                    <span class="badge bg-light-primary fw-semibold" style="color: #175A95; font-size: 25px;">Basic</span>
                                <div class="mt-3">
                                    <span class="fw-semibold" style="color: #175A95; font-size: 25px;">Paket 1</span>
                                </div>
                                <p class="card-text pt-2 text-muted">Akses berita terbaru dan terlengkap dengan paket dasar kami yang hemat dan terjangkau.</p>
                                <h4 class="text-center pt-4">
                                    <sup style="font-size: 20px; color: #175A95">Rp</sup>
                                    <span class="fw-semibold"  style="font-size: 36px; color: #175A95">50.000</span>
                                    <sub class="text-muted" style="font-size: 14px">/ 1 bulan</sub>
                                </h4>
                                <div class="pt-4">
                                    <p style="font-size: 18px">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                            <path fill="#28a745" d="m10 13.6l5.9-5.9q.275-.275.7-.275t.7.275t.275.7t-.275.7l-6.6 6.6q-.3.3-.7.3t-.7-.3l-2.6-2.6q-.275-.275-.275-.7t.275-.7t.7-.275t.7.275z"/>
                                        </svg>
                                        Blokir iklan selama 1 bulan
                                    </p>
                                    <hr>
                                    <p style="font-size: 18px">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                            <path fill="#28a745" d="m10 13.6l5.9-5.9q.275-.275.7-.275t.7.275t.275.7t-.275.7l-6.6 6.6q-.3.3-.7.3t-.7-.3l-2.6-2.6q-.275-.275-.275-.7t.275-.7t.7-.275t.7.275z"/>
                                        </svg>
                                        Blokir iklan selama 1 bulan
                                    </p>
                                    <hr>
                                    <p style="font-size: 18px">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                            <path fill="#28a745" d="m10 13.6l5.9-5.9q.275-.275.7-.275t.7.275t.275.7t-.275.7l-6.6 6.6q-.3.3-.7.3t-.7-.3l-2.6-2.6q-.275-.275-.275-.7t.275-.7t.7-.275t.7.275z"/>
                                        </svg>
                                        Blokir iklan selama 1 bulan
                                    </p>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="card" style="background-image: url({{asset('assets/card-dark.png')}}); background-size: cover; background-position: center;">
                            <div class="card-body mx-4">
                                <div class="d-flex justify-content-between">
                                    <h4>
                                        <span class="badge" style="background-color: #ffffff; color: #000000;">Premium</span>
                                    </h4>
                                    <h6>
                                        <span class="badge" style="background-color: #DD1818; color: #ffffff;">Popular</span>
                                    </h6>
                                </div>
                                <p class="card-text pt-2 text-light">Akses berita terbaru dan terlengkap dengan paket dasar kami yang hemat dan terjangkau.</p>
                                <h4 class="text-center pt-4">
                                    <sup style="font-size: 20px; color: #ffffff">Rp</sup>
                                    <sub style="font-size: 36px; color: #ffffff">50.000</sub>
                                    <sub class="text-light" style="font-size: 14px">/ 1 bulan</sub>
                                </h4>
                                <h3 class="pt-5 text-center">
                                    <a href="#" class="btn btn-outline-primary rounded-3 btn-border-transparent w-100"
                                       style="border-color: #ffffff; color: #ffffff;">Beli Sekarang</a>
                                </h3>
                                <div class="pt-4 text-light">
                                    <p style="font-size: 18px">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                            <path fill="#28a745" d="m10 13.6l5.9-5.9q.275-.275.7-.275t.7.275t.275.7t-.275.7l-6.6 6.6q-.3.3-.7.3t-.7-.3l-2.6-2.6q-.275-.275-.275-.7t.275-.7t.7-.275t.7.275z"/>
                                        </svg>
                                        Blokir iklan selama 1 bulan
                                    </p>
                                    <hr>
                                    <p style="font-size: 18px">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                            <path fill="#28a745" d="m10 13.6l5.9-5.9q.275-.275.7-.275t.7.275t.275.7t-.275.7l-6.6 6.6q-.3.3-.7.3t-.7-.3l-2.6-2.6q-.275-.275-.275-.7t.275-.7t.7-.275t.7.275z"/>
                                        </svg>
                                        Blokir iklan selama 1 bulan
                                    </p>
                                    <hr>
                                    <p style="font-size: 18px">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                            <path fill="#28a745" d="m10 13.6l5.9-5.9q.275-.275.7-.275t.7.275t.275.7t-.275.7l-6.6 6.6q-.3.3-.7.3t-.7-.3l-2.6-2.6q-.275-.275-.275-.7t.275-.7t.7-.275t.7.275z"/>
                                        </svg>
                                        Blokir iklan selama 1 bulan
                                    </p>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="card" style="background-image: url({{asset('assets/img/frame-subscribe.png')}}); background-size: cover; background-position: center;">
                            <div class="card-body mx-4">
                                <h4>
                                    <span class="badge" style="background-color: #EAF8FF; color: #175A95;">Basic</span>
                                </h4>
                                <p class="card-text pt-2 text-muted">Akses berita terbaru dan terlengkap dengan paket dasar kami yang hemat dan terjangkau.</p>
                                <h4 class="text-center pt-4">
                                    <sup style="font-size: 20px; color: #175A95">Rp</sup>
                                    <sub style="font-size: 36px; color: #175A95">50.000</sub>
                                    <sub class="text-muted" style="font-size: 14px">/ 1 bulan</sub>
                                </h4>
                                <h3 class="pt-5 text-center">
                                    <a href="#" class="btn btn-outline-primary rounded-3 btn-border-transparent w-100"
                                       style="border-color: #175A95; color: #175A95;">Beli Sekarang</a>
                                </h3>
                                <div class="pt-4">
                                    <p style="font-size: 18px">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                            <path fill="#28a745" d="m10 13.6l5.9-5.9q.275-.275.7-.275t.7.275t.275.7t-.275.7l-6.6 6.6q-.3.3-.7.3t-.7-.3l-2.6-2.6q-.275-.275-.275-.7t.275-.7t.7-.275t.7.275z"/>
                                        </svg>
                                        Blokir iklan selama 1 bulan
                                    </p>
                                    <hr>
                                    <p style="font-size: 18px">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                            <path fill="#28a745" d="m10 13.6l5.9-5.9q.275-.275.7-.275t.7.275t.275.7t-.275.7l-6.6 6.6q-.3.3-.7.3t-.7-.3l-2.6-2.6q-.275-.275-.275-.7t.275-.7t.7-.275t.7.275z"/>
                                        </svg>
                                        Blokir iklan selama 1 bulan
                                    </p>
                                    <hr>
                                    <p style="font-size: 18px">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                            <path fill="#28a745" d="m10 13.6l5.9-5.9q.275-.275.7-.275t.7.275t.275.7t-.275.7l-6.6 6.6q-.3.3-.7.3t-.7-.3l-2.6-2.6q-.275-.275-.275-.7t.275-.7t.7-.275t.7.275z"/>
                                        </svg>
                                        Blokir iklan selama 1 bulan
                                    </p>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="tab-pane fade" id="link1" role="tabpanel" aria-labelledby="link1-tab">

            </div>

            <div class="tab-pane fade" id="link2" role="tabpanel" aria-labelledby="link2-tab">

            </div>
        </div>

    </div>

    <div id="navpill-statistik" class="tab-pane fade" role="tabpanel">
        statistik
    </div>

</div>

@endsection

@section('script')
<script src="{{ asset('admin/dist/libs/apexcharts/dist/apexcharts.min.js') }}"></script>

<script>
    var options = {
        color: "#adb5bd"
        , series: [80, 55]
        , labels: ["Income", "Expance"]
        , chart: {
            type: "donut"
            , fontFamily: "Plus Jakarta Sans', sans-serif"
            , foreColor: "#adb0bb"
        , }
        , plotOptions: {
            pie: {
                donut: {
                    size: '70%'
                    , background: 'transparent'
                    , labels: {
                        show: true
                        , name: {
                            show: true
                            , offsetY: 7
                        , }
                        , value: {
                            show: false
                        , }
                        , total: {
                            show: true
                            , color: '#5A6A85'
                            , fontSize: '20px'
                            , fontWeight: "600"
                            , label: ''
                        , }
                    , }
                , }
            , }
        , },

        dataLabels: {
            enabled: false
        , }
        , stroke: {
            show: false
        , }
        , legend: {
            show: false
        , }
        , colors: ["var(--bs-primary)", "var(--bs-secondary)"],

        tooltip: {
            theme: "dark"
            , fillSeriesColor: false
        , }
    , };

    var chart = new ApexCharts(document.querySelector("#chart-donut"), options);
    chart.render();

</script>
@endsection
