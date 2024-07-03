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
    <div class="modal fade" id="modal-accepted" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <form id="form-accepted" method="POST" class="modal-content">
                @method('put')
                @csrf
                <div class="modal-header d-flex align-items-center">
                    <h4 class="modal-title" id="myModalLabel">
                        Teima Iklan
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin akan menerima iklan ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-warning text-warning font-medium waves-effect"
                        data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-light-success text-success font-medium waves-effect"
                        data-bs-dismiss="modal">
                        Terima
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modal-reject" tabindex="-1" aria-labelledby="modal-reject Label">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal content -->
                <div class="modal-header">
                    <h3 class="modal-title ms-2 mt-2">Tolak Iklan Ini?</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form id="form-reject" method="POST">
                        @csrf
                        @method('put')
                        <div class="container">
                            <div class="mb-3">
                                <div>
                                    <h5 class="mb-3">Berikan Alasan</h5>
                                </div>
                                <div>
                                    <textarea class="form-control" name="description" id="" cols="30" rows="10"
                                        placeholder="Alasan tolak iklan" style="resize: none;"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-12">
                                <div class="d-flex justify-content-end gap-2">
                                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                                    <button data-bs-toggle="tooltip" type="submit" title="Tolak"
                                        class="btn btn-danger me-2">Tolak</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
            <button type="button" class="btn btn-danger btn-reject me-2" data-id="{{ $data->id }}">Tolak</button>
            <button type="button" class="btn btn-success btn-accepted" data-id="{{ $data->id }}"
                style="background-color: #175A95; border: none">Terima</button>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">
                    <h4>Detail Iklan</h4>
                    <div class="pt-3">
                        <h6 class="card-text">Gambar</h6>
                        <img src="{{ asset('storage/' . $data->image) }}" alt="Nama Gambar" style="max-width: 200px;" />
                    </div>
                    <div class="pt-4">
                        <h6>Halaman</h6>
                        <form>
                            <div class="form-group mb-4">
                                <select name="page" class="form-select" id="page-select" disabled>
                                    <option value="home"
                                        {{ $data->positionAdvertisement->page == 'home' ? 'selected' : '' }}>Dashboard
                                    </option>
                                    <option value="singlepost"
                                        {{ $data->positionAdvertisement->page == 'singlepost' ? 'selected' : '' }}>News Post
                                    </option>
                                    <option value="category"
                                        {{ $data->positionAdvertisement->page == 'category' ? 'selected' : '' }}>Kategori
                                    </option>
                                    <option value="subcategory"
                                        {{ $data->positionAdvertisement->page == 'subcategory' ? 'selected' : '' }}>Sub
                                        Kategori</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="pt-2">
                        <h6>Posisi Iklan</h6>
                        <div class="row py-2">
                            <div class="col-md-12">
                                @forelse ($positions as $position)
                                    @if ($data->position_advertisement_id == $position->id)
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="position_advertisement_id"
                                                        id="inlineRadio1-{{ $position->page }}"
                                                        value="{{ $position->id }}"
                                                        {{ $data->position_advertisement_id == $position->id ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">
                                                        <p class="ms-2">Posisi {{ $position->position }} Full</p>
                                                        <img src="{{ asset($position->image) }}" width="300"
                                                            height="200" alt="">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="pt-4">
                        <h6>Jenis Iklan</h6>
                        <form>
                            <div class="form-group mb-4">
                                <select class="form-select mr-sm-2" id="inlineFormCustomSelect" disabled>
                                    <option value="photo" {{ $data->type == 'photo' ? 'selected' : '' }}>Foto</option>
                                    <option value="video" {{ $data->type == 'video' ? 'selected' : '' }}>Video</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div>
                        <div class="d-flex pt-4">
                            <div class="me-4 w-100">
                                <h6>Tanggal Mulai</h6>
                                <input type="date" value="{{ $data->start_date }}" disabled
                                    class="form-control w-100">
                            </div>
                            <div class="w-100">
                                <h6>Tanggal Akhir</h6>
                                <input type="date" value="{{ $data->end_date }}" disabled class="form-control w-100">
                            </div>
                        </div>
                    </div>
                    <div class="pt-4">
                        <h6>URL</h6>
                        <input type="text" readonly value="{{ $data->url }}" class="form-control">
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
                        <input type="text" value="{{ $data->user->name }}" readonly
                            class="form-control date-inputmask" id="date-mask" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label class="font-weight-medium fs-3 mb-1">Email</label>
                        <input type="email" value="{{ $data->user->email }}" readonly
                            class="form-control date-inputmask" id="date-mask" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label class="font-weight-medium fs-3 mb-1">Nomor Telepon</label>
                        <input type="number" value="{{ $data->user->phone_number }}" readonly
                            class="form-control date-inputmask" id="date-mask" placeholder="">
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
    <script>
        $(document).ready(function() {
            const $pageSelect = $('#page-select');
            const $positionDivs = $('.form-check.form-check-inline');

            function showHidePositionDivs() {
                const selectedPage = $pageSelect.val();

                $positionDivs.each(function() {
                    const $positionInput = $(this).find('input[name="position_advertisement_id"]');
                    const positionPage = $positionInput.attr('id').split('-')[1];

                    if (selectedPage === positionPage) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }

            $pageSelect.on('change', showHidePositionDivs);
            showHidePositionDivs();
        });
    </script>

    <script>
        $('.btn-accepted').click(function() {
            var id = $(this).data('id');
            $('#form-accepted').attr('action', '/accepted-advertisement/' + id);
            $('#modal-accepted').modal('show');
        })

        $('.btn-reject').click(function() {
            var id = $(this).data('id');
            $('#form-reject').attr('action', '/reject-advertisement/' + id);
            $('#modal-reject').modal('show');
        })
    </script>
@endsection
