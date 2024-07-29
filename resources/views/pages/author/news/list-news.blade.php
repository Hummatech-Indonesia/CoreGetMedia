@extends('layouts.author.app')

@section('style')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<style>
.news-card-a {
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 2%;
    align-items: center;
    background-color: #fff;
}

.card-detail img {
    max-width: 100%;
    max-height: 100%;
    height: auto;
    border-radius: 1;
}

@media (max-width: 767px) {
    .card-detail img {
        width: 100%;
    }
}

.src-input input {
    height: 39px;
}
</style>
@endsection

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Author | List News</title>
</head>

@section('content')
<div>
    <ul class="nav nav-underline" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="all-tab" data-bs-toggle="tab" href="#all" role="tab" aria-controls="all"
                aria-expanded="true">
                <span>Semua</span>
            </a>
        </li>
        <li class="nav-item ms-2">
            <a class="nav-link" id="pending-tab" data-bs-toggle="tab" href="#pending" role="tab"
                aria-controls="pending">
                <span>Pending</span>
            </a>
        </li>
        <li class="nav-item ms-2">
            <a class="nav-link" id="rejected-tab" data-bs-toggle="tab" href="#rejected" role="tab"
                aria-controls="rejected">
                <span>Ditolak</span>
            </a>
        </li>
        <li class="nav-item ms-2">
            <a class="nav-link" id="accepted-tab" data-bs-toggle="tab" href="#accepted" role="tab"
                aria-controls="accepted">
                <span>Diterima</span>
            </a>
        </li>
        <li class="nav-item ms-2">
            <a class="nav-link" id="draft-tab" data-bs-toggle="tab" href="#draft" role="tab" aria-controls="accepted">
                <span>Draft</span>
            </a>
        </li>
    </ul>
</div>
<div class="mt-4">
    <form class="d-flex justify-content-between">
        <div class="d-flex">
            <div class="input-group src-input">
                <input type="text" name="search" class="form-control search-chat py-2 px-3 ps-5" placeholder="Search">
                <i class="ti ti-search position-absolute top-50 translate-middle-y fs-6 text-dark ms-3"></i>
                <button type="submit" class="btn btn-outline-primary px-4">Cari</button>
            </div>

            <div class="d-flex gap-2 ms-2">
                <select class="form-select" id="status" style="width: 200px" name="status">
                    <option value="">Tampilkan semua</option>
                    <option value="panding">Pending</option>
                    <option value="active">Approved</option>
                    <option value="nonactive">Reject</option>
                </select>
            </div>
        </div>

        <div class="justify-content-end">
            <a href="{{ route('create.news') }}" class="btn btn-primary">Tambah</a>
        </div>
    </form>
</div>

