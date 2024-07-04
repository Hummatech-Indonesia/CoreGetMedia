@extends(auth()->user()->hasRole('author') ? 'layouts.author.app' : 'layouts.user.sidebar')

@section('style')
<style>
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

<div class="modal fade" id="modal-cencel" tabindex="-1" aria-labelledby="tambahdataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal content -->
            <div class="modal-header">
                <h3 class="modal-title">Cencel pengiklanan</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <form id="form-celcel" method="post">
                @method('DELETE')
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Yakin cancel iklan Anda secara permanen?</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-light-primary text-primary" data-bs-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-rounded btn-light-danger text-danger">Ya</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="tambahdataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal content -->
            <div class="modal-header">

                <h3 class="modal-title">Hapus Data</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <form id="form-delete" method="post">
                @method('DELETE')
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <p class="">Data akan dihapus secara permanen, yakin ingin menghapus data ini?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-light-primary text-primary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-rounded btn-light-danger text-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-description" tabindex="-1" aria-labelledby="modal-reject Label">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal content -->
            <div class="modal-header">
                <h3 class="modal-title ms-2 mt-2">Detail penolakan</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="container">
                    <div class="mb-3">
                        <div>
                            <h5 class="mb-3">Alasan Berita Anda Kami Tolak</h5>
                        </div>
                        <div class="d-flex">
                            <p id="detail-description" cols="30" rows="10"></p>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12">
                        <div class="d-flex justify-content-end gap-2">
                            <button class="btn bg-light-danger text-danger" type="button" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="">
    <div class="d-flex justify-content-between">
        <ul class="nav nav-underline" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" style="padding-right: 15px; padding-left: 15px;" id="active-tab" data-bs-toggle="tab" href="#active" role="tab" aria-controls="active" aria-expanded="true">
                    <span>Semua</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="padding-right: 15px; padding-left: 15px;" id="link1-tab" data-bs-toggle="tab" href="#link1" role="tab" aria-controls="link1">
                    <span>Diterima</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="padding-right: 15px; padding-left: 15px;" id="link2-tab" data-bs-toggle="tab" href="#link2" role="tab" aria-controls="link2">
                    <span>Pending</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="padding-right: 15px; padding-left: 15px;" id="link3-tab" data-bs-toggle="tab" href="#link3" role="tab" aria-controls="link2">
                    <span>Ditolak</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="padding-right: 15px; padding-left: 15px;" id="link4-tab" data-bs-toggle="tab" href="#link4" role="tab" aria-controls="link2">
                    <span>Draft</span>
                </a>
            </li>
        </ul>
        <div class="d-flex ml-auto">
            <a href="/advertisement-biodata" class="btn text-white" style="background-color: #175A95;">
                Unggah Iklan
            </a>
        </div>
    </div>


    <div class="tab-content tabcontent-border p-3" id="myTabContent">
        <div role="tabpanel" class="tab-pane fade show active" id="active" aria-labelledby="active-tab">
            @forelse ($all_advertisements as $all_advertisement)
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-2">
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $all_advertisement->image) }}" alt="" width="290px" height="180px" class="w-100" style="width: 100%; object-fit:cover;">
                                </div>
                            </div>
                            <div class="row col-md-12 col-lg-6">
                                <div class="row col-lg-6">
                                    <div class="col-lg-6 mb-3">
                                        <div class="fs-4 text-black">
                                            Jenis Iklan:
                                        </div>
                                        @if ($all_advertisement->type == 'photo')
                                        <div class="fs-4 mt-2">Gambar</div>
                                        @elseif ($all_advertisement->type == 'video')
                                        <div class="fs-4 mt-2">Video</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="fs-4 text-black">
                                            Tanggal Awal:
                                        </div>
                                        <div class="fs-4 mt-2">{{ $all_advertisement->start_date }}</div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="fs-4 text-black">
                                            Halaman:
                                        </div>
                                        <div class="fs-4 mt-2">{{ $all_advertisement->positionAdvertisement->page }}</div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="fs-4 text-black">
                                            Tanggal Akhir:
                                        </div>
                                        <div class="fs-4 mt-2">{{ $all_advertisement->end_date }}</div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="col-lg-12">
                                        <div class="fs-4 text-black">
                                            URL:
                                        </div>
                                        <div class="fs-4 mt-2">{{ $all_advertisement->url }}</div>
                                    </div>
                                    @if ($all_advertisement->price != null)
                                    <div class="col-lg-12 mt-5">
                                        <div class="fs-4 text-black">
                                            Harga :
                                        </div>
                                        <div class="fs-4 mt-2">{{ $all_advertisement->price }}</div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4">
                                <div class="d-flex justify-content-end gap-2">
                                    @if ($all_advertisement->status == 'pending')
                                    <div class="d-flex justify-content-end">
                                        <div class="text-md-right">
                                            <span class="badge bg-light-warning text-warning fs-4 px-3 py-2">
                                                Pending
                                            </span>
                                        </div>
                                    </div>
                                    @elseif ($all_advertisement->status == 'reject' && $all_advertisement->feed == 'notpaid')
                                    <div class="d-flex justify-content-end">
                                        <div class="text-md-right">
                                            <button data-description="{{ $all_advertisement->description }}" class="btn btn-sm btn-description m-1" style="background-color: #5D87FF;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="20" viewBox="0 0 512 512">
                                                    <path fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M255.66 112c-77.94 0-157.89 45.11-220.83 135.33a16 16 0 0 0-.27 17.77C82.92 340.8 161.8 400 255.66 400c92.84 0 173.34-59.38 221.79-135.25a16.14 16.14 0 0 0 0-17.47C428.89 172.28 347.8 112 255.66 112" />
                                                    <circle cx="256" cy="256" r="80" fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="32" />
                                                </svg>
                                            </button>
                                            <span class="badge bg-light-danger text-danger fs-4 px-3 py-2">
                                                Ditolak
                                            </span>
                                        </div>
                                    </div>
                                    @elseif ($all_advertisement->status == 'accepted' && $all_advertisement->feed == 'notpaid')
                                    <div class="d-flex justify-content-end">
                                        <div class="text-md-right">
                                            <span class="badge bg-light-danger text-danger fs-4 me-2 px-3 py-2">
                                                Belum Dibayar
                                            </span>
                                        </div>
                                        <div class="text-md-right">
                                            <span class="badge bg-light-success text-success fs-4 px-3 py-2">
                                                Diterima
                                            </span>
                                        </div>
                                    </div>
                                    @elseif ($all_advertisement->status == 'accepted' && $all_advertisement->feed == 'paid')
                                    <div class="d-flex justify-content-end">
                                        <div class="text-md-right">
                                            <span class="badge bg-light-success text-success fs-4 me-2 px-3 py-2">
                                                Sudah Dibayar
                                            </span>
                                        </div>
                                        <div class="text-md-right">
                                            <span class="badge bg-light-success text-success fs-4 px-3 py-2">
                                                Diterima
                                            </span>
                                        </div>
                                    </div>
                                    @elseif ($all_advertisement->status == 'published')
                                    <div class="d-flex justify-content-end">
                                        <div class="text-md-right">
                                            <span class="badge bg-light-success text-success fs-4 px-3 py-2">
                                                Published
                                            </span>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                                <div class="d-flex mt-4 justify-content-end">
                                    Apr 25, 2024
                                </div>

                                @if ($all_advertisement->status == 'accepted' && $all_advertisement->feed == 'notpaid')
                                <div class="d-flex justify-content-end">
                                    <button type="button" id="btn-delete" data-id="{{ $all_advertisement->id }}" class="btn m-1 mt-5 btn-delete text-white px-4 py-1" style="background-color: #C94F4F;">
                                        Batalkan
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24">
                                            <path fill="#ffffff" d="m12 12.708l-5.246 5.246q-.14.14-.344.15t-.364-.15t-.16-.354t.16-.354L11.292 12L6.046 6.754q-.14-.14-.15-.344t.15-.364t.354-.16t.354.16L12 11.292l5.246-5.246q.14-.14.345-.15q.203-.01.363.15t.16.354t-.16.354L12.708 12l5.246 5.246q.14.14.15.345q.01.203-.15.363t-.354.16t-.354-.16z" /></svg>
                                    </button>



                                    <a href="{{ route('detail-payment-advertisement', ['advertisement' => $all_advertisement->id]) }}" class="btn m-1 mt-5 text-white" style="background-color: #5D87FF;">
                                        Lanjut Pembayaran
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                            <path fill="#ffffff" d="m13.292 12l-4.6-4.6l.708-.708L14.708 12L9.4 17.308l-.708-.708z" /></svg>
                                    </a>

                                    
                                </div>
                                @elseif ($all_advertisement->status == 'accepted' && $all_advertisement->feed == 'paid')
                                <div class="d-flex justify-content-end">
                                    <p class="btn m-1 mt-5 text-white" style="background-color: #5D87FF;">
                                        Belum di publish
                                    </p>
                                </div>
                                @elseif ($all_advertisement->status == 'pending' || $all_advertisement->status == 'reject')
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('detail-advertisement', [$all_advertisement->id]) }}" class="btn btn-sm m-1 mt-5" style="background-color: #5D87FF;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="30" viewBox="0 0 512 512">
                                            <path fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M255.66 112c-77.94 0-157.89 45.11-220.83 135.33a16 16 0 0 0-.27 17.77C82.92 340.8 161.8 400 255.66 400c92.84 0 173.34-59.38 221.79-135.25a16.14 16.14 0 0 0 0-17.47C428.89 172.28 347.8 112 255.66 112" />
                                            <circle cx="256" cy="256" r="80" fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="32" />
                                        </svg>
                                    </a>

                                    <a href="{{ route('show.edit.advertisement', ['id' => $all_advertisement->id ]) }}" class="btn btn-sm m-1 mt-5" style="background-color: #FFD643;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24" class="mt-1">
                                            <path fill="#ffffff" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h8.925l-2 2H5v14h14v-6.95l2-2V19q0 .825-.587 1.413T19 21zm4-6v-4.25l9.175-9.175q.3-.3.675-.45t.75-.15q.4 0 .763.15t.662.45L22.425 3q.275.3.425.663T23 4.4q0 .375-.137.738t-.438.662L13.25 15zM21.025 4.4l-1.4-1.4zM11 13h1.4l5.8-5.8l-.7-.7l-.725-.7L11 11.575zm6.5-6.5l-.725-.7zl.7.7z" /></svg>
                                    </a>

                                    <button type="button" id="btn-delete" data-id="{{ $all_advertisement->id }}" class="btn btn-sm m-1 mt-5 btn-delete" style="background-color: #C94F4F;"><svg xmlns="http://www.w3.org/2000/svg" width="23" height="30" viewBox="0 0 512 512">
                                            <path d="M128 405.429C128 428.846 147.198 448 170.667 448h170.667C364.802 448 384 428.846 384 405.429V160H128v245.429zM416 96h-80l-26.785-32H202.786L176 96H96v32h320V96z" fill="#ffffff" /></svg></button>
                                </div>
                                @endif

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center mt-5 pt-5">
                <img src="{{ asset('assets/Empty-cuate.png') }}" alt="" width="300px">
                <p>Tidak ada iklan</p>
            </div>
            @endforelse
        </div>

        <div class="tab-pane fade" id="link1" role="tabpanel" aria-labelledby="link1-tab">
            @forelse ($accepted_advertisements as $accepted_advertisement)
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-2">
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $accepted_advertisement->image) }}" alt="" width="290px" height="180px" class="w-100" style="width: 100%; object-fit:cover;">
                                </div>
                            </div>
                            <div class="row col-md-12 col-lg-6">
                                <div class="row col-lg-6">
                                    <div class="col-lg-6 mb-3">
                                        <div class="fs-4 text-black">
                                            Jenis Iklan:
                                        </div>
                                        @if ($accepted_advertisement->type == 'photo')
                                        <div class="fs-4 mt-2">Gambar</div>
                                        @elseif ($accepted_advertisement->type == 'video')
                                        <div class="fs-4 mt-2">Video</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="fs-4 text-black">
                                            Tanggal Awal:
                                        </div>
                                        <div class="fs-4 mt-2">{{ $accepted_advertisement->start_date }}</div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="fs-4 text-black">
                                            Halaman:
                                        </div>
                                        <div class="fs-4 mt-2">{{ $accepted_advertisement->page }}</div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="fs-4 text-black">
                                            Tanggal Akhir:
                                        </div>
                                        <div class="fs-4 mt-2">{{ $accepted_advertisement->end_date }}</div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="col-lg-12">
                                        <div class="fs-4 text-black">
                                            URL:
                                        </div>
                                        <div class="fs-4 mt-2">{{ $accepted_advertisement->url }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <div class="d-flex justify-content-end">
                                        @if ($accepted_advertisement->feed = 'notpaid')
                                        <div class="text-md-right">
                                            <span class="badge bg-light-danger text-danger fs-4 me-2 px-3 py-2">
                                                Belum Dibayar
                                            </span>
                                        </div>
                                        @elseif ($accepted_advertisement->feed = 'paid')
                                        <div class="text-md-right">
                                            <span class="badge bg-light-success text-success fs-4 me-2 px-3 py-2">
                                                Sudah Dibayar
                                            </span>
                                        </div>
                                        @endif
                                        <div class="text-md-right">
                                            <span class="badge bg-light-success text-success fs-4 px-3 py-2">
                                                Diterima
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex mt-4 justify-content-end">
                                    Apr 25, 2024
                                </div>

                                @if ($accepted_advertisement->feed == 'notpaid')
                                <div class="d-flex justify-content-end">
                                    <button type="button" id="btn-cencel" data-id="{{ $accepted_advertisement->id }}" class="btn m-1 mt-5 btn-cencel text-white px-4 py-1" style="background-color: #C94F4F;">
                                        Batalkan
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24">
                                            <path fill="#ffffff" d="m12 12.708l-5.246 5.246q-.14.14-.344.15t-.364-.15t-.16-.354t.16-.354L11.292 12L6.046 6.754q-.14-.14-.15-.344t.15-.364t.354-.16t.354.16L12 11.292l5.246-5.246q.14-.14.345-.15q.203-.01.363.15t.16.354t-.16.354L12.708 12l5.246 5.246q.14.14.15.345q.01.203-.15.363t-.354.16t-.354-.16z" />
                                        </svg>
                                    </button>

                                    <a href="#" class="btn m-1 mt-5 text-white" style="background-color: #5D87FF;">
                                        Lanjut Pembayaran
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                            <path fill="#ffffff" d="m13.292 12l-4.6-4.6l.708-.708L14.708 12L9.4 17.308l-.708-.708z" />
                                        </svg>
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center mt-5 pt-5">
                <img src="{{ asset('assets/Empty-cuate.png') }}" alt="" width="300px">
                <p>Tidak ada iklan yang diterima</p>
            </div>
            @endforelse
        </div>

        <div class="tab-pane fade" id="link2" role="tabpanel" aria-labelledby="link2-tab">
            @forelse ($pending_advertisements as $pending_advertisement)
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-2">
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $pending_advertisement->image) }}" alt="" width="290px" height="180px" class="w-100" style="width: 100%; object-fit:cover;">
                                </div>
                            </div>
                            <div class="row col-md-12 col-lg-6">
                                <div class="row col-lg-6">
                                    <div class="col-lg-6 mb-3">
                                        <div class="fs-4 text-black">
                                            Jenis Iklan:
                                        </div>
                                        @if ($pending_advertisement->type == 'photo')
                                        <div class="fs-4 mt-2">Gambar</div>
                                        @elseif ($pending_advertisement->type == 'video')
                                        <div class="fs-4 mt-2">Video</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="fs-4 text-black">
                                            Tanggal Awal:
                                        </div>
                                        <div class="fs-4 mt-2">{{ $pending_advertisement->start_date }}</div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="fs-4 text-black">
                                            Halaman:
                                        </div>
                                        <div class="fs-4 mt-2">{{ $pending_advertisement->page }}</div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="fs-4 text-black">
                                            Tanggal Akhir:
                                        </div>
                                        <div class="fs-4 mt-2">{{ $pending_advertisement->end_date }}</div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="col-lg-12">
                                        <div class="fs-4 text-black">
                                            URL:
                                        </div>
                                        <div class="fs-4 mt-2">{{ $pending_advertisement->url }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <div class="d-flex justify-content-end">
                                        <div class="text-md-right">
                                            <span class="badge bg-light-warning text-warning fs-4 px-3 py-2">
                                                Pending
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex mt-4 justify-content-end">
                                    Apr 25, 2024
                                </div>

                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('detail-advertisement', [$pending_advertisement->id]) }}" class="btn btn-sm m-1 mt-5" style="background-color: #5D87FF;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="30" viewBox="0 0 512 512">
                                            <path fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M255.66 112c-77.94 0-157.89 45.11-220.83 135.33a16 16 0 0 0-.27 17.77C82.92 340.8 161.8 400 255.66 400c92.84 0 173.34-59.38 221.79-135.25a16.14 16.14 0 0 0 0-17.47C428.89 172.28 347.8 112 255.66 112" />
                                            <circle cx="256" cy="256" r="80" fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="32" />
                                        </svg>
                                    </a>

                                    <a href="{{ route('show.edit.advertisement', ['id' => $pending_advertisement->id]) }}" class="btn btn-sm m-1 mt-5" style="background-color: #FFD643;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 2 24 24">
                                            <path fill="#ffffff" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h8.925l-2 2H5v14h14v-6.95l2-2V19q0 .825-.587 1.413T19 21zm4-6v-4.25l9.175-9.175q.3-.3.675-.45t.75-.15q.4 0 .763.15t.662.45L22.425 3q.275.3.425.663T23 4.4q0 .375-.137.738t-.438.662L13.25 15zM21.025 4.4l-1.4-1.4zM11 13h1.4l5.8-5.8l-.7-.7l-.725-.7L11 11.575zm6.5-6.5l-.725-.7zl.7.7z" />
                                        </svg>
                                    </a>

                                    <button type="button" id="btn-delete" data-id="{{ $pending_advertisement->id }}" class="btn btn-sm m-1 mt-5 btn-delete" style="background-color: #C94F4F;"><svg xmlns="http://www.w3.org/2000/svg" width="23" height="30" viewBox="0 0 512 512">
                                            <path d="M128 405.429C128 428.846 147.198 448 170.667 448h170.667C364.802 448 384 428.846 384 405.429V160H128v245.429zM416 96h-80l-26.785-32H202.786L176 96H96v32h320V96z" fill="#ffffff" />
                                        </svg></button>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            @empty
            <div class="text-center mt-5 pt-5">
                <img src="{{ asset('assets/Empty-cuate.png') }}" alt="" width="300px">
                <p>Tidak ada data</p>
            </div>
            @endforelse
        </div>

        <div class="tab-pane fade" id="link3" role="tabpanel" aria-labelledby="link3-tab">
            @forelse ($reject_advertisements as $reject_advertisement)
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-2">
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $reject_advertisement->image) }}" alt="" width="290px" height="180px" class="w-100" style="width: 100%; object-fit:cover;">
                                </div>
                            </div>
                            <div class="row col-md-12 col-lg-6">
                                <div class="row col-lg-6">
                                    <div class="col-lg-6 mb-3">
                                        <div class="fs-4 text-black">
                                            Jenis Iklan:
                                        </div>
                                        @if ($reject_advertisement->type == 'photo')
                                        <div class="fs-4 mt-2">Gambar</div>
                                        @elseif ($reject_advertisement->type == 'video')
                                        <div class="fs-4 mt-2">Video</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="fs-4 text-black">
                                            Tanggal Awal:
                                        </div>
                                        <div class="fs-4 mt-2">{{ $reject_advertisement->start_date }}</div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="fs-4 text-black">
                                            Halaman:
                                        </div>
                                        <div class="fs-4 mt-2">{{ $reject_advertisement->page }}</div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="fs-4 text-black">
                                            Tanggal Akhir:
                                        </div>
                                        <div class="fs-4 mt-2">{{ $reject_advertisement->end_date }}</div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="col-lg-12">
                                        <div class="fs-4 text-black">
                                            URL:
                                        </div>
                                        <div class="fs-4 mt-2">{{ $reject_advertisement->url }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4">

                                <div class="d-flex justify-content-end gap-2">
                                    <div class="d-flex justify-content-end">
                                        <div class="text-md-right">
                                            <button data-description="{{ $reject_advertisement->description }}" class="btn btn-sm btn-description m-1" style="background-color: #5D87FF;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="20" viewBox="0 0 512 512">
                                                    <path fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M255.66 112c-77.94 0-157.89 45.11-220.83 135.33a16 16 0 0 0-.27 17.77C82.92 340.8 161.8 400 255.66 400c92.84 0 173.34-59.38 221.79-135.25a16.14 16.14 0 0 0 0-17.47C428.89 172.28 347.8 112 255.66 112" />
                                                    <circle cx="256" cy="256" r="80" fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="32" />
                                                </svg>
                                            </button>
                                            <span class="badge bg-light-danger text-danger fs-4 px-3 py-2">
                                                Ditolak
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex mt-4 justify-content-end">
                                    Apr 25, 2024
                                </div>

                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('detail-advertisement', ['advertisement' => $reject_advertisement->id]) }}" class="btn btn-sm m-1 mt-5" style="background-color: #5D87FF;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="30" viewBox="0 0 512 512">
                                            <path fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M255.66 112c-77.94 0-157.89 45.11-220.83 135.33a16 16 0 0 0-.27 17.77C82.92 340.8 161.8 400 255.66 400c92.84 0 173.34-59.38 221.79-135.25a16.14 16.14 0 0 0 0-17.47C428.89 172.28 347.8 112 255.66 112" />
                                            <circle cx="256" cy="256" r="80" fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="32" />
                                        </svg>
                                    </a>

                                    <a href="{{ route('show.edit.advertisement', [$reject_advertisement->id]) }}" class="btn btn-sm m-1 mt-5" style="background-color: #FFD643;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24">
                                            <path fill="#ffffff" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h8.925l-2 2H5v14h14v-6.95l2-2V19q0 .825-.587 1.413T19 21zm4-6v-4.25l9.175-9.175q.3-.3.675-.45t.75-.15q.4 0 .763.15t.662.45L22.425 3q.275.3.425.663T23 4.4q0 .375-.137.738t-.438.662L13.25 15zM21.025 4.4l-1.4-1.4zM11 13h1.4l5.8-5.8l-.7-.7l-.725-.7L11 11.575zm6.5-6.5l-.725-.7zl.7.7z" />
                                        </svg>
                                    </a>

                                    <button type="button" id="btn-delete" data-id="{{ $reject_advertisement->id }}" class="btn btn-sm m-1 mt-5 btn-delete" style="background-color: #C94F4F;"><svg xmlns="http://www.w3.org/2000/svg" width="23" height="30" viewBox="0 0 512 512">
                                            <path d="M128 405.429C128 428.846 147.198 448 170.667 448h170.667C364.802 448 384 428.846 384 405.429V160H128v245.429zM416 96h-80l-26.785-32H202.786L176 96H96v32h320V96z" fill="#ffffff" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center mt-5 pt-5">
                <img src="{{ asset('assets/Empty-cuate.png') }}" alt="" width="300px">
                <p>Tidak ada iklan yang ditolak</p>
            </div>
            @endforelse
        </div>


        <div class="tab-pane fade" id="link4" role="tabpanel" aria-labelledby="link4-tab">
            @forelse ($drafts as $draft)
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-2">
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $draft->image) }}" alt="" width="290px" height="180px" class="w-100" style="width: 100%; object-fit:cover;">
                                </div>
                            </div>
                            <div class="row col-md-12 col-lg-6">
                                <div class="row col-lg-6">
                                    <div class="col-lg-6 mb-3">
                                        <div class="fs-4 text-black">
                                            Jenis Iklan:
                                        </div>
                                        @if ($draft->type == 'photo')
                                        <div class="fs-4 mt-2">Gambar</div>
                                        @elseif ($draft->type == 'video')
                                        <div class="fs-4 mt-2">Video</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="fs-4 text-black">
                                            Tanggal Awal:
                                        </div>
                                        <div class="fs-4 mt-2">{{ $draft->start_date }}</div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="fs-4 text-black">
                                            Halaman:
                                        </div>
                                        <div class="fs-4 mt-2">{{ $draft->page }}</div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="fs-4 text-black">
                                            Tanggal Akhir:
                                        </div>
                                        <div class="fs-4 mt-2">{{ $draft->end_date }}</div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="col-lg-12">
                                        <div class="fs-4 text-black">
                                            URL:
                                        </div>
                                        <div class="fs-4 mt-2">{{ $draft->url }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <div class="d-flex justify-content-end">
                                        <div class="text-md-right">
                                            <span class="badge bg-light-success text-success fs-4 px-3 py-2">
                                                Draft
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex mt-4 justify-content-end">
                                    Apr 25, 2024
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="button" id="btn-delete" data-id="{{ $draft->id }}" class="btn m-1 mt-5 btn-delete text-white px-4 py-1" style="background-color: #C94F4F;">
                                        Hapus
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24">
                                            <path fill="#ffffff" d="m12 12.708l-5.246 5.246q-.14.14-.344.15t-.364-.15t-.16-.354t.16-.354L11.292 12L6.046 6.754q-.14-.14-.15-.344t.15-.364t.354-.16t.354.16L12 11.292l5.246-5.246q.14-.14.345-.15q.203-.01.363.15t.16.354t-.16.354L12.708 12l5.246 5.246q.14.14.15.345q.01.203-.15.363t-.354.16t-.354-.16z" />
                                        </svg>
                                    </button>

                                    <a href="{{ route('show.edit.advertisement', ['id' => $draft->id]) }}" class="btn m-1 mt-5 text-white" style="background-color: #175A95;">
                                        Lanjut Mengedit
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                            <path fill="#ffffff" d="m13.292 12l-4.6-4.6l.708-.708L14.708 12L9.4 17.308l-.708-.708z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            @endforelse
        </div>

    </div>

    @endsection
    @section('script')
    <script>
        $('.btn-delete').on('click', function() {
            var id = $(this).data('id');
            $('#form-delete').attr('action', '/delete-advertisement/' + id);
            $('#modal-delete').modal('show');
        });

        $('.btn-cencel').on('click', function() {
            var id = $(this).data('id');
            $('#form-cencel').attr('action', '/delete-advertisement/' + id);
            $('#modal-cencel').modal('show');
        });

        $('.btn-description').on('click', function() {
            var description = $(this).data('description');
            $('#modal-description').modal('show');
            $('#detail-description').text(description);
        });

    </script>
    @endsection
