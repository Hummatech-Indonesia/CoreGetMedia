@extends(auth()->user()->hasRole('author') ? 'layouts.author.app' : 'layouts.user.sidebar');

@section('content')
    <div class="card shadow-sm position-relative overflow-hidden" style="background-color: #E8F0F4;">
        <div class="card-body px-4 py-4">
            <div class="row justify-content-between">
                <div class="col-8">
                    <h4 class="fw-semibold mb-3 mt-2">Berlangganan</h4>
                    <p>Upgrade kualitas membaca</p>
                </div>
            </div>
        </div>
    </div>
    <h4>Riwayat Berlangganan</h4>

    <div class="row mt-4">
        <div class="col-lg-7">
            <div class="card p-4 pb-5 shadow-sm">
                <h4>Detail Paket</h4>
                <div class="ms-2">
                    <div class="d-flex mt-3">
                        <div class="bg-primary" style="width: 120px; height: 120px;">
                            <img src="" alt="" srcset="">
                        </div>
                        <div class="ms-3 mt-4" style="width: 100%">
                            <h6>Pilihan Paket:</h6>
                            <div class="mt-4 d-flex" style="width: 100%; justify-content: space-between">
                                <h3>Paket 1 : <span class="text-primary">100.000</span></h3>
                                <h3>/1bulan</h3>
                            </div>
                            <hr style="width: 100%">
                        </div>
                    </div>
                    <div class="mt-2">
                        <h5>Fitur Berlangganan :</h5>
                        <div class="card mt-3" style="background-color: #F2F2F2; border: 1px #CCCCCC">
                            <div class="card-body">
                                <p style="font-size: 18px" class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                        viewBox="0 0 24 24">
                                        <path fill="#28a745"
                                            d="m10 13.6l5.9-5.9q.275-.275.7-.275t.7.275t.275.7t-.275.7l-6.6 6.6q-.3.3-.7.3t-.7-.3l-2.6-2.6q-.275-.275-.275-.7t.275-.7t.7-.275t.7.275z" />
                                    </svg>
                                    Permblokiran iklan selama 1 bulan
                                </p>
                                <p style="font-size: 18px" class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                        viewBox="0 0 24 24">
                                        <path fill="#28a745"
                                            d="m10 13.6l5.9-5.9q.275-.275.7-.275t.7.275t.275.7t-.275.7l-6.6 6.6q-.3.3-.7.3t-.7-.3l-2.6-2.6q-.275-.275-.275-.7t.275-.7t.7-.275t.7.275z" />
                                    </svg>
                                    Permblokiran iklan selama 1 bulan
                                </p>
                                <p style="font-size: 18px" class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                        viewBox="0 0 24 24">
                                        <path fill="#28a745"
                                            d="m10 13.6l5.9-5.9q.275-.275.7-.275t.7.275t.275.7t-.275.7l-6.6 6.6q-.3.3-.7.3t-.7-.3l-2.6-2.6q-.275-.275-.275-.7t.275-.7t.7-.275t.7.275z" />
                                    </svg>
                                    Permblokiran iklan selama 1 bulan
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-5">
            <div class="card">
                <div class="card-header py-2 d-flex justify-content-center" style="background-color: #175A95">
                    <h4 class="text-white">Rincian pembayaran</h4>
                </div>
                <div class="card-body shadow-sm">
                    <div class="d-flex mt-4 justify-content-between">
                        <input type="text" style="width: 100%">
                        <button class="btn btn-sm text-white ms-2 px-3" style="background-color: #175A95;">
                            Salin
                        </button>
                    </div>

                    <div class="d-flex mt-4 justify-content-between">

                    </div>
                    <div class="d-flex mt-4 justify-content-between">
                        <p class="fw-semibold">Code Voucher</p>

                        <div class="d-flex">
                            <p class="fs-3" style="color: #175A95;">

                            </p>
                        </div>
                    </div>

                    <div class="d-flex mt-4 justify-content-between">
                        <p class="fw-semibold">Diskon Voucher</p>

                        <div class="d-flex">
                            <p class="fs-3" style="color: #175A95;">
                                Rp.
                            </p>
                        </div>

                        <div class="d-flex mt-4 justify-content-between">
                            <p class="fw-semibold">Total Pembayaran</p>

                            <div class="d-flex">
                                <p class="fs-3" style="color: #175A95;">Rp. </p>
                            </div>
                        </div>

                        <div class="d-flex mt-4 justify-content-between">
                            <p class="fw-semibold">Kode Transaksi</p>
                            <p class="fs-3" style="color: #175A95;"></p>
                        </div>

                        <div class="d-flex mt-4 justify-content-between">
                            <p class="fw-semibold">Metode Pembayaran</p>
                            {{-- <img src="{{asset('assets/img/bca.svg')}}" width="80px" alt=""> --}}
                            <p class="fs-3" style="color: #175A95;"></p>
                            {{-- <button type="button" class="btn btn-outline-light text-primary" data-bs-toggle="modal" data-bs-target="#modal-create">Pilih metode pembayaran</button> --}}
                        </div>

                        <div class="d-flex mt-4 justify-content-between">
                            <p class="fw-semibold">Kode Pembayaran</p>

                            <div class="d-flex">
                                <p class="fs-3" style="color: #175A95;"></p>
                                <div>
                                    <button class="btn btn-sm text-white ms-2 px-3" style="background-color: #175A95;">
                                        Salin
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class=" mt-4 justify-content-between">
                            <p class="fw-semibold">Intruksi Pembayaran</p>
                            <div class="accordion" id="accordionExample">
                                <div class="container">
                                    <div class="card m-5">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="">
                                            </h2>
                                            <div>
                                                <div class="accordion-body">
                                                    <p class="text-sm">
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex mt-4 justify-content-between">
                                <p class="fw-semibold">Status</p>
                                <div>
                                    <span class="badge ms-2 px-3 bg-light-success text-success">
                                        Sudah Bayar
                                    </span>
                                    <span class="badge ms-2 px-3 bg-light-danger text-danger">
                                        Belum Bayar
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
