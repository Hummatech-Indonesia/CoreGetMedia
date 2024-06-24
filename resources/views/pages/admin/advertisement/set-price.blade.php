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
                @forelse ($home as $home)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="mb-3">Keterangan posisi iklan & ukuran</h6>
                                <h4 class="mb-3">Posisi {{ $home->position->label() }}</h4>
                                <h6>Preview posisi</h6>
                                <img src="{{ asset('assets/iklan.png') }}" alt="Nama Gambar" class="img-fluid mt-2 mb-4"
                                    style="max-width: 250px; border: none;">
                                <h6 class="mb-2">Harga :</h6>
                                <h4 class="mb-4">Rp. {{ number_format($home->price, 0, ',', '.') }}</h4>

                                <div class="d-flex justify-content-between">
                                    <button type="button" data-page="{{$home->page}}" data-image="{{ $home->image }}" data-position="{{$home->position}}" data-price="{{ $home->price }}" class="btn mb-1 waves-effect waves-light btn-warning w-100" style="background-color: #FFD643; border: none">
                                        Edit
                                        <i class="ti ti-edit"></i>
                                    </button>

                                    <button type="button" data-page="home" data-position="top"
                                        class="btn mb-1 waves-effect waves-light btn-danger w-100 ms-4 btn-delete"
                                        id="btn-delete-{{ $home->id }}" data-id="{{ $home->id }}">
                                        Hapus
                                        <i class="ti ti-trash"></i>
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                @empty

                @endforelse
            </div>
        </div>

        <!-- Tab Singlepost -->
        <div id="navpill-222" class="tab-pane fade" role="tabpanel">
            <h3 class="mb-3">Keterangan Iklan di Singlepost</h3>
            <div class="row">
                @forelse ($singlepost as $singlepost)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="mb-3">Keterangan posisi iklan & ukuran</h6>
                                <h4 class="mb-3">Posisi {{ $singlepost->position->label() }}</h4>
                                <h6>Preview posisi</h6>
                                <img src="{{ asset('assets/iklan.png') }}" alt="Nama Gambar" class="img-fluid mt-2 mb-4"
                                    style="max-width: 250px; border: none;">
                                <h6 class="mb-2">Harga :</h6>
                                <h4 class="mb-4">Rp. {{ number_format($singlepost->price, 0, ',', '.') }}</h4>

                                <div class="d-flex justify-content-between">
                                    <button type="button" data-image="{{ $singlepost->image }}" data-page="{{$singlepost->page}}" data-position="{{$singlepost->position}}" data-price="{{ $singlepost->price }}" class="btn mb-1 waves-effect waves-light btn-warning w-100" style="background-color: #FFD643; border: none">
                                        Edit
                                        <i class="ti ti-edit"></i>
                                    </button>

                                    <button type="button" data-page="home" data-position="top"
                                        class="btn mb-1 waves-effect waves-light btn-danger w-100 ms-4 btn-delete"
                                        id="btn-delete-{{ $singlepost->id }}" data-id="{{ $singlepost->id }}">
                                        Hapus
                                        <i class="ti ti-trash"></i>
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                @empty

                @endforelse
            </div>
        </div>

        <!-- Tab Semua Berita -->
        <div id="navpill-333" class="tab-pane fade" role="tabpanel">
            <h3 class="mb-3">Keterangan Iklan di Semua Berita</h3>
            <div class="row">
                @forelse ($allnews as $allnews)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="mb-3">Keterangan posisi iklan & ukuran</h6>
                                <h4 class="mb-3">Posisi {{ $allnews->position->label() }}</h4>
                                <h6>Preview posisi</h6>
                                <img src="{{ asset('assets/iklan.png') }}" alt="Nama Gambar" class="img-fluid mt-2 mb-4"
                                    style="max-width: 250px; border: none;">
                                <h6 class="mb-2">Harga :</h6>
                                <h4 class="mb-4">Rp. {{ number_format($allnews->price, 0, ',', '.') }}</h4>

                                <div class="d-flex justify-content-between">
                                    <button type="button" data-image="{{ $category->image }}" data-page="{{$allnews->page}}" data-position="{{$allnews->position}}" data-price="{{ $allnews->price }}" class="btn mb-1 waves-effect waves-light btn-warning w-100" style="background-color: #FFD643; border: none">
                                        Edit
                                        <i class="ti ti-edit"></i>
                                    </button>

                                    <button type="button" data-page="home" data-position="top"
                                        class="btn mb-1 waves-effect waves-light btn-danger w-100 ms-4 btn-delete"
                                        id="btn-delete-{{ $allnews->id }}" data-id="{{ $allnews->id }}">
                                        Hapus
                                        <i class="ti ti-trash"></i>
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                @empty

                @endforelse
            </div>
        </div>

        <!-- Tab Kategori -->
        <div id="navpill-444" class="tab-pane fade" role="tabpanel">
            <h3 class="mb-3">Keterangan Iklan di Kategori</h3>
            <div class="row">
                @forelse ($categories as $category)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="mb-3">Keterangan posisi iklan & ukuran</h6>
                                <h4 class="mb-3">Posisi {{ $category->position->label() }}</h4>
                                <h6>Preview posisi</h6>
                                <img src="{{ asset('assets/iklan.png') }}" alt="Nama Gambar" class="img-fluid mt-2 mb-4"
                                    style="max-width: 250px; border: none;">
                                <h6 class="mb-2">Harga :</h6>
                                <h4 class="mb-4">Rp. {{ number_format($category->price, 0, ',', '.') }}</h4>

                                <div class="d-flex justify-content-between">
                                    <button type="button" data-image="{{ $category->image }}" data-page="{{$category->page}}" data-position="{{$category->position}}" data-price="{{ $category->price }}" class="btn mb-1 waves-effect waves-light btn-warning w-100" style="background-color: #FFD643; border: none">
                                        Edit
                                        <i class="ti ti-edit"></i>
                                    </button>

                                    <button type="button" data-page="home" data-position="top"
                                        class="btn mb-1 waves-effect waves-light btn-danger w-100 ms-4 btn-delete"
                                        id="btn-delete-{{ $category->id }}" data-id="{{ $category->id }}">
                                        Hapus
                                        <i class="ti ti-trash"></i>
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                @empty

                @endforelse
            </div>
        </div>

        <!-- Tap Sub Kategori -->
        <div id="navpill-555" class="tab-pane fade" role="tabpanel">
            <h3 class="mb-3">Keterangan Iklan di Sub Kategori</h3>
            <div class="row">
                @forelse ($subcategories as $subcategory)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="mb-3">Keterangan posisi iklan & ukuran</h6>
                                <h4 class="mb-3">Posisi {{ $subcategory->position->label() }}</h4>
                                <h6>Preview posisi</h6>
                                <img src="{{ asset('assets/iklan.png') }}" alt="Nama Gambar" class="img-fluid mt-2 mb-4"
                                    style="max-width: 250px; border: none;">
                                <h6 class="mb-2">Harga :</h6>
                                <h4 class="mb-4">Rp. {{ number_format($subcategory->price, 0, ',', '.') }}</h4>

                                <div class="d-flex justify-content-between">
                                    <button type="button" data-page="{{$subcategory->page}}" data-image="{{ $subcategory->image }}" data-position="{{$subcategory->position}}" data-price="{{ $subcategory->price }}" class="btn mb-1 waves-effect waves-light btn-warning w-100" style="background-color: #FFD643; border: none">
                                        Edit
                                        <i class="ti ti-edit"></i>
                                    </button>

                                    <button type="button" data-page="home" data-position="top"
                                        class="btn mb-1 waves-effect waves-light btn-danger w-100 ms-4 btn-delete"
                                        id="btn-delete-{{ $subcategory->id }}" data-id="{{ $subcategory->id }}">
                                        Hapus
                                        <i class="ti ti-trash"></i>
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="modal-update" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Keterangan Iklan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-edit" method="POST">
                    @method('post')
                    @csrf
                    <div class="modal-body">
                        {{-- <div class="form-group"> --}}
                            {{-- <label for="inputText1" class="mb-2">Keterangan posisi & Ukuran</label> --}}
                            <input hidden type="text" name="page" class="form-control mb-3" id="show-page" placeholder="Masukkan keterangan">
                        {{-- </div> --}}
                        <img src="" id="position-image" alt="">

                        <div class="form-group mt-2">
                            <label for="inputFile" class="mb-2">Preview</label>
                            <input class="form-control mb-3" name="image" id="" type="file">
                        </div>

                        <div class="form-group">
                            <label for="inputFile" class="mb-2">Posisi</label>
                            <input class="form-select mb-3" readonly name="position" id="show-position" type="text">
                        </div>
                        <div class="form-group">
                            <label for="inputText2" class="mb-2">Harga</label>
                            <input type="number" name="price" class="form-control" id="show-price" placeholder="Masukkan harga">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <form id="form-delete" method="POST" class="modal-content">
                @csrf
                @method('DELETE')
                <div class="modal-header d-flex align-items-center">
                    <h4 class="modal-title" id="myModalLabel">
                        Hapus data
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <p>Apakah anda yakin akan menghapus data ini? </p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-danger text-danger font-medium waves-effect" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-light-danger text-secondery font-medium waves-effect" data-bs-dismiss="modal">
                        Hapus
                    </button>
                </div>
            </form>
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
        var price = $(this).data('price');
        var image = $(this).data('image');

        $('#form-edit').attr('action', '/position-price');
        $('#show-page').val(page);
        $('#show-position').val(position);
        $('#show-price').val(price);
        $('#position-image').attr('src' , image);
        $('#modal-update').modal('show');
    });

    $('.btn-delete').click(function() {
        var id = $(this).data('id');
        $('#form-delete').attr('action', '/set-price/delete/' + id);
        $('#modal-delete').modal('show');
    })
</script>

@endsection
