@extends('layouts.admin.app')

@section('style')
    <style>
        .progress-bar {
            background-image: linear-gradient(to right, #DD1818, #175A95);
        }
    </style>
    <style>
        #copy-tooltip {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: white;
            border-radius: 10px;
            color: #1EBB9E;
            padding: 10px;
            border: 1px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: none;
            z-index: 1000;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6 mb-3">
            <form class="d-flex gap-2">
                <div class="position-relative">
                    <div class="">
                        <input type="text" name="search" class="form-control search-chat py-2 px-5 ps-5" id="search-name"
                            placeholder="Search">
                        <i class="ti ti-search position-absolute top-50 translate-middle-y fs-6 text-dark ms-3"></i>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <select name="banned" class="form-select" id="search-status">
                        <option value="">Pilih status</option>
                        <option value="approved">Aktif</option>
                        <option value="reject">Blokir</option>
                        <option value="">Tampilkan semua</option>
                    </select>
                </div>
            </form>
        </div>
        <div class="col-lg-6 mb-3">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn text-white px-5" style="background-color: #175A95" data-bs-toggle="modal"
                    data-bs-target="#modal-create"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                        viewBox="0 2 30 24">
                        <path fill="currentColor"
                            d="M18 12.998h-5v5a1 1 0 0 1-2 0v-5H6a1 1 0 0 1 0-2h5v-5a1 1 0 0 1 2 0v5h5a1 1 0 0 1 0 2" />
                    </svg>
                    Tambah
                </button>
            </div>
        </div>
    </div>


    <div class="">
        <div class="row">
            @forelse ($vouchers as $voucher)
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="card-header" style="background-color: #175A95;">
                            <div class="row">
                                <div class="col-lg-11 d-flex justify-content-center">
                                    <h5 class="text-white text-center">Kode Voucher</h5>
                                </div>

                                <div class="col-lg-1 d-flexx justify-content-end">
                                    <div class="dropdown dropstart">
                                        <a href="#" class="link" style="float: right;" id="dropdownMenuButton"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 256 256">
                                                <path fill="#ffffff"
                                                    d="M156 128a28 28 0 1 1-28-28a28 28 0 0 1 28 28m-28-52a28 28 0 1 0-28-28a28 28 0 0 0 28 28m0 104a28 28 0 1 0 28 28a28 28 0 0 0-28-28" />
                                            </svg>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <button id="btn-edit-{{ $voucher->id }}" data-id="{{ $voucher->id }}"
                                                    data-code="{{ $voucher->code }}" data-quota="{{ $voucher->quota }}"
                                                    data-presentation="{{ $voucher->presentation }}"
                                                    data-status="{{ $voucher->status }}" data-stok="{{ $voucher->stok }}"
                                                    data-start_date="{{ $voucher->start_date }}"
                                                    data-end_date="{{ $voucher->end_date }}" class="dropdown-item btn-edit"
                                                    data-bs-toggle="modal" data-bs-target="#modal-update">Edit</button>
                                                <button data-id="{{ $voucher->id }}" id="btn-delete-{{ $voucher->id }}"
                                                    class="dropdown-item btn-delete" data-bs-toggle="modal"
                                                    data-bs-target="#modal-delete">Hapus</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <div>
                                    <span class="mb-1 badge fs-5 fw-semibold bg-light-primary text-primary p-3 ps-4 pe-4"
                                        style="border-radius: 8px;">Diskon {{ $voucher->presentation }}%</span>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center mt-4">
                                <div>
                                    <h5 id="kode">{{ $voucher->code }}
                                        <a id="copylink" tooltip="Salin Link">
                                            <span class="badge ms-3 copyLink" style="background-color: #E9E9E9;"
                                                onclick="copyToClipboard()" id="copy">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                    viewBox="0 0 512 512">
                                                    <path fill="#888888"
                                                        d="M408 480H184a72 72 0 0 1-72-72V184a72 72 0 0 1 72-72h224a72 72 0 0 1 72 72v224a72 72 0 0 1-72 72" />
                                                    <path fill="#888888"
                                                        d="M160 80h235.88A72.12 72.12 0 0 0 328 32H104a72 72 0 0 0-72 72v224a72.12 72.12 0 0 0 48 67.88V160a80 80 0 0 1 80-80" />
                                                </svg>
                                            </span>
                                        </a>
                                        <div id="copy-tooltip">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="m9.55 18l-5.7-5.7l1.425-1.425L9.55 15.15l9.175-9.175L20.15 7.4z" />
                                            </svg>
                                            Berhasil disalin
                                        </div>
                                    </h5>
                                </div>
                            </div>

                            <div class="text-center">
                                <div class="progress mb-3 mt-4" style="background-color: #D1D1D1;">
                                    @if ($voucher->quota > 0)
                                        {{-- <div class="progress-bar" style="width:{{ $voucher->voucher_useds_count }}%; height: 6px; border-width: {{ $voucher->quota }}%;" role="progressbar"></div> --}}
                                    @else
                                        <div class="progress-bar" style="width: 100%; height: 6px; border-width: 100%;"
                                            role="progressbar"></div>
                                    @endif
                                </div>
                                @if ($voucher->quota > 0)
                                    <p>{{ $voucher->voucher_useds_count }} Terpakai dari {{ $voucher->quota }} stok</p>
                                @else
                                    <p>Unlimited</p>
                                @endif
                            </div>

                            <div class="text-center mt-4">
                                <h5>Masa Aktif</h5>
                                <div class=" mt-3">
                                    <h5 style="color: #175A95;">{{ $voucher->start_date }} - {{ $voucher->end_date }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Voucher</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('voucher.store.admin') }}" method="POST">
                    @method('post')
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="form-label mt-2">Kode Voucher</label>
                                <input class="form-control" type="text" name="code">
                                <ul class="error-text"></ul>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label mt-2">Potongan Harga</label>
                                <input class="form-control" type="text" name="presentation">
                                <ul class="error-text"></ul>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label mt-2">Tanggal Awal</label>
                                <input class="form-control" type="date" name="start_date">
                                <ul class="error-text"></ul>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label mt-2">Tanggal Akhir</label>
                                <input class="form-control" type="date" name="end_date">
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
                                <input id="stok" class="form-control" class="stok" type="text"
                                    name="quota">
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

    <div class="modal fade" id="modal-update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Voucher</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-update" method="POST">
                    @method('put')
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="form-label mt-2">Kode Voucher</label>
                                <input id="update-code" class="form-control" type="text" name="code">
                                <ul class="error-text"></ul>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label mt-2">Potongan Harga</label>
                                <input id="update-presentation" class="form-control" type="text" name="presentation">
                                <ul class="error-text"></ul>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label mt-2">Tanggal Awal</label>
                                <input id="update-start_date" class="form-control" type="date" name="start_date">
                                <ul class="error-text"></ul>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label mt-2">Tanggal Akhir</label>
                                <input id="update-end_date" class="form-control" type="date" name="end_date">
                                <ul class="error-text"></ul>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label mt-2">Jenis Voucher</label>
                                <select class="form-control" name="status" id="update-status">
                                    @foreach ($vouchers as $voucher)
                                        <option value="{{ $voucher->name }}">{{ $voucher->status }}</option>
                                    @endforeach
                                </select>
                                <ul class="error-text"></ul>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label mt-2">Stok</label>
                                <input id="update-quota" class="form-control" type="text" name="quota">
                                <ul class="error-text"></ul>
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
    <script>
        $('.btn-edit').click(function() {
            var id = $(this).data('id');
            var code = $(this).data('code');
            var quota = $(this).data('quota');
            var presentation = $(this).data('presentation');
            var status = $(this).data('status');
            var stok = $(this).data('stok');
            var start_date = $(this).data('start_date');
            var end_date = $(this).data('end_date');

            $('#update-code').val(code);
            $('#update-quota').val(quota);
            $('#update-presentation').val(presentation);
            // $('#update-status').val(status);
            $('#update-stok').val(stok);
            $('#update-start_date').val(start_date);
            $('#update-end_date').val(end_date);
            $('#form-update').attr('action', '/voucher-update/' + id);

            $('#update-status').val(status).trigger('change');
            $('#modal-update').modal('show');
        });

        $('.btn-delete').click(function() {
            var id = $(this).data('id');
            $('#form-delete').attr('action', '/voucher-delete/' + id);
            $('#modal-delete').modal('show');
        });

        // $(document).ready(function() {
        //     $('#stok-wrapper').hide();

        //     $('#jenis-voucher').change(function() {
        //         var selectedValue = $(this).val();
        //         if (selectedValue === 'unlimited') {
        //             $('#stok-wrapper').hide();
        //         } else if (selectedValue === 'quota') {
        //             $('#stok-wrapper').show();
        //         }
        //     });
        // });

        // function copyToClipboard(kode) {
        //     const tempInput = document.createElement('input');
        //     tempInput.value = kode;
        //     document.body.appendChild(tempInput);
        //     tempInput.select();
        //     tempInput.setSelectionRange(0, 99999); // Untuk perangkat mobile
        //     document.execCommand('copy');
        //     document.body.removeChild(tempInput);
        //     alert('Kode telah disalin: ' + kode);
        // }


        function copyToClipboard() {
            const kode = document.getElementById('kode').innerText.trim();
            navigator.clipboard.writeText(kode).then(function() {
                const tooltip = document.getElementById('copy-tooltip');
                tooltip.style.display = 'block';
                setTimeout(function() {
                    tooltip.style.display = 'none';
                }, 2000);
            }, function(err) {
                console.error('Failed to copy: ', err);
            });
        }
    </script>
@endsection
