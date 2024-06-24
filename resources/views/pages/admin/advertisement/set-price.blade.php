@extends('layouts.admin.app')

@section('head')
    <title>Admin | News</title>
@endsection

@section('style')
    <style>
        .card {
            border: 1px solid #CCCCCC;
        }
    </style>
    <style>
        .nav-tabs .nav-link.active {
            background-color: #175A95 !important;
            color: #fff !important;
        }
    </style>
@endsection

@section('content')

<h3 class="mb-4">Pilih Halaman</h3>
    <div class="card">
        <div class="p-2">

            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" data-bs-toggle="tab" href="#navpill-111" role="tab" aria-selected="true">
                        <span>Beranda</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#navpill-222" role="tab" aria-selected="false">
                        <span>Single Post</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#navpill-333" role="tab" aria-selected="false">
                        <span>Semua Berita</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#navpill-444" role="tab" aria-selected="false">
                        <span>Kategori</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#navpill-555" role="tab" aria-selected="false">
                        <span>Sub Kategori</span>
                    </a>
                </li>
            </ul>

        </div>
    </div>

    <div class="tab-content">
        <!-- Tab Beranda -->
        <div id="navpill-111" class="tab-pane fade show active" role="tabpanel">
            <h3 class="mb-3">Keterangan Iklan di Beranda</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-3">Keterangan posisi iklan & ukuran</h6>
                            <h4 class="mb-3">Posisi Atas</h4>
                            {{-- (1000 x 1000) --}}
                            <h6>Preview posisi</h6>
                            <img src="{{ asset('assets/iklan.png') }}" alt="Nama Gambar" class="img-fluid mt-2 mb-4"
                                style="max-width: 250px; border: none;">
                            <h6 class="mb-2">Harga :</h6>
                            <h4 class="mb-4">Rp. 100.000</h4>

                            <div class="d-flex justify-content-between">
                                <button type="button" data-page="home" data-position="top" class="btn mb-1 waves-effect waves-light btn-warning w-100" style="background-color: #FFD643; border: none">
                                    Edit
                                    <i class="ti ti-edit"></i>
                                </button>

                                <button type="button" data-page="home" data-position="top"
                                    class="btn mb-1 waves-effect waves-light btn-danger w-100 ms-4">
                                    Hapus
                                    <i class="ti ti-trash"></i>
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-3">Keterangan posisi iklan & ukuran</h6>
                            <h4 class="mb-3">Posisi Kanan</h4>
                            <h6>Preview posisi</h6>
                            <img src="{{ asset('assets/iklan.png') }}" alt="Nama Gambar" class="img-fluid mt-2 mb-4"
                                style="max-width: 250px; border: none;">
                            <h6 class="mb-2">Harga :</h6>
                            <h4 class="mb-4">Rp. 100.000</h4>

                            <div class="d-flex justify-content-between">
                                <button type="button" data-page="home" data-position="right" class="btn mb-1 waves-effect waves-light btn-warning w-100" style="background-color: #FFD643; border: none">
                                    Edit
                                    <i class="ti ti-edit"></i>
                                </button>

                                <button type="button" data-page="home" data-position="right"
                                    class="btn mb-1 waves-effect waves-light btn-danger w-100 ms-4">
                                    Hapus
                                    <i class="ti ti-trash"></i>
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-3">Keterangan posisi iklan & ukuran</h6>
                            <h4 class="mb-3">Posisi Bawah</h4>
                            <h6>Preview posisi</h6>
                            <img src="{{ asset('assets/iklan.png') }}" alt="Nama Gambar" class="img-fluid mt-2 mb-4"
                                style="max-width: 250px; border: none;">
                            <h6 class="mb-2">Harga :</h6>
                            <h4 class="mb-4">Rp. 100.000</h4>

                            <div class="d-flex justify-content-between">
                                <button type="button" data-page="home" data-position="under" class="btn mb-1 waves-effect waves-light btn-warning w-100" style="background-color: #FFD643; border: none">
                                    Edit
                                    <i class="ti ti-edit"></i>
                                </button>

                                <button type="button" data-page="home" data-position="under"
                                    class="btn mb-1 waves-effect waves-light btn-danger w-100 ms-4">
                                    Hapus
                                    <i class="ti ti-trash"></i>
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab Diterima -->
        <div id="navpill-222" class="tab-pane fade" role="tabpanel">
            <h3 class="mb-3">Keterangan Iklan di Singlepost</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-3">Keterangan posisi iklan & ukuran</h6>
                            <h4 class="mb-3">Posisi Kanan</h4>
                            <h6>Preview posisi</h6>
                            <img src="{{ asset('assets/iklan.png') }}" alt="Nama Gambar" class="img-fluid mt-2 mb-4"
                                style="max-width: 250px; border: none;">
                            <h6 class="mb-2">Harga :</h6>
                            <h4 class="mb-4">Rp. 100.000</h4>

                            <div class="d-flex justify-content-between">
                                <button type="button" data-page="singlepost" data-position="right" class="btn mb-1 waves-effect waves-light btn-warning w-100" style="background-color: #FFD643; border: none">
                                    Edit
                                    <i class="ti ti-edit"></i>
                                </button>

                                <button type="button" data-page="singlepost" data-position="right"
                                    class="btn mb-1 waves-effect waves-light btn-danger w-100 ms-4">
                                    Hapus
                                    <i class="ti ti-trash"></i>
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- Card 2 -->
                </div>
                <div class="col-md-4">
                    <!-- Card 3 -->
                </div>
            </div>
        </div>

        <!-- Tab Pending -->
        <div id="navpill-333" class="tab-pane fade" role="tabpanel">
            <h3 class="mb-3">Keterangan Iklan di Semua Berita</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-3">Keterangan posisi iklan & ukuran</h6>
                            <h4 class="mb-3">Posisi Kanan</h4>
                            <h6>Preview posisi</h6>
                            <img src="{{ asset('assets/iklan.png') }}" alt="Nama Gambar" class="img-fluid mt-2 mb-4"
                                style="max-width: 250px; border: none;">
                            <h6 class="mb-2">Harga :</h6>
                            <h4 class="mb-4">Rp. 100.000</h4>

                            <div class="d-flex justify-content-between">
                                <button type="button" data-page="allnews" data-position="right" class="btn mb-1 waves-effect waves-light btn-warning w-100" style="background-color: #FFD643; border: none">
                                    Edit
                                    <i class="ti ti-edit"></i>
                                </button>

                                <button type="button" data-page="allnews" data-position="right"
                                    class="btn mb-1 waves-effect waves-light btn-danger w-100 ms-4">
                                    Hapus
                                    <i class="ti ti-trash"></i>
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-3">Keterangan posisi iklan & ukuran</h6>
                            <h4 class="mb-3">Posisi Bawah</h4>
                            <h6>Preview posisi</h6>
                            <img src="{{ asset('assets/iklan.png') }}" alt="Nama Gambar" class="img-fluid mt-2 mb-4"
                                style="max-width: 250px; border: none;">
                            <h6 class="mb-2">Harga :</h6>
                            <h4 class="mb-4">Rp. 100.000</h4>

                            <div class="d-flex justify-content-between">
                                <button type="button" data-page="allnews" data-position="under" class="btn mb-1 waves-effect waves-light btn-warning w-100" style="background-color: #FFD643; border: none">
                                    Edit
                                    <i class="ti ti-edit"></i>
                                </button>

                                <button type="button" data-page="allnews" data-position="under"
                                    class="btn mb-1 waves-effect waves-light btn-danger w-100 ms-4">
                                    Hapus
                                    <i class="ti ti-trash"></i>
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- Card 3 -->
                </div>
            </div>
        </div>

        <!-- Tab Ditolak -->
        <div id="navpill-444" class="tab-pane fade" role="tabpanel">
            <h3 class="mb-3">Keterangan Iklan di Kategori</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-3">Keterangan posisi iklan & ukuran</h6>
                            <h4 class="mb-3">Posisi Kanan</h4>
                            <h6>Preview posisi</h6>
                            <img src="{{ asset('assets/iklan.png') }}" alt="Nama Gambar" class="img-fluid mt-2 mb-4"
                                style="max-width: 250px; border: none;">
                            <h6 class="mb-2">Harga :</h6>
                            <h4 class="mb-4">Rp. 100.000</h4>

                            <div class="d-flex justify-content-between">
                                <button type="button" data-page="category" data-position="right" class="btn mb-1 waves-effect waves-light btn-warning w-100" style="background-color: #FFD643; border: none">
                                    Edit
                                    <i class="ti ti-edit"></i>
                                </button>

                                <button type="button" data-page="category" data-position="right"
                                    class="btn mb-1 waves-effect waves-light btn-danger w-100 ms-4">
                                    Hapus
                                    <i class="ti ti-trash"></i>
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-3">Keterangan posisi iklan & ukuran</h6>
                            <h4 class="mb-3">Posisi Bawah</h4>
                            <h6>Preview posisi</h6>
                            <img src="{{ asset('assets/iklan.png') }}" alt="Nama Gambar" class="img-fluid mt-2 mb-4"
                                style="max-width: 250px; border: none;">
                            <h6 class="mb-2">Harga :</h6>
                            <h4 class="mb-4">Rp. 100.000</h4>

                            <div class="d-flex justify-content-between">
                                <button type="button" data-page="category" data-position="under" class="btn mb-1 waves-effect waves-light btn-warning w-100" style="background-color: #FFD643; border: none">
                                    Edit
                                    <i class="ti ti-edit"></i>
                                </button>

                                <button type="button" data-page="category" data-position="under"
                                    class="btn mb-1 waves-effect waves-light btn-danger w-100 ms-4">
                                    Hapus
                                    <i class="ti ti-trash"></i>
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- Card 3 -->
                </div>
            </div>
        </div>

        <!-- Tap Sub Kategori -->
        <div id="navpill-555" class="tab-pane fade" role="tabpanel">
            <h3 class="mb-3">Keterangan Iklan di Sub Kategori</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-3">Keterangan posisi iklan & ukuran</h6>
                            <h4 class="mb-3">Posisi Kanan</h4>
                            <h6>Preview posisi</h6>
                            <img src="{{ asset('assets/iklan.png') }}" alt="Nama Gambar" class="img-fluid mt-2 mb-4"
                                style="max-width: 250px; border: none;">
                            <h6 class="mb-2">Harga :</h6>
                            <h4 class="mb-4">Rp. 100.000</h4>

                            <div class="d-flex justify-content-between">
                                <button type="button" data-page="subcategory" data-position="right" class="btn mb-1 waves-effect waves-light btn-warning w-100" style="background-color: #FFD643; border: none">
                                    Edit
                                    <i class="ti ti-edit"></i>
                                </button>

                                <button type="button" data-page="subcategory" data-position="right"
                                    class="btn mb-1 waves-effect waves-light btn-danger w-100 ms-4">
                                    Hapus
                                    <i class="ti ti-trash"></i>
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-3">Keterangan posisi iklan & ukuran</h6>
                            <h4 class="mb-3">Posisi Bawah</h4>
                            <h6>Preview posisi</h6>
                            <img src="{{ asset('assets/iklan.png') }}" alt="Nama Gambar" class="img-fluid mt-2 mb-4"
                                style="max-width: 250px; border: none;">
                            <h6 class="mb-2">Harga :</h6>
                            <h4 class="mb-4">Rp. 100.000</h4>

                            <div class="d-flex justify-content-between">
                                <button type="button" data-page="subcategory" data-position="under" class="btn mb-1 waves-effect waves-light btn-warning w-100" style="background-color: #FFD643; border: none">
                                    Edit
                                    <i class="ti ti-edit"></i>
                                </button>

                                <button type="button" data-page="subcategory" data-position="under"
                                    class="btn mb-1 waves-effect waves-light btn-danger w-100 ms-4">
                                    Hapus
                                    <i class="ti ti-trash"></i>
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- Card 3 -->
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="modal-update" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Keterangan Iklan</h5>
                    <button type="button" class="btn-close" data-dismiss="modal">
                    </button>
                </div>
                <form id="form-edit" method="POST">
                @method('post')
                @csrf
                <div class="modal-body">
                        <div class="form-group">
                            <label for="inputText1" class="mb-2">Keterangan posisi & Ukuran</label>
                            <input type="text" name="page" class="form-control mb-3" id="show-page" placeholder="Masukkan keterangan">
                        </div>
                        <div class="form-group">
                            <label for="inputFile" class="mb-2">Detail Posisi</label>
                            <input class="form-control mb-3" name="position" id="show-position" type="text">
                        </div>
                        <div class="form-group">
                            <label for="inputText2" class="mb-2">Harga</label>
                            <input type="number" name="price" class="form-control" id="inputText2" placeholder="Masukkan harga">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $('.btn-warning').on('click', function() {
        var page = $(this).data('page');
        var position = $(this).data('position');
        $('#form-edit').attr('action', '/position-price');
        $('#show-page').val(page);
        $('#show-position').val(position);
        $('#modal-update').modal('show');
    });
</script>

@endsection