<div class="tab-content tabcontent-border p-3" id="myTabContent">
    <div role="tabpanel" class="tab-pane fade show active" id="all" aria-labelledby="active-tab">
        @forelse ($news as $data)
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-2">
                            <div class="mb-2">
                                @if ($data->image != null && Storage::disk('public')->exists($data->image))
                                <img src="{{ asset('storage/' . $data->image) }}" alt="{{ $data->name }}" width="290px"
                                    height="180px" class="w-100" style="width: 100%; object-fit:cover;" />
                                @else
                                <img src="{{ asset('assets/blank-img.jpg') }}" alt="{{ $data->name }}" width="290px"
                                    height="180px" class="w-100" style="width: 100%; object-fit:cover;" />
                                @endif
                            </div>
                        </div>
                        <div class="row col-md-12 col-lg-7">
                            <div class="col-lg-12 mb-3">
                                <h4>
                                    {!! Illuminate\Support\Str::limit(strip_tags($data->name), 150, '...') !!}
                                </h4>
                                <div class="fs-4 mt-2">
                                    {!! Illuminate\Support\Str::limit(strip_tags($data->description), 300, '...') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-3">

                            <div class="d-flex justify-content-end gap-2">

                                <div class="d-flex justify-content-end">
                                    <div class="text-md-right">
                                        @php
                                        if ($data->deleted_at != null) {
                                            $color = 'primary';
                                            $text = 'Draft';
                                        } elseif ($data->status == 'reject') {
                                            $color = 'danger';
                                            $text = 'Ditolak';
                                        } elseif ($data->status == 'accepted') {
                                            $color = 'success';
                                            $text = 'Aktif';
                                        } else {
                                            $color = 'warning';
                                            $text = 'Pending';
                                        }
                                        @endphp
                                        <div class="col gap-2">
                                            @if ($data->status == 'reject')
                                            <button type="button" class="btn me-2 btn-reason btn-primary"
                                                data-id="{{ $data->id }}" data-reason="{{ $data->reject_description }}">
                                                <i class="ti ti-message-dots fs-6"></i>
                                            </button>
                                            @endif
                                            <span class="badge bg-light-{{ $color }} text-{{ $color }} fs-4 px-3 py-2">
                                                {{ $text }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex mt-4 justify-content-end">
                                {{ \Carbon\Carbon::parse($data->upload_date)->format('M d, Y') }}
                            </div>

                            <div class="d-flex justify-content-end">
                                @if ($data->deleted_at != null)
                                    <button type="submit" id="btn-cencel" data-id="{{ $data->id }}"
                                        class="btn m-1 mt-5 btn-delete text-white" style="background-color: #C94F4F;">
                                        Hapus
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24">
                                            <path fill="#ffffff"
                                                d="m12 12.708l-5.246 5.246q-.14.14-.344.15t-.364-.15t-.16-.354t.16-.354L11.292 12L6.046 6.754q-.14-.14-.15-.344t.15-.364t.354-.16t.354.16L12 11.292l5.246-5.246q.14-.14.345-.15q.203-.01.363.15t.16.354t-.16.354L12.708 12l5.246 5.246q.14.14.15.345q.01.203-.15.363t-.354.16t-.354-.16z" />
                                        </svg>
                                    </button>

                                    <a href="{{ route('edit.news', ['news' => $data->slug]) }}" class="btn m-1 mt-5 text-white" style="background-color: #175A95;">
                                        Lanjut Mengedit
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                            <path fill="#ffffff"    
                                                d="m13.292 12l-4.6-4.6l.708-.708L14.708 12L9.4 17.308l-.708-.708z" />
                                        </svg>
                                    </a>
                                @else
                                    <a href="{{ route('news.singlepost', $data->slug) }}" class="btn btn-sm m-1 mt-5"
                                        style="background-color: #5D87FF;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="30"
                                            viewBox="0 0 512 512">
                                            <path fill="none" stroke="#ffffff" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="32"
                                                d="M255.66 112c-77.94 0-157.89 45.11-220.83 135.33a16 16 0 0 0-.27 17.77C82.92 340.8 161.8 400 255.66 400c92.84 0 173.34-59.38 221.79-135.25a16.14 16.14 0 0 0 0-17.47C428.89 172.28 347.8 112 255.66 112" />
                                            <circle cx="256" cy="256" r="80" fill="none" stroke="#ffffff"
                                                stroke-miterlimit="10" stroke-width="32" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('edit.news', ['news' => $data->slug]) }}" class="btn btn-sm m-1 mt-5"
                                        style="background-color: #FFD643;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="23"
                                            viewBox="0 0 512 512">
                                            <path
                                                d="M64 368v80h80l235.727-235.729-79.999-79.998L64 368zm377.602-217.602c8.531-8.531 8.531-21.334 0-29.865l-50.135-50.135c-8.531-8.531-21.334-8.531-29.865 0l-39.468 39.469 79.999 79.998 39.469-39.467z"
                                                fill="#ffffff" />
                                        </svg>
                                    </a>
                                    <button type="submit" class="btn btn-sm m-1 mt-5 btn-delete" data-id="{{ $data->id }}"
                                        style="background-color: #C94F4F;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="23"
                                            viewBox="0 0 512 512">
                                            <path
                                                d="M128 405.429C128 428.846 147.198 448 170.667 448h170.667C364.802 448 384 428.846 384 405.429V160H128v245.429zM416 96h-80l-26.785-32H202.786L176 96H96v32h320V96z"
                                                fill="#ffffff" />
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        @empty
        <div class="text-center mt-5">
            <img src="{{ asset('assets/Empty-cuate.png') }}" alt="" width="300px">
            <p>Tidak ada berita</p>
        </div>
        @endforelse
    </div>
    <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
        @forelse ($pendings as $data)
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-2">
                            <div class="mb-2">
                                @if ($data->image != null && Storage::disk('public')->exists($data->image))
                                <img src="{{ asset('storage/' . $data->image) }}" alt="{{ $data->name }}" width="290px"
                                    height="180px" class="w-100" style="width: 100%; object-fit:cover;" />
                                @else
                                <img src="{{ asset('assets/blank-img.jpg') }}" alt="{{ $data->name }}" width="290px"
                                    height="180px" class="w-100" style="width: 100%; object-fit:cover;" />
                                @endif
                            </div>
                        </div>
                        <div class="row col-md-12 col-lg-7">
                            <div class="col-lg-12 mb-3">
                                <h4>
                                    {!! Illuminate\Support\Str::limit(strip_tags($data->name), 150, '...') !!}
                                </h4>
                                <div class="fs-4 mt-2">
                                    {!! Illuminate\Support\Str::limit(strip_tags($data->description), 300, '...') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-3">

                            <div class="d-flex justify-content-end gap-2">

                                <div class="d-flex justify-content-end">
                                    <div class="text-md-right">
                                        @php
                                        if ($data->status == 'reject') {
                                        $color = 'danger';
                                        $text = 'Ditolak';
                                        } elseif ($data->status == 'accepted') {
                                        $color = 'success';
                                        $text = 'Aktif';
                                        } else {
                                        $color = 'warning';
                                        $text = 'Pending';
                                        }
                                        @endphp
                                        <span class="badge bg-light-{{ $color }} text-{{ $color }} fs-4 px-3 py-2">
                                            {{ $text }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex mt-4 justify-content-end">
                                {{ \Carbon\Carbon::parse($data->upload_date)->format('M d, Y') }}
                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('news.singlepost', $data->slug) }}" class="btn btn-sm m-1 mt-5"
                                    style="background-color: #5D87FF;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="30"
                                        viewBox="0 0 512 512">
                                        <path fill="none" stroke="#ffffff" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="32"
                                            d="M255.66 112c-77.94 0-157.89 45.11-220.83 135.33a16 16 0 0 0-.27 17.77C82.92 340.8 161.8 400 255.66 400c92.84 0 173.34-59.38 221.79-135.25a16.14 16.14 0 0 0 0-17.47C428.89 172.28 347.8 112 255.66 112" />
                                        <circle cx="256" cy="256" r="80" fill="none" stroke="#ffffff"
                                            stroke-miterlimit="10" stroke-width="32" />
                                    </svg>
                                </a>
                                <a href="{{ route('edit.news', ['news' => $data->slug]) }}" class="btn btn-sm m-1 mt-5"
                                    style="background-color: #FFD643;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="23"
                                        viewBox="0 0 512 512">
                                        <path
                                            d="M64 368v80h80l235.727-235.729-79.999-79.998L64 368zm377.602-217.602c8.531-8.531 8.531-21.334 0-29.865l-50.135-50.135c-8.531-8.531-21.334-8.531-29.865 0l-39.468 39.469 79.999 79.998 39.469-39.467z"
                                            fill="#ffffff" />
                                    </svg>
                                </a>
                                <button type="submit" class="btn btn-sm m-1 mt-5 btn-delete" data-id="{{ $data->id }}"
                                    style="background-color: #C94F4F;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="23"
                                        viewBox="0 0 512 512">
                                        <path
                                            d="M128 405.429C128 428.846 147.198 448 170.667 448h170.667C364.802 448 384 428.846 384 405.429V160H128v245.429zM416 96h-80l-26.785-32H202.786L176 96H96v32h320V96z"
                                            fill="#ffffff" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        @empty
        <div class="text-center mt-5">
            <img src="{{ asset('assets/Empty-cuate.png') }}" alt="" width="300px">
            <p>Tidak ada berita</p>
        </div>
        @endforelse
    </div>
    <div class="tab-pane fade" id="rejected" role="tabpanel" aria-labelledby="rejected-tab">
        @forelse ($rejecteds as $data)
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-2">
                            <div class="mb-2">
                                @if ($data->image != null && Storage::disk('public')->exists($data->image))
                                <img src="{{ asset('storage/' . $data->image) }}" alt="{{ $data->name }}" width="290px"
                                    height="180px" class="w-100" style="width: 100%; object-fit:cover;" />
                                @else
                                <img src="{{ asset('assets/blank-img.jpg') }}" alt="{{ $data->name }}" width="290px"
                                    height="180px" class="w-100" style="width: 100%; object-fit:cover;" />
                                @endif
                            </div>
                        </div>
                        <div class="row col-md-12 col-lg-7">
                            <div class="col-lg-12 mb-3">
                                <h4>
                                    {!! Illuminate\Support\Str::limit(strip_tags($data->name), 150, '...') !!}
                                </h4>
                                <div class="fs-4 mt-2">
                                    {!! Illuminate\Support\Str::limit(strip_tags($data->description), 300, '...') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-3">

                            <div class="d-flex justify-content-end gap-2">

                                <div class="d-flex justify-content-end">
                                    <div class="text-md-right">
                                        @php
                                        if ($data->status == 'reject') {
                                        $color = 'danger';
                                        $text = 'Ditolak';
                                        } elseif ($data->status == 'accepted') {
                                        $color = 'success';
                                        $text = 'Aktif';
                                        } else {
                                        $color = 'warning';
                                        $text = 'Pending';
                                        }
                                        @endphp
                                        <div class="col gap-2">
                                            @if ($data->status == 'reject')
                                            <button type="button" class="btn me-2 btn-reason btn-primary"
                                                data-id="{{ $data->id }}" data-reason="{{ $data->description }}">
                                                <i class="ti ti-message-dots fs-6"></i>
                                            </button>
                                            @endif
                                            <span class="badge bg-light-{{ $color }} text-{{ $color }} fs-4 px-3 py-2">
                                                {{ $text }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex mt-4 justify-content-end">
                                {{ \Carbon\Carbon::parse($data->upload_date)->format('M d, Y') }}
                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('news.singlepost', $data->slug) }}" class="btn btn-sm m-1 mt-5"
                                    style="background-color: #5D87FF;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="30"
                                        viewBox="0 0 512 512">
                                        <path fill="none" stroke="#ffffff" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="32"
                                            d="M255.66 112c-77.94 0-157.89 45.11-220.83 135.33a16 16 0 0 0-.27 17.77C82.92 340.8 161.8 400 255.66 400c92.84 0 173.34-59.38 221.79-135.25a16.14 16.14 0 0 0 0-17.47C428.89 172.28 347.8 112 255.66 112" />
                                        <circle cx="256" cy="256" r="80" fill="none" stroke="#ffffff"
                                            stroke-miterlimit="10" stroke-width="32" />
                                    </svg>
                                </a>
                                <a href="{{ route('edit.news', ['news' => $data->slug]) }}" class="btn btn-sm m-1 mt-5"
                                    style="background-color: #FFD643;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="23"
                                        viewBox="0 0 512 512">
                                        <path
                                            d="M64 368v80h80l235.727-235.729-79.999-79.998L64 368zm377.602-217.602c8.531-8.531 8.531-21.334 0-29.865l-50.135-50.135c-8.531-8.531-21.334-8.531-29.865 0l-39.468 39.469 79.999 79.998 39.469-39.467z"
                                            fill="#ffffff" />
                                    </svg>
                                </a>
                                <button type="submit" class="btn btn-sm m-1 mt-5 btn-delete" data-id="{{ $data->id }}"
                                    style="background-color: #C94F4F;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="23"
                                        viewBox="0 0 512 512">
                                        <path
                                            d="M128 405.429C128 428.846 147.198 448 170.667 448h170.667C364.802 448 384 428.846 384 405.429V160H128v245.429zM416 96h-80l-26.785-32H202.786L176 96H96v32h320V96z"
                                            fill="#ffffff" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        @empty
        <div class="text-center mt-5">
            <img src="{{ asset('assets/Empty-cuate.png') }}" alt="" width="300px">
            <p>Tidak ada berita</p>
        </div>
        @endforelse
    </div>
    <div class="tab-pane fade" id="accepted" role="tabpanel" aria-labelledby="accepted-tab">
        @forelse ($accepteds as $data)
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-2">
                            <div class="mb-2">
                                @if ($data->image != null && Storage::disk('public')->exists($data->image))
                                <img src="{{ asset('storage/' . $data->image) }}" alt="{{ $data->name }}" width="290px"
                                    height="180px" class="w-100" style="width: 100%; object-fit:cover;" />
                                @else
                                <img src="{{ asset('assets/blank-img.jpg') }}" alt="{{ $data->name }}" width="290px"
                                    height="180px" class="w-100" style="width: 100%; object-fit:cover;" />
                                @endif
                            </div>
                        </div>
                        <div class="row col-md-12 col-lg-7">
                            <div class="col-lg-12 mb-3">
                                <h4>
                                    {!! Illuminate\Support\Str::limit(strip_tags($data->name), 150, '...') !!}
                                </h4>
                                <div class="fs-4 mt-2">
                                    {!! Illuminate\Support\Str::limit(strip_tags($data->description), 300, '...') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-3">

                            <div class="d-flex justify-content-end gap-2">

                                <div class="d-flex justify-content-end">
                                    <div class="text-md-right">
                                        @php
                                        if ($data->status == 'reject') {
                                        $color = 'danger';
                                        $text = 'Ditolak';
                                        } elseif ($data->status == 'accepted') {
                                        $color = 'success';
                                        $text = 'Aktif';
                                        } else {
                                        $color = 'warning';
                                        $text = 'Pending';
                                        }
                                        @endphp
                                        <span class="badge bg-light-{{ $color }} text-{{ $color }} fs-4 px-3 py-2">
                                            {{ $text }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex mt-4 justify-content-end">
                                {{ \Carbon\Carbon::parse($data->upload_date)->format('M d, Y') }}
                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('news.singlepost', $data->slug) }}" class="btn btn-sm m-1 mt-5"
                                    style="background-color: #5D87FF;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="30"
                                        viewBox="0 0 512 512">
                                        <path fill="none" stroke="#ffffff" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="32"
                                            d="M255.66 112c-77.94 0-157.89 45.11-220.83 135.33a16 16 0 0 0-.27 17.77C82.92 340.8 161.8 400 255.66 400c92.84 0 173.34-59.38 221.79-135.25a16.14 16.14 0 0 0 0-17.47C428.89 172.28 347.8 112 255.66 112" />
                                        <circle cx="256" cy="256" r="80" fill="none" stroke="#ffffff"
                                            stroke-miterlimit="10" stroke-width="32" />
                                    </svg>
                                </a>
                                <a href="{{ route('edit.news', ['news' => $data->slug]) }}" class="btn btn-sm m-1 mt-5"
                                    style="background-color: #FFD643;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="23"
                                        viewBox="0 0 512 512">
                                        <path
                                            d="M64 368v80h80l235.727-235.729-79.999-79.998L64 368zm377.602-217.602c8.531-8.531 8.531-21.334 0-29.865l-50.135-50.135c-8.531-8.531-21.334-8.531-29.865 0l-39.468 39.469 79.999 79.998 39.469-39.467z"
                                            fill="#ffffff" />
                                    </svg>
                                </a>
                                <button type="submit" class="btn btn-sm m-1 mt-5 btn-delete" data-id="{{ $data->id }}"
                                    style="background-color: #C94F4F;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="23"
                                        viewBox="0 0 512 512">
                                        <path
                                            d="M128 405.429C128 428.846 147.198 448 170.667 448h170.667C364.802 448 384 428.846 384 405.429V160H128v245.429zM416 96h-80l-26.785-32H202.786L176 96H96v32h320V96z"
                                            fill="#ffffff" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        @empty
        <div class="text-center mt-5">
            <img src="{{ asset('assets/Empty-cuate.png') }}" alt="" width="300px">
            <p>Tidak ada berita</p>
        </div>
        @endforelse
    </div>

    <div class="tab-pane fade" id="draft" role="tabpanel" aria-labelledby="draft-tab">
        @forelse ($drafts as $draft)
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-2">
                                <div class="mb-2">
                                    <img src="{{ asset('storage/'. $draft->image) }}" width="290px" height="180px" class="w-100"
                                        style="width: 100%; object-fit:cover;" />
                                </div>
                            </div>
                            <div class="row col-md-12 col-lg-7">
                                <div class="col-lg-12 mb-3">
                                    <h4>
                                       {{ $draft->name }}
                                    </h4>
                                    <div class="fs-4 mt-2">
                                        {!! Illuminate\Support\Str::limit(strip_tags($data->description), 300, '...') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-3">

                                <div class="d-flex justify-content-end gap-2">

                                    <div class="d-flex justify-content-end">
                                        <div class="text-md-right">
                                            <span class="badge bg-light-warning text-warning fs-4 px-3 py-2">
                                                Draft
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex mt-4 justify-content-end">
                                    {{ \Carbon\Carbon::parse($draft->upload_date)->format('M d, Y') }}
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" id="btn-cencel" data-id="{{ $draft->id }}"
                                        class="btn m-1 mt-5 btn-delete text-white" style="background-color: #C94F4F;">
                                        Hapus
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24">
                                            <path fill="#ffffff"
                                                d="m12 12.708l-5.246 5.246q-.14.14-.344.15t-.364-.15t-.16-.354t.16-.354L11.292 12L6.046 6.754q-.14-.14-.15-.344t.15-.364t.354-.16t.354.16L12 11.292l5.246-5.246q.14-.14.345-.15q.203-.01.363.15t.16.354t-.16.354L12.708 12l5.246 5.246q.14.14.15.345q.01.203-.15.363t-.354.16t-.354-.16z" />
                                        </svg>
                                    </button>

                                    <a href="{{ route('edit.news', ['news' => $draft->slug]) }}" class="btn m-1 mt-5 text-white" style="background-color: #175A95;">
                                        Lanjut Mengedit
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                            <path fill="#ffffff"    
                                                d="m13.292 12l-4.6-4.6l.708-.708L14.708 12L9.4 17.308l-.708-.708z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        @empty
        <div class="text-center mt-5">
            <img src="{{ asset('assets/Empty-cuate.png') }}" alt="" width="300px">
            <p>Draft anda kosong</p>
        </div>
        @endforelse
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
                <button type="button" class="btn btn-light-danger text-danger font-medium waves-effect"
                    data-bs-dismiss="modal">
                    Batal
                </button>
                <button type="submit" class="btn btn-light-danger text-secondery font-medium waves-effect"
                    data-bs-dismiss="modal">
                    Hapus
                </button>
            </div>
        </form>
    </div>
</div>

{{-- modal reason start --}}
<div class="modal fade" id="modal-reason" tabindex="-1" aria-labelledby="vertical-center-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content p-3">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="myModalLabel">
                    Berita ditolak
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Alasan: </h5>
                <div class="d-flex">
                <p name="reject_description" id="reason-show" ></p>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-danger text-danger font-medium waves-effect"
                    data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
{{-- modal reason end --}}
@endsection
@section('script')
<script>
$('.btn-delete').on('click', function() {
    var id = $(this).data('id');
    $('#form-delete').attr('action', '/delete-news/' + id);
    $('#modal-delete').modal('show');
});

$('.btn-reason').on('click', function() {
    var id = $(this).data('id');
    var reason = $(this).data('reason');
    $('#reason-show').text(reason);
    $('#modal-reason').modal('show');
});
</script>
@endsection
