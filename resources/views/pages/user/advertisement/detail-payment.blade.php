@extends('layouts.user.sidebar')

@section('style')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link rel="stylesheet" href="{{ asset('assets/dist/imageuploadify.min.css') }}">
<style>
    .card.active {
        border: 1px solid #175A95;
        box-shadow: 0 3px 20px #175A95;
    }
</style>
@endsection

@section('content')
<div class="card shadow-sm position-relative overflow-hidden"  style="background-color: #175A95;">
    <div class="card-body px-4 py-4">
      <div class="row justify-content-between">
        <div class="col-8 text-white">
          <h4 class="fw-semibold mb-3 mt-2 text-white">Pengisian Iklan</h4>
            <p>Layanan pengiklanan di getmedia.id</p>
        </div>
        <div class="col-3">
          <div class="text-center mb-n4">
            <img src="{{asset('assets/img/bg-ajuan.svg')}}" width="250px" alt="" class="img-fluid">
          </div>
        </div>
      </div>
    </div>
</div>

<form action="#" method="post">
    @csrf

    <div class="row mt-4 ">
        <div class="col-lg-7">
            <div class="card p-4 pb-5 shadow-sm">
                <h4>Detail Iklan</h4>
                <div class="row mt-3">
                    <div class="col-lg-12 mb-4">
                        <label class="form-label" for="content">Gambar</label>
                        <div class="">
                            <img src="{{asset('assets/img/iklan-vertikal.svg')}}" width="250" alt="">
                        </div>
                    </div>
                    <div class="col-lg-12 mb-4">
                        <label class="form-label" for="page">Halaman</label>
                        <select name="page" class="form-select" id="" readonly>
                            <option value="dashboard"></option>
                            <option value="news_post">News Post</option>
                            <option value="sub_category">Sub Kategori</option>
                        </select>
                    </div>
                    <div class="col-lg-12 mb-4">
                        <label for="position" class="form-label">Posisi Iklan</label>
                        <div class="">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="position" id="inlineRadio1" value="full_horizontal" checked>
                                <label class="form-check-label" for="inlineRadio1">
                                    <img src="{{asset('assets/img/iklan-dash.svg')}}" width="200" height="120" alt="">
                                </label>
                            </div>
                            {{-- <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="position" id="inlineRadio2" value="horizontal">
                                <label class="form-check-label" for="inlineRadio2">
                                    <img src="{{asset('assets/img/iklan-vertikal.svg')}}" width="200" height="120" alt="">
                                </label>
                            </div>
                                <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="position" id="inlineRadio3" value="vertikal">
                                <label class="form-check-label" for="inlineRadio3">
                                    <img src="{{asset('assets/img/iklan-horizontal.svg')}}" width="200" height="120" alt="">
                                </label>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-lg-12 mb-4">
                        <label class="form-label" for="type">Jenis Iklan</label>
                        <select name="type" class="form-select" id="" readonly>
                            <option value="foto">Foto</option>
                            <option value="vidio">Vidio</option>
                        </select>
                    </div>
                    
                    <div class="col-lg-6 mb-4">
                        <label class="form-label" for="start_date">Tanggal Awal</label>
                        <input type="date" id="start_date" name="start_date" placeholder=""
                            value="{{ old('start_date') }}" class="form-control @error('start_date') is-invalid @enderror" readonly>
                        @error('start_date')
                            <span class="invalid-feedback" role="alert" style="color: red;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="col-lg-6 mb-4">
                        <label class="form-label" for="end_date">Tanggal Akhir</label>
                        <input type="date" id="end_date" name="end_date" placeholder=""
                            value="{{ old('end_date') }}" class="form-control @error('end_date') is-invalid @enderror" readonly>
                        @error('end_date')
                            <span class="invalid-feedback" role="alert" style="color: red;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-lg-12 mb-4">
                        <label class="form-label" for="url">URL</label>
                        <input type="text" id="url" name="url" placeholder=""
                            value="{{ old('url') }}" class="form-control @error('url') is-invalid @enderror" readonly>
                        @error('url')
                            <span class="invalid-feedback" role="alert" style="color: red;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-5">
            <div class="card p-4">
                <h4>Rincian pembayaran</h4>

                <div class="d-flex mt-5 justify-content-between">
                    <p class="fw-semibold">Kode Voucher</p>

                    <p class="fs-3" style="color: #175A95;">ABCDE</p>
                </div>

                <div class="d-flex mt-4 justify-content-between">
                    <p class="fw-semibold">Harga Upload</p>

                    <div class="d-flex">
                        {{-- <del><p class="fs-3 me-3" style="color: #175A95;">Rp. 100.000</p></del> --}}
                        <p class="fs-3" style="color: #175A95;">Rp. 10.000</p>
                    </div>
                </div>

                <div class="d-flex mt-4 justify-content-between">
                    <p class="fw-semibold">Diskon Voucher</p>

                    <div class="d-flex">
                        <p class="fs-3" style="color: #175A95;"><span>-</span>Rp. 20.000</p>
                    </div>
                </div>

                <div class="d-flex mt-4 justify-content-between">
                    <p class="fw-semibold">Total Pembayaran</p>

                    <div class="d-flex">
                        <p class="fs-3" style="color: #175A95;">Rp. 80.000</p>
                    </div>
                </div>

                <div class="d-flex mt-4 justify-content-between">
                    <p class="fw-semibold">Bayar Sebelum Tanggal</p>
                    <p class="fs-3" style="color: #175A95;">12/12/2020</p>
                </div>

                <div class="d-flex mt-4 justify-content-between">
                    <p class="fw-semibold">Kode Transaksi</p>
                    <p class="fs-3" style="color: #175A95;">DEV-T26250149620IYONL</p>
                </div>

                <div class="d-flex mt-4 justify-content-between">
                    <p class="fw-semibold">Metode Pembayaran</p>
                    <img src="{{asset('assets/img/bca.svg')}}" width="80px" alt="">
                    {{-- <button type="button" class="btn btn-outline-light text-primary" data-bs-toggle="modal" data-bs-target="#modal-create">Pilih metode pembayaran</button> --}}
                </div>

                <div class="d-flex mt-4 justify-content-between">
                        <p class="fw-semibold">Kode Pembayaran</p>

                        <div class="d-flex">
                            <p class="fs-3" style="color: #175A95;">473635346744955</p>
                            <button class="btn btn-sm text-white ms-2 px-3" style="background-color: #175A95;">
                                Salin
                            </button>
                        </div>
                </div>

            </div>
        </div>
    </div>

</form>

<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="tambahdataLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Pilih Metode Pembayaran</h5>
            </div>
            <form id="form-create" method="post">
                <div class="modal-body">
                    <span class="fw-semibold text-dark fs-4">Bank</span>

                    <div class="row">
                        <div class="col-lg-6 mt-2">
                            <div class="card card-act shadow-sm card p-3" onclick="selectCard(this)">
                                <div class="d-flex align-items-center">
                                    {{-- <input type="radio" name="payment" id="bri_va" value="bri" class="me-2" style="accent-color: #0056b3;">
                                    <label for="bri_va" class="mb-0 d-flex">
                                        <img src="{{ asset('assets/img/bank-bri.svg') }}" width="100px" alt="BRI Virtual Account">
                                        <div class="ms-4 mt-3">
                                            <p class="text-dark">BRI Virtual Account</p>
                                        </div>
                                    </label> --}}
                                    <div class="d-flex">
                                        <img src="{{asset('assets/img/bank-bri.svg')}}" width="100px" alt="">
                                        <div class="ms-4 mt-3">
                                            <p class="text-dark">BRI Virtual Account</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-2">
                            <div class="card card-act shadow-sm card p-3" onclick="selectCard(this)">
                                <div class="d-flex">
                                    <img src="{{asset('assets/img/bank-mandiri.svg')}}" width="100px" alt="">
                                    <div class="ms-4 mt-3">
                                        <p class="text-dark">Marndiri Virtual Account</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card card-act shadow-sm card p-3" onclick="selectCard(this)">
                                <div class="d-flex">
                                    <img src="{{asset('assets/img/bank-bca.svg')}}" width="100px" alt="">
                                    <div class="ms-4 mt-3">
                                        <p class="text-dark">BCA Virtual Account</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card card-act shadow-sm card p-3" onclick="selectCard(this)">
                                <div class="d-flex">
                                    <img src="{{asset('assets/img/bank-bni.svg')}}" width="100px" alt="">
                                    <div class="ms-4 mt-3">
                                        <p class="text-dark">BNI Virtual Account</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card card-act shadow-sm card p-3" onclick="selectCard(this)">
                                <div class="d-flex">
                                    <img src="{{asset('assets/img/bank-bsi.svg')}}" width="100px" alt="">
                                    <div class="ms-4 mt-3">
                                        <p class="text-dark fs-5">BSI Virtual Account</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    

                    <span class="fw-semibold text-dark fs-4">E-Wallet</span>

                    <div class="col-lg-6 mt-2">
                        <div class="card card-act shadow-sm card p-3" onclick="selectCard(this)">
                            <div class="d-flex">
                                <img src="{{asset('assets/img/wallet-gopay.svg')}}" width="100px" alt="">
                                <div class="ms-4 mt-3">
                                    <p class="text-dark">Gopay</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mt-2">
                        <div class="card card-act shadow-sm card p-3" onclick="selectCard(this)">
                            <div class="d-flex">
                                <img src="{{asset('assets/img/wallet-ovo.svg')}}" width="100px" alt="">
                                <div class="ms-4 mt-3">
                                    <p class="text-dark">OVO</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card card-act shadow-sm card p-3" onclick="selectCard(this)">
                            <div class="d-flex">
                                <img src="{{asset('assets/img/wallet-dana.svg')}}" width="100px" alt="">
                                <div class="ms-4 mt-3">
                                    <p class="text-dark">Dana</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card card-act shadow-sm card p-3" onclick="selectCard(this)">
                            <div class="d-flex">
                                <img src="{{asset('assets/img/wallet-indomaret.svg')}}" width="100px" alt="">
                                <div class="ms-4 mt-3">
                                    <p class="text-dark">Indomart</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card card-act shadow-sm card p-3" onclick="selectCard(this)">
                            <div class="d-flex">
                                <img src="{{asset('assets/img/wallet-alfamart.svg')}}" width="100px" alt="">
                                <div class="ms-4 mt-3">
                                    <p class="text-dark">Alfamart</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> 
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-light-danger text-danger"
                        data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-rounded btn-light-success text-success">Pilih</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
    
<script src="{{ asset('assets/dist/imageuploadify.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#image-uploadify').imageuploadify();
    })

    function selectCard(selectedCard) {
        var cards = document.querySelectorAll('.card-act');
        
        cards.forEach(function(card) {
            card.classList.remove('active');
        });

        selectedCard.classList.add('active');
    }
</script>
@endsection