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
                <form action="{{ route('create.package.admin') }}" method="POST">
                    @method('post')
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="form-label mt-2">Nama Paket</label>
                                <input class="form-control" type="text" name="name">
                                <ul class="error-text"></ul>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label mt-2">Deskripsi Paket</label>
                                <input class="form-control" type="text" name="description">
                                <ul class="error-text"></ul>
                            </div>
                            <div class="col-lg-12" id="stok-wrapper">
                                <label class="form-label mt-2">Harga Paket</label>
                                <input class="form-control" type="text" name="price">
                                <ul class="error-text"></ul>
                            </div>
                            <label class="form-label">Nama Fitur</label>
                            <div class="email-repeater mb-3">
                                <div data-repeater-list="name_feature">
                                    <div data-repeater-item class="row mb-3">
                                        <div class="col-md-10">
                                            <input type="text" name="name_feature" class="form-control"
                                                placeholder="Nama Fitur" />
                                        </div>
                                        <div class="col-md-2">
                                            <button data-repeater-delete="" class="btn btn-danger waves-effect waves-light"
                                                type="button">
                                                <i class="ti ti-circle-x fs-5"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" data-repeater-create=""
                                    class="btn btn-info waves-effect waves-light">
                                    <div class="d-flex align-items-center">
                                        Tambah Fitur
                                        <i class="ti ti-circle-plus ms-1 fs-5"></i>
                                    </div>
                                </button>
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

    <div class="modal fade" id="modal-update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Paket Berlangganan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-update" method="POST">
                    @method('put')
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="form-label mt-2">Nama Paket</label>
                                <input class="form-control" id="name-update" type="text" name="name">
                                <ul class="error-text"></ul>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label mt-2">Deskripsi Paket</label>
                                <input class="form-control" id="description-update" type="text" name="description">
                                <ul class="error-text"></ul>
                            </div>
                            <div class="col-lg-12" id="stok-wrapper">
                                <label class="form-label mt-2">Harga Paket</label>
                                <input class="form-control" id="price-update" type="text" name="price">
                                <ul class="error-text"></ul>
                            </div>
                            <label class="form-label">Nama Fitur</label>
                            <div class="email-repeater mb-3">
                                <div data-repeater-list="name_feature">
                                    @foreach ($fiture as $fitur)
                                        <div data-repeater-item class="row mb-3">
                                            <div class="col-md-10">
                                                <input type="text" value="{{ $fitur->name_feature }}"
                                                    name="name_feature" class="form-control" placeholder="Nama Fitur" />
                                            </div>
                                            <div class="col-md-2">
                                                <button data-repeater-delete=""
                                                    class="btn btn-danger waves-effect waves-light" type="button">
                                                    <i class="ti ti-circle-x fs-5"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" data-repeater-create=""
                                    class="btn btn-info waves-effect waves-light">
                                    <div class="d-flex align-items-center">
                                        Tambah Fitur
                                        <i class="ti ti-circle-plus ms-1 fs-5"></i>
                                    </div>
                                </button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-rounded btn-light-danger text-danger"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-rounded btn-light-success text-success">Update</button>
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
                        <img src="{{ asset('assets/img/bg-ajuan.svg') }}" width="250px" alt=""
                            class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-1">
        <div class="p-2">

            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" data-bs-toggle="tab" href="#navpill-paket" role="tab"
                        aria-selected="true">
                        <span>Paket</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#navpill-statistik" role="tab"
                        aria-selected="false">
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
                            data-bs-toggle="tab" href="#active" role="tab" aria-controls="active"
                            aria-expanded="true">
                            <span>Semua</span>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
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
                </li> --}}
                </ul>
                <div class="d-flex ml-auto">
                    <button class="btn btn-create text-white" style="background-color: #175A95;" data-bs-toggle="modal"
                        data-bs-target="#modal-create">
                        Tambah Paket
                    </button>
                </div>
            </div>

            <div class="tab-content tabcontent-border p-3" id="myTabContent">
                <div role="tabpanel" class="tab-pane fade show active" id="active" aria-labelledby="active-tab">
                    <div class="row mx-">
                        @forelse ($packages as $package)
                            <div class="col-md-4 mb-3">
                                <div class="card ms-2 me-2"
                                    style="background-image: url({{ asset('assets/img/frame-subscribe.png') }}); background-size: cover; background-position: center;">
                                    <div class="card-body mx-4">
                                        <div class="d-flex justify-content-between mt-3 mb-4">
                                            <span class="badge bg-light-primary fw-semibold"
                                                style="color: #175A95; font-size: 25px;">Basic</span>
                                            <div class="dropdown dropstart" style="margin-left: auto;">
                                                <a href="#" class="link" style="float: right;"
                                                    id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 256 256">
                                                        <path fill="#000000"
                                                            d="M156 128a28 28 0 1 1-28-28a28 28 0 0 1 28 28m-28-52a28 28 0 1 0-28-28a28 28 0 0 0 28 28m0 104a28 28 0 1 0 28 28a28 28 0 0 0-28-28" />
                                                    </svg>
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <li>
                                                        <button class="dropdown-item btn-edit"
                                                            data-name="{{ $package->name }}"
                                                            data-description="{{ $package->description }}"
                                                            data-feature="{{ $package->packageFeatures }}"
                                                            data-price="{{ $package->price }}"
                                                            data-id="{{ $package->id }}">Edit</button>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item btn-delete" id="btn-delete-{{ $package->id }}"
                                                            data-id="{{ $package->id }}" style="color: red">Hapus</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <span class="fw-semibold"
                                                style="color: #175A95; font-size: 25px;">{{ $package->name }}</span>
                                        </div>
                                        <p class="card-text pt-2 text-muted fs-5">{{ $package->description }}</p>
                                        <h4 class="text-center pt-4 mt-5 mb-5">
                                            <sup class="pb-4" style="font-size: 23px; color: #175A95">Rp</sup>
                                            <sub class="fw-semibold"
                                                style="font-size: 45px; color: #175A95">{{ number_format($package->price, 0, ',', '.') }}</sub>
                                            <sub class="text-muted" style="font-size: 14px">/ 1 bulan</sub>
                                        </h4>
                                        <div class="pt-4">
                                            @foreach ($package->packageFeatures as $fitur)
                                                <p style="font-size: 18px">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                        viewBox="0 0 24 24">
                                                        <path fill="#28a745"
                                                            d="m10 13.6l5.9-5.9q.275-.275.7-.275t.7.275t.275.7t-.275.7l-6.6 6.6q-.3.3-.7.3t-.7-.3l-2.6-2.6q-.275-.275-.275-.7t.275-.7t.7-.275t.7.275z" />
                                                    </svg>
                                                    {{ $fitur->name_feature }}
                                                </p>
                                                <hr>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
                {{-- <div class="tab-pane fade" id="link1" role="tabpanel" aria-labelledby="link1-tab">
            </div>
            <div class="tab-pane fade" id="link2" role="tabpanel" aria-labelledby="link2-tab">
            </div> --}}
            </div>
        </div>
        <div id="navpill-statistik" class="tab-pane fade" role="tabpanel">
            statistik
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

@endsection

@section('script')
    <script src="{{ asset('admin/dist/libs/apexcharts/dist/apexcharts.min.js') }}"></script>

    <script src="{{ asset('admin/dist/libs/jquery.repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/plugins/repeater-init.js') }}"></script>

    <script>
        $('.btn-edit').on('click', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var description = $(this).data('description');
            var price = $(this).data('price');
            $('#form-update').attr('action', 'update-package/' + id);
            $('#name-update').val(name);
            $('#description-update').val(description);
            $('#price-update').val(price);
            $('#modal-update').modal('show');
        });

        $('.btn-delete').click(function() {
            var id = $(this).data('id');
            $('#form-delete').attr('action', '/delete-package/' + id);
            $('#modal-delete').modal('show');
        })
    </script>

    <script>
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

        var chart = new ApexCharts(document.querySelector("#chart-donut"), options);
        chart.render();
    </script>
@endsection
