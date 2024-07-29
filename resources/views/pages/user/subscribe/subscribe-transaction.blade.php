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

    <div class="row mt-4">
        <div class="col-lg-7">
            <div class="card pb-5 shadow-sm">
                <div class="card-header  d-flex justify-content-center" style="background-color: #175A95">
                    <h4 class="text-white">Detail Paket</h4>
                </div>
                    <div class="ms-2 p-4">
                        <div class="d-flex mt-2">
                            <div style="width: 100%">
                                <h5>Pilihan Paket:</h5>
                                <div class="mt-4 d-flex" style="width: 100%; justify-content: space-between">
                                    <h3 class="fw-semibold">Paket 1 : <span class="text-primary">100.000</span></h3>
                                    <h3>/1bulan</h3>
                                </div>
                                <hr style="width: 100%">
                            </div>
                        </div>
                        <div class="mt-2">
                            <h5>Fitur Berlangganan :</h5>
                            <div class="card mt-4" style="background-color: #F2F2F2; border: 1px solid #CCCCCC; box-shadow: none">
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
                <div class="card-header d-flex justify-content-center" style="background-color: #175A95">
                    <h4 class="text-white">Rincian pembayaran</h4>
                </div>
                <div class="card-body shadow-sm">
                    <p class="fw-semibold" style="font-size: 18px">Kode Voucher (opsional) :</p>
                    <div class="d-flex mt-3 justify-content-between ">
                        <input class="rounded ps-2" type="text" style="width: 100%; border: 1px solid #CCCCCC">
                        <button class="btn btn-sm text-white ms-2 px-3" style="background-color: #175A95; font-size: 15px">
                            Terapkan
                        </button>
                    </div>
                    <hr>
                    <div class="d-flex mt-4 justify-content-between" style="font-size: 18px">
                        <p class="fw-semibold">Code Voucher :</p>
                        <div class="d-flex">
                            <a href="" class="fw-semibold" style="color: #175A95;">Pilih Metode Pembayaran</a>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex mt-4 justify-content-between" style="font-size: 18px">
                        <p class="fw-semibold">Subtotal :</p>

                        <div class="d-flex">
                            <p class="fw-semibold">
                                Rp. 100.000
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex mt-4 justify-content-between" style="font-size: 18px">
                        <p class="fw-semibold">Pajak 11% :</p>

                        <div class="d-flex">
                            <p class="fw-semibold">
                                Rp. 5.000
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex mt-4 justify-content-between" style="font-size: 18px">
                        <p class="fw-semibold">Total Pesanan :</p>

                        <div class="d-flex">
                            <p class="fw-semibold">
                                1 paket
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex mt-4 justify-content-between" style="font-size: 18px">
                        <p class="fw-semibold">Total :</p>

                        <div class="d-flex">
                            <p class="fw-semibold">
                                Rp. 105.000
                            </p>
                        </div>
                    </div>

                    <button style="background-color: #175A95; width: 100%; height: 40px; border: none"
                        class="text-white mt-3 rounded">Selanjutnya</button>

                </div>
            </div>
        </div>
    @endsection
