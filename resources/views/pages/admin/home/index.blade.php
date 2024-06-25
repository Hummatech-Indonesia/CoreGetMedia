@extends('layouts.admin.app')
@section('style')
<style>
    .border-primary {
        border-bottom: 2px solid #41739e !important
    }

    .border-danger {
        border-bottom: 2px solid #e68888 !important
    }

    .border-info {
        border-bottom: 2px solid #bacff0 !important
    }

    .border-warning {
        border-bottom: 2px solid #fce287 !important
    }

    .nav-tabs .premium {
        border: 1px solid #183249;
        color: #183249;
        border-radius: 8px;
    }

    .nav-tabs .nav-link.active {
        background-color: #183249;
        border-radius: 6px;
        color: #ffffff;
    }

    @media (max-width: 768px) {
        .img-responsive {
            height: 300;
        }
    }
</style>
<link rel="stylesheet" href="{{ 'admin/dist/libs/prismjs/themes/prism-okaidia.min.css' }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection


<head>
    <title>Admin | Dashboard</title>
</head>


@section('content')
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="card border-bottom border-primary">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h2 class="fs-7">{{ $visitors }}</h2>
                        <h5 class="fw-medium mb-0" style="color: #41739e;">Jumlah Pengunjung</h5>
                    </div>
                    <div class="ms-auto">
                        <img src="{{ asset('assets/img/user-admin.svg')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card border-bottom border-danger">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h2 class="fs-7">{{ $countAuthor }}</h2>
                        <h5 class="fw-medium mb-0" style="color: #e68888;">Jumlah Penulis</h5>
                    </div>
                    <div class="ms-auto">
                        <div class="ms-auto">
                            <img src="{{ asset('assets/img/author-admin.svg')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card border-bottom border-info">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h2 class="fs-7">{{ $countUser }}</h2>
                        <h5 class="fw-medium mb-0" style="color: #bacff0;">Jumlah Pengguna</h5>
                    </div>
                    <div class="ms-auto">
                        <img src="{{ asset('assets/img/users-admin.svg')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card border-bottom border-warning">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h2 class="fs-7">{{ $countNews }}</h2>
                        <h5 class="fw-medium mb-0" style="color: #fce287;">Jumlah Artikel</h5>
                    </div>
                    <div class="ms-auto">
                        <span style="color: #fce287;" class="display-6"><i class="ti ti-file-text"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-9 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="col-md-12 col-lg-12">
                    <h4 class="mb-5">Artikel Trending</h4>
                    <div class="row">
                        @forelse ($newsPopulars as $newsPopular)
                            <div class="col-md-12 col-lg-6 mb-3">
                                <div class="mb-2" style="max-width: 540px;">
                                    <div class="row g-2">
                                        <div class="col-md-4">
                                            @if ($newsPopular->image != null && Storage::disk('public')->exists($newsPopular->image))
                                                <img src="{{asset('storage/'. $newsPopular->image)}}" class="img-responsive" height="130px" style="width: 100%; object-fit:cover;" alt="">
                                            @else
                                                <img src="{{ asset('assets/blank-img.jpg') }}" class="img-responsive" height="130px" style="width: 100%; object-fit:cover;" alt="">
                                            @endif
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body p-2">
                                                <h5 class="card-text">
                                                    {{ Str::limit($newsPopular->name, 60, '...') }}
                                                </h5>
                                                <div class="d-flex gap-3 align-items-center ms-0 mt-5 pt-2">
                                                    <p class="card-text m-0"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 2048 2048">
                                                            <path fill="#DD1818" d="M1536 171h341v1877H0V171h341V0h171v171h853V0h171zm171 1706V683H171v1194zm0-1365V341H171v171z" />
                                                        </svg><small class="ms-1">
                                                            {{ \Carbon\Carbon::parse($newsPopular->date)->locale('id_ID')->isoFormat('dddd, D MMMM YYYY') }}
                                                        </small>
                                                    </p>
                                                    <p class="card-text"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                                            <path fill="#DD1818" d="M12 9a3 3 0 0 1 3 3a3 3 0 0 1-3 3a3 3 0 0 1-3-3a3 3 0 0 1 3-3m0-4.5c5 0 9.27 3.11 11 7.5c-1.73 4.39-6 7.5-11 7.5S2.73 16.39 1 12c1.73-4.39 6-7.5 11-7.5M3.18 12a9.821 9.821 0 0 0 17.64 0a9.821 9.821 0 0 0-17.64 0" />
                                                        </svg><small class="mt-1 ms-1">{{ $newsPopular->newsViews()->count() }}</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center mt-5">
                                <img src="{{ asset('assets/Empty-cuate.png') }}" alt="" width="200px">
                                <p>Tidak ada berita</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-5">Kategori Trending</h4>
                <div>
                    @forelse ($categoryPopulars as $categoryPopular)
                        @php
                            if ($loop->iteration == 1) {
                               $color = 'warning';
                            } elseif ($loop->iteration == 2) {
                               $color = 'success';
                            } elseif ($loop->iteration == 3) {
                               $color = 'danger';
                            } else {
                                $color = 'primary';
                            }
                        @endphp
                        <div class="fs-5 mb-4 mt-5 d-flex justify-content-between">
                            <div>{{ $categoryPopular->name }}</div>
                            <div>
                                <span class="badge bg-light-{{ $color }} text-{{ $color }}">{{ $categoryPopular->newsCategories()->count() }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="fs-5 mb-4 mt-5 text-center">
                            <div>
                                Belum ada kategori
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-5">Penulis Terbanyak</h4>
                <div>
                    @forelse ($authors as $author)
                        <div class="d-flex justify-content-between mb-3">
                            <div class="d-flex align-items-center">
                                @if ($author->image != null && Storage::disk('public')->exists($author->image))
                                    <img src="{{ asset('storage/'. $author->image)}}" class="rounded-circle mb-3 img" style="object-fit: cover" alt="Avatar" width="40px" height="40px" />
                                @else
                                    <img src="{{ asset('default.png') }}" class="rounded-circle mb-3 img" style="object-fit: cover" alt="Avatar" width="40px" height="40px">
                                @endif
                                <div class="ms-3">
                                    <p class="fs-4 fw-semibold fs-2 student-name">{{ $author->name }}</p>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <span class="badge bg-light-danger text-danger">{{ $author->newses()->count() }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h4>Statistik Banyak Berita</h4>
                        <div id="chart-writer">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="">
    <ul class="nav nav-tabs gap-2 mb-4 d-flex justify-content-between" role="tablist">
        <div class="d-flex gap-2">
            <li class="nav-item premium ">
                <a class="nav-link active px-4 btn btn-md" data-bs-toggle="tab" href="#premium-news" role="tab">
                    <span>Berita Premium</span>
                </a>
            </li>
            <li class="nav-item premium">
                <a class="nav-link px-4" data-bs-toggle="tab" href="#advertisement" role="tab">
                    <span>Pengiklanan</span>
                </a>
            </li>
        </div>
        <div class="">
            <li>
                <form>
                    <div class="d-flex justify-content-end gap-2">
                        <div class="gap-2">
                            <select class="form-select" name="opsi" style="width: 200px">
                                <option value="">Keseluruhan</option>
                                <option value="terbaru">2020 - 2021</option>
                                <option value="terlama">2021 - 2022 </option>
                                <option value="terlama">2022 - 2023</option>
                            </select>
                        </div>
                        <button class="btn btn-primary" type="submit">
                            Pilih
                        </button>
                    </div>
                </form>
            </li>
        </div>
    </ul>
    <div class="card shadow-none position-relative overflow-hidden mb-4" style="background-color: #183249">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9 d-flex align-items-center">
                    <div class="ms-1 px-3">
                        <h3 class="mb-8  text-white" style="font-weight: 400;">Pendapatan Keseluruhan</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <h3 class=" text-warning text-decoration-none ">Rp. 1.500.000</h3>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-3">
                    <div class="text-center mb-n2">
                        <img src="{{ asset('assets/img/end.png') }}" width="70%" alt="" class="img-fluid mb-n4">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane active" id="premium-news" role="tabpanel">
            <div class="row">
                <div class="col-md-12 col-lg-9">
                    <div class="card card-body">
                        <h4><b>Data Berita Premium</b></h4>
                        <div class="mt-4">
                            <ul class="nav nav-tabs" role="tablist" style="background-color: #CCCCCC;">
                                <li class="nav-item">
                                    <a class="nav-link active px-4" data-bs-toggle="tab" href="#news" role="tab">
                                        <span>Berita</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-4" data-bs-toggle="tab" href="#statistik" role="tab">
                                        <span>Statistik</span>
                                    </a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="news" role="tabpanel">
                                    <div class="d-flex justify-content-between mt-5 mb-5">
                                        <h4>Berita</h4>
                                        <form>
                                            <div class="d-flex gap-2">
                                                <div class="d-flex gap-2">
                                                    <select class="form-select" name="opsi" style="width: 200px">
                                                        <option value="">Tampilkan semua</option>
                                                        <option value="terbaru">Terbaru</option>
                                                        <option value="terlama">Terlama</option>
                                                    </select>
                                                </div>
                                                <button class="btn btn-primary" type="submit">
                                                    Pilih
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-12 col-lg-6 mb-3">
                                            <div class="mb-2" style="max-width: 540px;">
                                                <div class="row g-2">

                                                    <div class="col-md-4">
                                                        <img src="{{ asset('assets/img/news/news-10.webp') }}" class="img-responsive" height="100" style="width: 100%; object-fit:cover;" alt="">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body p-2">
                                                            <h5 class="card-text">
                                                                Lorem ipsum dolor sit amet consectetur adipisicing elit...
                                                            </h5>
                                                            <div class="d-flex gap-3 align-items-center ms-0 mt-4">
                                                                <p class="card-text m-0">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 2048 2048">
                                                                        <path fill="#DD1818" d="M1536 171h341v1877H0V171h341V0h171v171h853V0h171zm171 1706V683H171v1194zm0-1365V341H171v171z" />
                                                                    </svg>
                                                                    <small class="ms-1">7 Juni 2024</small>
                                                                </p>
                                                                <p class="card-text">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                                                        <path fill="#DD1818" d="M12 9a3 3 0 0 1 3 3a3 3 0 0 1-3 3a3 3 0 0 1-3-3a3 3 0 0 1 3-3m0-4.5c5 0 9.27 3.11 11 7.5c-1.73 4.39-6 7.5-11 7.5S2.73 16.39 1 12c1.73-4.39 6-7.5 11-7.5M3.18 12a9.821 9.821 0 0 0 17.64 0a9.821 9.821 0 0 0-17.64 0" />
                                                                    </svg>
                                                                    <small class="mt-1 ms-1">102x dilihat</small>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane p-3" id="statistik" role="tabpanel">
                                    <h3>Statistika</h3>
                                    <div id="chart-news-premium">
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="col-md-12 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h4>Pendapatan</h4>
                            <p>Tahun 2022-2023</p>

                            <div class="" id="current-year"></div>

                            <div class="mt-4 d-flex justify-content-between">
                                <div class="">
                                    <h4 style="color: #5D87FF;">Berita Premium</h4>
                                    <b>Rp. 1.450.000</b>
                                </div>
                                <div class="">
                                    <a href="" class="btn btn-sm" style="background-color: #5D87FF">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24">
                                            <path fill="#ffffff" d="M12 12.5a3.5 3.5 0 1 0 0 7a3.5 3.5 0 0 0 0-7M10.5 16a1.5 1.5 0 1 1 3 0a1.5 1.5 0 0 1-3 0" />
                                            <path fill="#ffffff" d="M17.526 5.116L14.347.659L2.658 9.997L2.01 9.99V10H1.5v12h21V10h-.962l-1.914-5.599zM19.425 10H9.397l7.469-2.546l1.522-.487zM15.55 5.79L7.84 8.418l6.106-4.878zM3.5 18.169v-4.34A3.008 3.008 0 0 0 5.33 12h13.34a3.009 3.009 0 0 0 1.83 1.83v4.34A3.009 3.009 0 0 0 18.67 20H5.332A3.01 3.01 0 0 0 3.5 18.169" />
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <div class="mt-4 d-flex justify-content-between">
                                <div class="">
                                    <h4 style="color: #49BEFF;">Pengiklanan</h4>
                                    <b>Rp. 1.450.000</b>
                                </div>
                                <div class="">
                                    <a href="" class="btn btn-sm" style="background-color: #49BEFF">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24">
                                            <path fill="#ffffff" d="M12 12.5a3.5 3.5 0 1 0 0 7a3.5 3.5 0 0 0 0-7M10.5 16a1.5 1.5 0 1 1 3 0a1.5 1.5 0 0 1-3 0" />
                                            <path fill="#ffffff" d="M17.526 5.116L14.347.659L2.658 9.997L2.01 9.99V10H1.5v12h21V10h-.962l-1.914-5.599zM19.425 10H9.397l7.469-2.546l1.522-.487zM15.55 5.79L7.84 8.418l6.106-4.878zM3.5 18.169v-4.34A3.008 3.008 0 0 0 5.33 12h13.34a3.009 3.009 0 0 0 1.83 1.83v4.34A3.009 3.009 0 0 0 18.67 20H5.332A3.01 3.01 0 0 0 3.5 18.169" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            <img src="{{asset('assets/img/piggy.svg')}}" width="180" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="advertisement" role="tabpanel">
            <div class="row">
                <div class="col-md-12 col-lg-9">
                    <div class="card card-body">
                        <h4><b>Data Pengiklanan</b></h4>
                        <div class="mt-4">
                            <ul class="nav nav-tabs" role="tablist" style="background-color: #CCCCCC;">
                                <li class="nav-item">
                                    <a class="nav-link active px-4" data-bs-toggle="tab" href="#advertisement-tab" role="tab">
                                        <span>Iklan</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-4" data-bs-toggle="tab" href="#statistik-advertisement" role="tab">
                                        <span>Statistik</span>
                                    </a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="advertisement-tab" role="tabpanel">
                                    <div class="mt-4">
                                        <div class="d-flex gap-2">
                                            <select class="form-select" id="opsi-latest" style="width: 200px">
                                                <option value="">Tampilkan semua</option>
                                                <option value="terbaru">Terbaru</option>
                                                <option value="terlama">Terlama</option>
                                            </select>

                                            <select class="form-select" id="opsi-latest" style="width: 200px">
                                                <option value="gambar">Gambar</option>
                                                <option value="video">Video</option>
                                            </select>
                                        </div>
                                    </div>
                                    <h4 class="mb-5 mt-5">Berita Premium</h4>
                                    <div class="table-responsive rounded-2 mt-4">
                                        <table class="table border text-nowrap customize-table mb-0 align-middle ">
                                            <thead>
                                                <tr>
                                                    <th style="background-color: #D9D9D9;">Jenis Iklan</th>
                                                    <th style="background-color: #D9D9D9;">Tanggal Awal</th>
                                                    <th style="background-color: #D9D9D9;">Tanggal Akhir</th>
                                                    <th style="background-color: #D9D9D9;">Halaman</th>
                                                    <th style="background-color: #D9D9D9;">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Gambar</td>
                                                    <td>01/12/2022</td>
                                                    <td>01/12/2022</td>
                                                    <td>Beranda</td>
                                                    <td>
                                                        <span class="mb-1 badge font-medium bg-light-primary text-primary">Aktif</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>


                                    </div>

                                </div>
                                <div class="tab-pane p-3" id="statistik-advertisement" role="tabpanel">
                                    <h3>Statistika</h3>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="col-md-12 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h4>Pendapatan</h4>
                            <p>Tahun 2022-2023</p>
                            <div class="" id="chart-advertisement-premium"></div>

                            <div class="mt-4 d-flex justify-content-between">
                                <div class="">
                                    <h4 style="color: #5D87FF;">Berita Premium</h4>
                                    <b>Rp. 1.450.000</b>
                                </div>
                                <div class="">
                                    <a href="" class="btn btn-sm" style="background-color: #5D87FF">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24">
                                            <path fill="#ffffff" d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5M12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5s5 2.24 5 5s-2.24 5-5 5m0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3s3-1.34 3-3s-1.34-3-3-3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <div class="mt-4 d-flex justify-content-between">
                                <div class="">
                                    <h4 style="color: #49BEFF;">Berita Premium</h4>
                                    <b>Rp. 1.450.000</b>
                                </div>
                                <div class="">
                                    <a href="" class="btn btn-sm" style="background-color: #49BEFF">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24">
                                            <path fill="#ffffff" d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5M12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5s5 2.24 5 5s-2.24 5-5 5m0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3s3-1.34 3-3s-1.34-3-3-3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            <img src="{{asset('assets/img/piggy.svg')}}" width="180" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4>Statistik Pertambahan Jumlah Pengunjung</h4>
                <div class="" id="chart-pengunjung"></div>
                <div class="" id="name"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <h3 class="mb-3">Fitur Berlangganan</h3>
    <div class="col-lg-4 col-md-6 col-sm-12 card-hover">
        <div class="card">
            <div class="card-header text-center">
                <h4>Lorem Ipsum dolor</h4>
            </div>
            <div class="d-flex justify-content-center">
                <img src="{{ asset('assets/img/premium/premium1.svg') }}" width="50%" height="200" style="object-fit:cover" class="mb-4" alt="...">
            </div>
            <div class="d-flex align-items-center">
                <div class="ms-auto">
                    <div class="d-flex justify-content-end">

                    </div>
                </div>
            </div>
            <div class="ms-4 d-flex justify-content-center mb-3 mt-2">
                <h2 class="card-text text-info">Rp 170.000</h2>
                <h5 class="mb-0 mt-2 text-info">/bulan</h5>
            </div>
            <div class="px-4">
                <div class="row">

                    <div class="col-lg-12 mb-3" style="display: flex; align-items: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 36 35" fill="none" style="flex-shrink: 0; margin-right: 10px;">
                            <path d="M18 3.28125C9.93586 3.28125 3.375 9.65986 3.375 17.5C3.375 25.3401 9.93586 31.7188 18 31.7188C26.0641 31.7188 32.625 25.3401 32.625 17.5C32.625 9.65986 26.0641 3.28125 18 3.28125ZM25.6113 12.7347L16.1613 23.6722C16.0577 23.7922 15.9287 23.8892 15.7831 23.9565C15.6375 24.0239 15.4788 24.06 15.3176 24.0625H15.2986C15.1409 24.0624 14.985 24.0302 14.841 23.9677C14.6969 23.9053 14.568 23.8142 14.4626 23.7002L10.4126 19.3252C10.3097 19.2191 10.2297 19.0942 10.1772 18.9576C10.1248 18.821 10.1009 18.6757 10.1071 18.53C10.1132 18.3844 10.1493 18.2414 10.2131 18.1095C10.2769 17.9776 10.3671 17.8594 10.4786 17.7619C10.59 17.6644 10.7204 17.5895 10.862 17.5417C11.0037 17.4938 11.1537 17.474 11.3033 17.4834C11.453 17.4927 11.5992 17.5311 11.7333 17.5962C11.8675 17.6612 11.9869 17.7517 12.0846 17.8623L15.2691 21.3021L23.8887 11.3278C24.082 11.1105 24.3556 10.9759 24.6502 10.9531C24.9448 10.9302 25.2368 11.021 25.4631 11.2059C25.6894 11.3907 25.8319 11.6547 25.8596 11.9407C25.8873 12.2268 25.7981 12.512 25.6113 12.7347Z" fill="#13DEB9"></path>
                        </svg>
                        <p class="fs-3 fw-semibold" style="margin: 0; flex-grow: 1;">Daftar Hadir Tamu</p>
                    </div>
                    <div class="col-lg-12 mb-3" style="display: flex; align-items: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 36 35" fill="none" style="flex-shrink: 0; margin-right: 10px;">
                            <path d="M18 3.28125C9.93586 3.28125 3.375 9.65986 3.375 17.5C3.375 25.3401 9.93586 31.7188 18 31.7188C26.0641 31.7188 32.625 25.3401 32.625 17.5C32.625 9.65986 26.0641 3.28125 18 3.28125ZM25.6113 12.7347L16.1613 23.6722C16.0577 23.7922 15.9287 23.8892 15.7831 23.9565C15.6375 24.0239 15.4788 24.06 15.3176 24.0625H15.2986C15.1409 24.0624 14.985 24.0302 14.841 23.9677C14.6969 23.9053 14.568 23.8142 14.4626 23.7002L10.4126 19.3252C10.3097 19.2191 10.2297 19.0942 10.1772 18.9576C10.1248 18.821 10.1009 18.6757 10.1071 18.53C10.1132 18.3844 10.1493 18.2414 10.2131 18.1095C10.2769 17.9776 10.3671 17.8594 10.4786 17.7619C10.59 17.6644 10.7204 17.5895 10.862 17.5417C11.0037 17.4938 11.1537 17.474 11.3033 17.4834C11.453 17.4927 11.5992 17.5311 11.7333 17.5962C11.8675 17.6612 11.9869 17.7517 12.0846 17.8623L15.2691 21.3021L23.8887 11.3278C24.082 11.1105 24.3556 10.9759 24.6502 10.9531C24.9448 10.9302 25.2368 11.021 25.4631 11.2059C25.6894 11.3907 25.8319 11.6547 25.8596 11.9407C25.8873 12.2268 25.7981 12.512 25.6113 12.7347Z" fill="#13DEB9"></path>
                        </svg>
                        <p class="fs-3 fw-semibold" style="margin: 0; flex-grow: 1;">Daftar Hadir Tamu</p>
                    </div>
                    <div class="col-lg-12 mb-3" style="display: flex; align-items: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 36 35" fill="none" style="flex-shrink: 0; margin-right: 10px;">
                            <path d="M18 3.28125C9.93586 3.28125 3.375 9.65986 3.375 17.5C3.375 25.3401 9.93586 31.7188 18 31.7188C26.0641 31.7188 32.625 25.3401 32.625 17.5C32.625 9.65986 26.0641 3.28125 18 3.28125ZM25.6113 12.7347L16.1613 23.6722C16.0577 23.7922 15.9287 23.8892 15.7831 23.9565C15.6375 24.0239 15.4788 24.06 15.3176 24.0625H15.2986C15.1409 24.0624 14.985 24.0302 14.841 23.9677C14.6969 23.9053 14.568 23.8142 14.4626 23.7002L10.4126 19.3252C10.3097 19.2191 10.2297 19.0942 10.1772 18.9576C10.1248 18.821 10.1009 18.6757 10.1071 18.53C10.1132 18.3844 10.1493 18.2414 10.2131 18.1095C10.2769 17.9776 10.3671 17.8594 10.4786 17.7619C10.59 17.6644 10.7204 17.5895 10.862 17.5417C11.0037 17.4938 11.1537 17.474 11.3033 17.4834C11.453 17.4927 11.5992 17.5311 11.7333 17.5962C11.8675 17.6612 11.9869 17.7517 12.0846 17.8623L15.2691 21.3021L23.8887 11.3278C24.082 11.1105 24.3556 10.9759 24.6502 10.9531C24.9448 10.9302 25.2368 11.021 25.4631 11.2059C25.6894 11.3907 25.8319 11.6547 25.8596 11.9407C25.8873 12.2268 25.7981 12.512 25.6113 12.7347Z" fill="#13DEB9"></path>
                        </svg>
                        <p class="fs-3 fw-semibold" style="margin: 0; flex-grow: 1;">Daftar Hadir Tamu</p>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 card-hover">
        <div class="card">
            <div class="card-header text-center">
                <h4>Lorem Ipsum dolor</h4>
            </div>
            <div class="d-flex justify-content-center">
                <img src="{{ asset('assets/img/premium/premium2.svg') }}" width="50%" height="200" style="object-fit:cover" class="mb-4" alt="...">
            </div>
            <div class="d-flex align-items-center">
                <div class="ms-auto">
                    <div class="d-flex justify-content-end">

                    </div>
                </div>
            </div>
            <div class="ms-4 d-flex justify-content-center mb-3 mt-2">
                <h2 class="card-text text-info">Rp 170.000</h2>
                <h5 class="mb-0 mt-2 text-info">/bulan</h5>
            </div>
            <div class="px-4">
                <div class="row">

                    <div class="col-lg-12 mb-3" style="display: flex; align-items: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 36 35" fill="none" style="flex-shrink: 0; margin-right: 10px;">
                            <path d="M18 3.28125C9.93586 3.28125 3.375 9.65986 3.375 17.5C3.375 25.3401 9.93586 31.7188 18 31.7188C26.0641 31.7188 32.625 25.3401 32.625 17.5C32.625 9.65986 26.0641 3.28125 18 3.28125ZM25.6113 12.7347L16.1613 23.6722C16.0577 23.7922 15.9287 23.8892 15.7831 23.9565C15.6375 24.0239 15.4788 24.06 15.3176 24.0625H15.2986C15.1409 24.0624 14.985 24.0302 14.841 23.9677C14.6969 23.9053 14.568 23.8142 14.4626 23.7002L10.4126 19.3252C10.3097 19.2191 10.2297 19.0942 10.1772 18.9576C10.1248 18.821 10.1009 18.6757 10.1071 18.53C10.1132 18.3844 10.1493 18.2414 10.2131 18.1095C10.2769 17.9776 10.3671 17.8594 10.4786 17.7619C10.59 17.6644 10.7204 17.5895 10.862 17.5417C11.0037 17.4938 11.1537 17.474 11.3033 17.4834C11.453 17.4927 11.5992 17.5311 11.7333 17.5962C11.8675 17.6612 11.9869 17.7517 12.0846 17.8623L15.2691 21.3021L23.8887 11.3278C24.082 11.1105 24.3556 10.9759 24.6502 10.9531C24.9448 10.9302 25.2368 11.021 25.4631 11.2059C25.6894 11.3907 25.8319 11.6547 25.8596 11.9407C25.8873 12.2268 25.7981 12.512 25.6113 12.7347Z" fill="#13DEB9"></path>
                        </svg>
                        <p class="fs-3 fw-semibold" style="margin: 0; flex-grow: 1;">Daftar Hadir Tamu</p>
                    </div>
                    <div class="col-lg-12 mb-3" style="display: flex; align-items: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 36 35" fill="none" style="flex-shrink: 0; margin-right: 10px;">
                            <path d="M18 3.28125C9.93586 3.28125 3.375 9.65986 3.375 17.5C3.375 25.3401 9.93586 31.7188 18 31.7188C26.0641 31.7188 32.625 25.3401 32.625 17.5C32.625 9.65986 26.0641 3.28125 18 3.28125ZM25.6113 12.7347L16.1613 23.6722C16.0577 23.7922 15.9287 23.8892 15.7831 23.9565C15.6375 24.0239 15.4788 24.06 15.3176 24.0625H15.2986C15.1409 24.0624 14.985 24.0302 14.841 23.9677C14.6969 23.9053 14.568 23.8142 14.4626 23.7002L10.4126 19.3252C10.3097 19.2191 10.2297 19.0942 10.1772 18.9576C10.1248 18.821 10.1009 18.6757 10.1071 18.53C10.1132 18.3844 10.1493 18.2414 10.2131 18.1095C10.2769 17.9776 10.3671 17.8594 10.4786 17.7619C10.59 17.6644 10.7204 17.5895 10.862 17.5417C11.0037 17.4938 11.1537 17.474 11.3033 17.4834C11.453 17.4927 11.5992 17.5311 11.7333 17.5962C11.8675 17.6612 11.9869 17.7517 12.0846 17.8623L15.2691 21.3021L23.8887 11.3278C24.082 11.1105 24.3556 10.9759 24.6502 10.9531C24.9448 10.9302 25.2368 11.021 25.4631 11.2059C25.6894 11.3907 25.8319 11.6547 25.8596 11.9407C25.8873 12.2268 25.7981 12.512 25.6113 12.7347Z" fill="#13DEB9"></path>
                        </svg>
                        <p class="fs-3 fw-semibold" style="margin: 0; flex-grow: 1;">Daftar Hadir Tamu</p>
                    </div>
                    <div class="col-lg-12 mb-3" style="display: flex; align-items: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 36 35" fill="none" style="flex-shrink: 0; margin-right: 10px;">
                            <path d="M18 3.28125C9.93586 3.28125 3.375 9.65986 3.375 17.5C3.375 25.3401 9.93586 31.7188 18 31.7188C26.0641 31.7188 32.625 25.3401 32.625 17.5C32.625 9.65986 26.0641 3.28125 18 3.28125ZM25.6113 12.7347L16.1613 23.6722C16.0577 23.7922 15.9287 23.8892 15.7831 23.9565C15.6375 24.0239 15.4788 24.06 15.3176 24.0625H15.2986C15.1409 24.0624 14.985 24.0302 14.841 23.9677C14.6969 23.9053 14.568 23.8142 14.4626 23.7002L10.4126 19.3252C10.3097 19.2191 10.2297 19.0942 10.1772 18.9576C10.1248 18.821 10.1009 18.6757 10.1071 18.53C10.1132 18.3844 10.1493 18.2414 10.2131 18.1095C10.2769 17.9776 10.3671 17.8594 10.4786 17.7619C10.59 17.6644 10.7204 17.5895 10.862 17.5417C11.0037 17.4938 11.1537 17.474 11.3033 17.4834C11.453 17.4927 11.5992 17.5311 11.7333 17.5962C11.8675 17.6612 11.9869 17.7517 12.0846 17.8623L15.2691 21.3021L23.8887 11.3278C24.082 11.1105 24.3556 10.9759 24.6502 10.9531C24.9448 10.9302 25.2368 11.021 25.4631 11.2059C25.6894 11.3907 25.8319 11.6547 25.8596 11.9407C25.8873 12.2268 25.7981 12.512 25.6113 12.7347Z" fill="#13DEB9"></path>
                        </svg>
                        <p class="fs-3 fw-semibold" style="margin: 0; flex-grow: 1;">Daftar Hadir Tamu</p>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 card-hover">
        <div class="card">
            <div class="card-header text-center">
                <h4>Lorem Ipsum dolor</h4>
            </div>
            <div class="d-flex justify-content-center">
                <img src="{{ asset('assets/img/premium/premium3.svg') }}" width="50%" height="200" style="object-fit:cover" class="mb-4" alt="...">
            </div>
            <div class="d-flex align-items-center">
                <div class="ms-auto">
                    <div class="d-flex justify-content-end">

                    </div>
                </div>
            </div>
            <div class="ms-4 d-flex justify-content-center mb-3 mt-2">
                <h2 class="card-text text-info">Rp 170.000</h2>
                <h5 class="mb-0 mt-2 text-info">/bulan</h5>
            </div>
            <div class="px-4">
                <div class="row">

                    <div class="col-lg-12 mb-3" style="display: flex; align-items: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 36 35" fill="none" style="flex-shrink: 0; margin-right: 10px;">
                            <path d="M18 3.28125C9.93586 3.28125 3.375 9.65986 3.375 17.5C3.375 25.3401 9.93586 31.7188 18 31.7188C26.0641 31.7188 32.625 25.3401 32.625 17.5C32.625 9.65986 26.0641 3.28125 18 3.28125ZM25.6113 12.7347L16.1613 23.6722C16.0577 23.7922 15.9287 23.8892 15.7831 23.9565C15.6375 24.0239 15.4788 24.06 15.3176 24.0625H15.2986C15.1409 24.0624 14.985 24.0302 14.841 23.9677C14.6969 23.9053 14.568 23.8142 14.4626 23.7002L10.4126 19.3252C10.3097 19.2191 10.2297 19.0942 10.1772 18.9576C10.1248 18.821 10.1009 18.6757 10.1071 18.53C10.1132 18.3844 10.1493 18.2414 10.2131 18.1095C10.2769 17.9776 10.3671 17.8594 10.4786 17.7619C10.59 17.6644 10.7204 17.5895 10.862 17.5417C11.0037 17.4938 11.1537 17.474 11.3033 17.4834C11.453 17.4927 11.5992 17.5311 11.7333 17.5962C11.8675 17.6612 11.9869 17.7517 12.0846 17.8623L15.2691 21.3021L23.8887 11.3278C24.082 11.1105 24.3556 10.9759 24.6502 10.9531C24.9448 10.9302 25.2368 11.021 25.4631 11.2059C25.6894 11.3907 25.8319 11.6547 25.8596 11.9407C25.8873 12.2268 25.7981 12.512 25.6113 12.7347Z" fill="#13DEB9"></path>
                        </svg>
                        <p class="fs-3 fw-semibold" style="margin: 0; flex-grow: 1;">Daftar Hadir Tamu</p>
                    </div>
                    <div class="col-lg-12 mb-3" style="display: flex; align-items: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 36 35" fill="none" style="flex-shrink: 0; margin-right: 10px;">
                            <path d="M18 3.28125C9.93586 3.28125 3.375 9.65986 3.375 17.5C3.375 25.3401 9.93586 31.7188 18 31.7188C26.0641 31.7188 32.625 25.3401 32.625 17.5C32.625 9.65986 26.0641 3.28125 18 3.28125ZM25.6113 12.7347L16.1613 23.6722C16.0577 23.7922 15.9287 23.8892 15.7831 23.9565C15.6375 24.0239 15.4788 24.06 15.3176 24.0625H15.2986C15.1409 24.0624 14.985 24.0302 14.841 23.9677C14.6969 23.9053 14.568 23.8142 14.4626 23.7002L10.4126 19.3252C10.3097 19.2191 10.2297 19.0942 10.1772 18.9576C10.1248 18.821 10.1009 18.6757 10.1071 18.53C10.1132 18.3844 10.1493 18.2414 10.2131 18.1095C10.2769 17.9776 10.3671 17.8594 10.4786 17.7619C10.59 17.6644 10.7204 17.5895 10.862 17.5417C11.0037 17.4938 11.1537 17.474 11.3033 17.4834C11.453 17.4927 11.5992 17.5311 11.7333 17.5962C11.8675 17.6612 11.9869 17.7517 12.0846 17.8623L15.2691 21.3021L23.8887 11.3278C24.082 11.1105 24.3556 10.9759 24.6502 10.9531C24.9448 10.9302 25.2368 11.021 25.4631 11.2059C25.6894 11.3907 25.8319 11.6547 25.8596 11.9407C25.8873 12.2268 25.7981 12.512 25.6113 12.7347Z" fill="#13DEB9"></path>
                        </svg>
                        <p class="fs-3 fw-semibold" style="margin: 0; flex-grow: 1;">Daftar Hadir Tamu</p>
                    </div>
                    <div class="col-lg-12 mb-3" style="display: flex; align-items: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 36 35" fill="none" style="flex-shrink: 0; margin-right: 10px;">
                            <path d="M18 3.28125C9.93586 3.28125 3.375 9.65986 3.375 17.5C3.375 25.3401 9.93586 31.7188 18 31.7188C26.0641 31.7188 32.625 25.3401 32.625 17.5C32.625 9.65986 26.0641 3.28125 18 3.28125ZM25.6113 12.7347L16.1613 23.6722C16.0577 23.7922 15.9287 23.8892 15.7831 23.9565C15.6375 24.0239 15.4788 24.06 15.3176 24.0625H15.2986C15.1409 24.0624 14.985 24.0302 14.841 23.9677C14.6969 23.9053 14.568 23.8142 14.4626 23.7002L10.4126 19.3252C10.3097 19.2191 10.2297 19.0942 10.1772 18.9576C10.1248 18.821 10.1009 18.6757 10.1071 18.53C10.1132 18.3844 10.1493 18.2414 10.2131 18.1095C10.2769 17.9776 10.3671 17.8594 10.4786 17.7619C10.59 17.6644 10.7204 17.5895 10.862 17.5417C11.0037 17.4938 11.1537 17.474 11.3033 17.4834C11.453 17.4927 11.5992 17.5311 11.7333 17.5962C11.8675 17.6612 11.9869 17.7517 12.0846 17.8623L15.2691 21.3021L23.8887 11.3278C24.082 11.1105 24.3556 10.9759 24.6502 10.9531C24.9448 10.9302 25.2368 11.021 25.4631 11.2059C25.6894 11.3907 25.8319 11.6547 25.8596 11.9407C25.8873 12.2268 25.7981 12.512 25.6113 12.7347Z" fill="#13DEB9"></path>
                        </svg>
                        <p class="fs-3 fw-semibold" style="margin: 0; flex-grow: 1;">Daftar Hadir Tamu</p>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('admin/dist/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
<script src="{{asset('admin/dist/js/apps/notes.js')}}"></script>
<script src="{{asset('admin/dist/js/apps/chat.js')}}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var chartData = @json($newsChart);

        var categories = chartData.map(item => item.month);
        var data = chartData.map(item => item.news);

        var options = {
            series: [{
                name: "News",
                data: data
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], 
                    opacity: 0.5
                }
            },
            xaxis: {
                categories: categories,
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart-writer"), options);
        chart.render();
    });

    var options = {
          series: [{
            name: "Desktops",
            data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
        }],
          chart: {
          height: 350,
          type: 'line',
          zoom: {
            enabled: false
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'straight'
        },
        title: {
          text: 'Product Trends by Month',
          align: 'left'
        },
        grid: {
          row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
          },
        },
        xaxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', "Nov", 'Des'],
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart-pengunjung"), options);
    chart.render();


    var options = {
        series: [80, 40, 31],
        chart: {
            type: 'donut',
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                },
            }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#chart-premium"), options);
    chart.render();
</script>

<script>

       
var options = {
          series: [{
            name: "Desktops",
            data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
        }],
          chart: {
          height: 350,
          type: 'line',
          zoom: {
            enabled: false
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'straight'
        },
        title: {
          text: 'Product Trends by Month',
          align: 'left'
        },
        grid: {
          row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
          },
        },
        xaxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
        }
        };

    var chart = new ApexCharts(document.querySelector("#chart-news-premium"), options);
    chart.render();



    var options = {
        color: "#adb5bd",
        series: [80, 55],
        labels: ["Income", "Expance"],
        chart: {
            type: "donut",
            fontFamily: "Plus Jakarta Sans', sans-serif",
            foreColor: "#adb0bb",
        },
        plotOptions: {
            pie: {
                donut: {
                    size: '70%',
                    background: 'transparent',
                    labels: {
                        show: true,
                        name: {
                            show: true,
                            offsetY: 7,
                        },
                        value: {
                            show: false,
                        },
                        total: {
                            show: true,
                            color: '#5A6A85',
                            fontSize: '20px',
                            fontWeight: "600",
                            label: '',
                        },
                    },
                },
            },
        },

        dataLabels: {
            enabled: false,
        },
        stroke: {
            show: false,
        },
        legend: {
            show: false,
        },
        colors: ["var(--bs-primary)", "var(--bs-secondary)"],

        tooltip: {
            theme: "dark",
            fillSeriesColor: false,
        },
    };

    var chart = new ApexCharts(document.querySelector("#current-year"), options);
    chart.render();

    var options = {
        color: "#adb5bd",
        series: [80, 55],
        labels: ["Income", "Expance"],
        chart: {
            type: "donut",
            fontFamily: "Plus Jakarta Sans', sans-serif",
            foreColor: "#adb0bb",
        },
        plotOptions: {
            pie: {
                donut: {
                    size: '70%',
                    background: 'transparent',
                    labels: {
                        show: true,
                        name: {
                            show: true,
                            offsetY: 7,
                        },
                        value: {
                            show: false,
                        },
                        total: {
                            show: true,
                            color: '#5A6A85',
                            fontSize: '20px',
                            fontWeight: "600",
                            label: '',
                        },
                    },
                },
            },
        },

        dataLabels: {
            enabled: false,
        },
        stroke: {
            show: false,
        },
        legend: {
            show: false,
        },
        colors: ["var(--bs-primary)", "var(--bs-secondary)"],

        tooltip: {
            theme: "dark",
            fillSeriesColor: false,
        },
    };

    var chart = new ApexCharts(document.querySelector("#chart-advertisement-premium"), options);
    chart.render();
</script>

@endsection
