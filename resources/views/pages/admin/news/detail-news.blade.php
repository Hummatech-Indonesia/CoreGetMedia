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
                <h4 class="fw-semibold mb-3 mt-2 text-white">Konfirmasi Artikel</h4>
                <p>Artikel akan di unggah setelah persetujuan admin</p>
            </div>
            <div class="col-3">
                <div class="text-center mb-n4">
                    <img src="{{ asset('assets/img/bg-ajuan.svg') }}" width="250px" alt="" class="bg-mobile">
                </div>
            </div>
        </div>
    </div>
</div>
<div>
    <div class="d-flex justify-content-between">
        <div class="d-flex justify-content-start gap-2">

            <div>
                <div class="d-flex gap-2 mb-3">
                    <a href="/news-list" class="btn btn-lg px-3 text-white btn-sm" style="background-color: #5D87FF;">Kembali</a>
                </div>
            </div>

            {{-- @if ($news->status === 'panding')
            <div>
                @if ($news->status === "panding")
                <div>
                    <div class="d-flex gap-2 mb-3">
                        <a href="/news-list" class="btn btn-lg px-3 text-white" style="background-color: #5D87FF;">Kembali</a>
                    </div>
                </div>
                @else
                <div>
                    <div class="d-flex gap-2 mb-3">
                        <a href="/news-approved-list" class="btn btn-lg px-3 text-white" style="background-color: #5D87FF;">Kembali</a>
                    </div>
                </div>
                @endif
            </div>
            @else
            <div>
                <div class="d-flex gap-2 mb-3">
                    <a href="/news-approved-list" class="btn btn-lg px-3 text-white" style="background-color: #5D87FF;">Kembali</a>
                </div>
            </div>
            @endif --}}
        </div>

        <div class="d-flex gap-2">
            @if ($news->status != 'accepted')
            <div class="">
                <button id="btn-reject-{{ $news->id }}" data-id="{{ $news->id }}" type="button" class="btn btn-danger btn-sm btn-reject btn-lg px-3">Tolak</button>
            </div>
            <div class="">
                <button id="btn-approved-{{ $news->id }}" data-id="{{ $news->id }}" type="button" class="btn btn-success btn-sm btn-approved btn-lg px-3
                        ">Terima</button>
            </div>
            @elseif ($news->pin != '1')
            <div class="">
                <button id="btn-pin-{{ $news->id }}" data-id="{{ $news->id }}" type="button" class="btn btn-primary btn-sm btn-pin btn-lg px-3">Pin Berita</button>
            </div>
            @elseif ($news->pin == '1')
            <div class="">
                <button id="btn-unpin-{{ $news->id }}" data-id="{{ $news->id }}" type="button" class="btn btn-primary btn-sm btn-unpin btn-lg px-3">Unpin Berita</button>
            </div>
            @else
            @endif
        </div>
    </div>

    <form id="myForm" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <h3 for="" class="form-label">Thumbnail</h3>
                        <div class="gambar-iklan mb-4 d-flex justify-content-center">
                            <img id="preview" class="hide" style="object-fit: cover; border: transparent;" width="350" height="200" alt="">
                            <img width="350" height="200" src="{{asset('storage/'.  $news->image )}}" alt="">
                        </div>

                        @error('photo')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h3 class="mb-3">Detail Lainya</h3>
                        <div class="col-lg-12 mb-4">
                            <label class="form-label" for="password_confirmation">Penulis</label>
                            <input type="text" class="form-control" value="{{ $news->user->name }}" readonly>
                            @error('category')
                            <span class="invalid-feedback" role="alert" style="color: red">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-lg-12 mb-4">
                            <label class="form-label" for="password_confirmation">Kategori</label>
                            <div class="kat-container">
                                @foreach ($newsCategory as $category)
                                <p class="tmbl">
                                    {{$category->category->name}}
                                </p>
                                @endforeach
                            </div>
                            @error('category')
                            <span class="invalid-feedback" role="alert" style="color: red">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-lg-12 mb-4">
                            <div class="mt-2" style="max-width: 100%;">
                                <label class="form-label" for="password_confirmation">Sub Kategori</label>
                                <div class="kat-container">
                                    @foreach ($newsSubcategory as $subCategory)
                                    <p class="tmbl">
                                        {{$subCategory->subCategory->name}}
                                    </p>
                                    @endforeach
                                </div>
                                @error('sub_category')
                                <span class="invalid-feedback" role="alert" style="color: red">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12 mb-4">
                            <label class="form-label" for="password_confirmation">Tanggal Upload</label>
                            <input type="datetime-local" id="upload_date" name="upload_date" value="{{ \Carbon\Carbon::parse($news->date)->format('Y-m-d\TH:i'); }}" class="form-control @error('upload_date') is-invalid @enderror">
                            @error('upload_date')
                            <span class="invalid-feedback" role="alert" style="color: red">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label class="form-label" for="password_confirmation">Tags</label>
                            <div class="kat-container">
                                @foreach ($newsTags as $newstag)
                                <p class="tmbl">
                                    {{$newstag->tags->name}}
                                </p>
                                @endforeach
                            </div>
                            @error('tags')
                            <span class="invalid-feedback" role="alert" style="color: red;">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <h3 class="mb-3">Isi Berita</h3>
                        <div>
                            <div class="col-lg-12 mb-4">
                                <label class="form-label" for="nomor">Judul Berita</label>
                                <input type="text" id="name" name="name" placeholder="name" value="{{ $news->name }}" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                <span class="invalid-feedback" role="alert" style="color: red;">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-lg-12 mb-4" style="height: auto;">
                                <label class="form-label" for="content">Isi Berita</label>
                                <textarea" name="content" placeholder="content" style="resize: none; height: 400;" class="form-control @error('content') is-invalid @enderror">{!! $news->description !!}</textarea>
                                    @error('content')
                                    <span class="invalid-feedback" role="alert" style="color: red;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</div>

