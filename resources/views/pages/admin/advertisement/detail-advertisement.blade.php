@extends('layouts.admin.app')

@section('style')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link rel="stylesheet" href="{{ asset('assets/dist/imageuploadify.min.css') }}">

<link rel="stylesheet" href="{{ asset('admin/dist/libs/summernote/dist/summernote-lite.min.css') }}">

<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />

<style>
     .tmbl {
            display: inline-block;
            background-color: #183249;
            color: white;
            padding: 5px 10px;
            margin: 3px;
            border-radius: 5px;
        }
        .icon-background {
        background-color: #e0e0e0;
        padding: 5px 5px;
        border-radius: 5px;
        color: #888888;
    }
</style>
@endsection

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Admin | News-Detail</title>
</head>

@section('content')

<div class="card shadow-sm position-relative overflow-hidden" style="background-color: #175A95;">
    <div class="card-body px-4 py-4">
        <div class="row justify-content-between">
            <div class="col-8 text-white">
                <h4 class="fw-semibold mb-3 mt-2 text-white">Konfirmasi Iklan</h4>
                <p>Layanan pengiklanan di getmedia.id</p>
            </div>
            <div class="col-3">
                <div class="text-center mb-n4">
                    <img src="{{ asset('assets/img/bg-ajuan.svg') }}" width="250px" alt="" class="bg-mobile">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-between mt-4 mb-4">

    <button type="button" class="btn btn-secondary" style="background-color: #CCCCCC; border: none; color: 5A5A5A">
        <i class="ti ti-arrow-left"></i>
        Kembali
    </button>

    <div>
        <button type="button" class="btn btn-danger me-2">Tolak</button>
        <button type="button" class="btn btn-success" style="background-color: #175A95; border: none">Terima</button>
    </div>

    {{-- saat sudah di bayar --}}
    {{-- <div>
        <button type="button" class="btn btn-success" style="background-color: #175A95; border: none">Unggah</button>
    </div> --}}

</div>


<div class="row">
    <div class="col-sm-8">
        <div class="card">
            <div class="card-body">
                <h4>Detail Iklan</h4>
                <div class="pt-3">
                    <h6 class="card-text">Gambar</h6>
                    <img src="{{asset('assets/milo.png')}}" alt="Nama Gambar" style="max-width: 200px;" />
                </div>
                <div class="pt-4">
                    <h6>Halaman</h6>
                    <form>
                        <div class="form-group mb-4">
                            <select class="form-select mr-sm-2" id="inlineFormCustomSelect">
                                <option selected></option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="pt-2">
                    <h6>Posisi Iklan</h6>
                    <div class="row py-2">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input success" type="radio" name="radio-solid-success1" id="success1-radio" value="option1">
                                        <label class="form-check-label d-flex flex-column align-items-center" for="success1-radio">
                                            <span>Posisi Kanan (456 x 654)</span>
                                            <img src="{{asset('assets/iklan.png')}}" alt="Nama Gambar" class="img-fluid mt-2" style="max-width: 250px;">
                                        </label>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6 mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input success" type="radio" name="radio-solid-success2" id="success2-radio" value="option2">
                                        <label class="form-check-label d-flex flex-column align-items-center" for="success2-radio">
                                            <span>Posisi Kanan (456 x 654)</span>
                                            <img src="{{asset('assets/iklan.png')}}" alt="Nama Gambar" class="img-fluid mt-2" style="max-width: 250px;">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input success" type="radio" name="radio-solid-success2" id="success2-radio" value="option2">
                                        <label class="form-check-label d-flex flex-column align-items-center" for="success2-radio">
                                            <span>Posisi Kanan (456 x 654)</span>
                                            <img src="{{asset('assets/iklan.png')}}" alt="Nama Gambar" class="img-fluid mt-2" style="max-width: 250px;">
                                        </label>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pt-4">
                    <h6>Jenis Iklan</h6>
                    <form>
                        <div class="form-group mb-4">
                            <select class="form-select mr-sm-2" id="inlineFormCustomSelect">
                                <option selected></option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div>
                    <div class="d-flex pt-4">
                        <div class="me-4 w-100">
                            <h6>Tanggal Mulai</h6>
                            <input type="date" class="form-control w-100">
                        </div>
                        <div class="w-100">
                            <h6>Tanggal Akhir</h6>
                            <input type="date" class="form-control w-100">
                        </div>
                    </div>
                </div>
                <div class="pt-4">
                    <h6>URL</h6>
                    <input type="text" class="form-control">
                </div>
            </div>
        </div>
    </div>


    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">Biodata Pengiklan</h4>
                <div class="mb-3">
                    <label class="font-weight-medium fs-3 mb-1">Nama</label>
                    <input type="text" class="form-control date-inputmask" id="date-mask" placeholder="">
                </div>
                <div class="mb-3">
                    <label class="font-weight-medium fs-3 mb-1">Email</label>
                    <input type="email" class="form-control date-inputmask" id="date-mask" placeholder="">
                </div>
                <div class="mb-3">
                    <label class="font-weight-medium fs-3 mb-1">Nomor Telepon</label>
                    <input type="number" class="form-control date-inputmask" id="date-mask" placeholder="">
                </div>
            </div>
        </div>

        {{-- Saat sudah bayar --}}
        {{-- <div class="card">
            <div class="card-body">
                <h4 class="mb-4">Rincian Pembayaran</h4>
                <div class="mb-3 d-flex justify-content-between">
                    <h6>Kode Voucher</h6>
                    <h6 style="color: #175A95">ABCDE</h6>
                </div>
                <hr>
                <div class="mb-3 d-flex justify-content-between">
                    <h6>Harga Upload</h6>
                    <h6 style="color: #175A95">Rp. 100.000</h6>
                </div>
                <hr>
                <div class="mb-3 d-flex justify-content-between">
                    <h6>Diskon Voucher</h6>
                    <h6 style="color: #175A95">-Rp. 20.000</h6>
                </div>
                <hr>
                <div class="mb-3 d-flex justify-content-between">
                    <h6>Totar Pembayaran</h6>
                    <h6 style="color: #175A95">Rp. 80.000</h6>
                </div>
                <hr>
                <div class="mb-3 d-flex justify-content-between">
                    <h6>Batas Pembayaran</h6>
                    <h6 style="color: #175A95">DEV-T26250149620IYONL</h6>
                </div>
                <hr>
                <div class="mb-3 d-flex justify-content-between">
                    <h6>Kode Transaksi</h6>
                    <h6 style="color: #175A95">ABCDE</h6>
                </div>
                <hr>
                <div class="mb-3 d-flex justify-content-between">
                    <h6>Metode Pembayaran</h6>
                    <h6 style="color: #175A95">BCA</h6>
                </div>
                <hr>
                <div class="mb-3 d-flex justify-content-between">
                    <h6>Kode Pembayaran</h6>
                    <h6 style="color: #175A95">473635346744955
                        <i class="ti ti-copy fs-6 ms-3 icon-background"></i>
                    </h6>
                </div>
                <hr>
                <div class="mb-3 d-flex justify-content-between">
                    <h6>Status</h6>
                    <h6 style="color: #1EBB9E">Sudah Bayar</h6>
                </div>
            </div>
        </div> --}}
    </div>

</div>


@endsection

@section('script')


@endsection