<div class="modal fade" id="modal-approved" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <form id="form-approved" method="POST" class="modal-content">
            @method('put')
            @csrf
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="myModalLabel">
                    Teima Berita
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <p>Apakah anda yakin akan menerima berita ini?</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-warning text-warning font-medium waves-effect" data-bs-dismiss="modal">
                    Batal
                </button>
                <button type="submit" class="btn btn-light-success text-success font-medium waves-effect" data-bs-dismiss="modal">
                    Terima
                </button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modal-pin" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <form id="form-pin" method="POST" class="modal-content">
            @method('put')
            @csrf
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="myModalLabel">
                    Pin Berita
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <p>Apakah anda yakin akan mengpin berita ini?</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-warning text-warning font-medium waves-effect" data-bs-dismiss="modal">
                    Tidak
                </button>
                <button type="submit" class="btn btn-light-success text-success font-medium waves-effect" data-bs-dismiss="modal">
                    Ya
                </button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modal-unpin" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <form id="form-unpin" method="POST" class="modal-content">
            @method('put')
            @csrf
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="myModalLabel">
                    Unpin Berita
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <p>Apakah anda yakin akan mengunpin berita ini?</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-warning text-warning font-medium waves-effect" data-bs-dismiss="modal">
                    Tidak
                </button>
                <button type="submit" class="btn btn-light-success text-success font-medium waves-effect" data-bs-dismiss="modal">
                    Ya
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
                <h3 class="modal-title ms-2 mt-2">Tolak Berita Ini?</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form action="#" method="POST">
                    {{-- @csrf
                    @method('patch') --}}
                    <div class="container">
                        <div class="mb-3">
                            <div>
                                <h5 class="mb-3">Berikan Alasan</h5>
                            </div>
                            <div>
                                <textarea class="form-control" name="massage" id="" cols="30" rows="10" placeholder="Berita yang ditulis ada unsur penghinaan pihak tertentu" style="resize: none;"></textarea>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-12">
                            <div class="d-flex justify-content-end">
                                <button data-bs-toggle="tooltip" title="Tolak" class="btn btn-danger me-2">Tolak</button>
                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<script>
    $('.btn-approved').click(function() {
        var id = $(this).data('id');
        $('#form-approved').attr('action', '/approved-news/' + id);
        $('#modal-approved').modal('show');
    })

    $('.btn-pin').click(function() {
        var id = $(this).data('id');
        $('#form-pin').attr('action', '/pin-news/' + id);
        $('#modal-pin').modal('show');
    })

    $('.btn-unpin').click(function() {
        var id = $(this).data('id');
        $('#form-unpin').attr('action', '/unpin-news/' + id);
        $('#modal-unpin').modal('show');
    })

    $('.btn-reject').click(function() {
        var id = $(this).data('id');
        $('#form-approved').attr('action', '/approved-news/' + id);
        $('#modal-approved').modal('show');
    })

</script>
@endsection
