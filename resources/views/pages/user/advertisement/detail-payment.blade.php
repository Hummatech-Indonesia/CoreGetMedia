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
                            <img src="{{asset('storage/'. $data->image)}}" width="250" alt="">
                        </div>
                    </div>
                    <div class="col-lg-12 mb-4">
                        <label class="form-label" for="page">Halaman</label>
                        <select class="form-select" id="page-select" disabled>
                            <option value="home" {{ $data->positionAdvertisement->page == 'home' ? 'selected' : '' }}>Dashboard</option>
                            <option value="singlepost" {{ $data->positionAdvertisement->page == 'singlepost' ? 'selected' : '' }}>News Post</option>
                            <option value="category" {{ $data->positionAdvertisement->page == 'category' ? 'selected' : '' }}>Kategori</option>
                            <option value="subcategory" {{ $data->positionAdvertisement->page == 'subcategory' ? 'selected' : '' }}>Sub Kategori</option>
                        </select>
                    </div>
                    <div class="col-lg-12 mb-4">
                    <label for="position" class="form-label">Posisi Iklan</label>
                    <div class="">
                            @forelse ($positions as $position)
                                <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="position_advertisement_id" id="inlineRadio1-{{ $position->page }}" value="{{ $position->id }}"  {{ $data->position_advertisement_id == $position->id ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineRadio1">
                                        <p class="ms-2">Posisi {{ $position->position }} Full</p>
                                        <img src="{{asset($position->image)}}" width="300" height="200" alt="">
                                    </label>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                    <div class="col-lg-12 mb-4">
                        <label class="form-label" for="type">Jenis Iklan</label>
                        <select class="form-select" disabled>
                            <option value="photo" {{ $data->type == 'photo' ? 'selected' : '' }}>Foto</option>
                            <option value="video" {{ $data->type == 'video' ? 'selected' : '' }}>Video</option>
                        </select>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <label class="form-label" for="start_date">Tanggal Awal</label>
                        <input type="date" id="start_date" name="start_date" placeholder=""
                            value="{{ $data->start_date }}" class="form-control @error('start_date') is-invalid @enderror" disabled>
                        @error('start_date')
                            <span class="invalid-feedback" role="alert" style="color: red;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-lg-6 mb-4">
                        <label class="form-label" for="end_date">Tanggal Akhir</label>
                        <input type="date" id="end_date" name="end_date" placeholder=""
                            value="{{ $data->end_date }}" class="form-control @error('end_date') is-invalid @enderror" disabled>
                        @error('end_date')
                            <span class="invalid-feedback" role="alert" style="color: red;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-lg-12 mb-4">
                        <label class="form-label" for="url">URL</label>
                        <input type="text" id="url" name="url" placeholder=""
                            value="{{ $data->url }}" class="form-control @error('url') is-invalid @enderror" readonly>
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
            <div class="card">
                <div class="card-header py-2 d-flex justify-content-center" style="background-color: #175A95">
                    <h4 class="text-white">Rincian pembayaran</h4>
                </div>
                <div class="card-body shadow-sm">

                    {{-- <div class="d-flex mt-5 justify-content-between">
                        <p class="fw-semibold">Kode Voucher</p>

                        <p class="fs-3" style="color: #175A95;">ABCDE</p>
                    </div> --}}

                    <div class="d-flex mt-4 justify-content-between">
                        <p class="fw-semibold">Harga Upload</p>

                        <div class="d-flex">
                            {{-- <del><p class="fs-3 me-3" style="color: #175A95;">Rp. 100.000</p></del> --}}
                            <p class="fs-3" style="color: #175A95;">Rp. {{ $transaction->amount }}</p>
                        </div>
                    </div>

                    {{-- <div class="d-flex mt-4 justify-content-between">
                        <p class="fw-semibold">Diskon Voucher</p>

                        <div class="d-flex">
                            <p class="fs-3" style="color: #175A95;"><span>-</span>Rp. 20.000</p>
                        </div>
                    </div> --}}

                    <div class="d-flex mt-4 justify-content-between">
                        <p class="fw-semibold">Total Pembayaran</p>

                        <div class="d-flex">
                            <p class="fs-3" style="color: #175A95;">Rp. {{ $transaction->amount }}</p>
                        </div>
                    </div>

                    <div class="d-flex mt-4 justify-content-between">
                        <p class="fw-semibold">Kode Transaksi</p>
                        <p class="fs-3" style="color: #175A95;">{{ $transaction->reference }}</p>
                    </div>

                    <div class="d-flex mt-4 justify-content-between">
                        <p class="fw-semibold">Metode Pembayaran</p>
                        {{-- <img src="{{asset('assets/img/bca.svg')}}" width="80px" alt=""> --}}
                        <p class="fs-3" style="color: #175A95;">{{ $transaction->payment_method }}</p>
                        {{-- <button type="button" class="btn btn-outline-light text-primary" data-bs-toggle="modal" data-bs-target="#modal-create">Pilih metode pembayaran</button> --}}
                    </div>

                    <div class="d-flex mt-4 justify-content-between">
                            <p class="fw-semibold">Kode Pembayaran</p>

                            <div class="d-flex">
                                <p class="fs-3" style="color: #175A95;">{{ $transaction->pay_code }}</p>
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
                                @forelse ($transaction->instructions as $key => $instruction)
                                <div class="accordion-item">
                                  <h2 class="accordion-header" id="heading{{ ++$key }}">
                                    <button class="accordion-button {{ $key != 1 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $key }}" aria-expanded="true" aria-controls="collapseOne">
                                      {{ $instruction->title }}
                                    </button>
                                  </h2>
                                  <div id="collapse{{ $key }}" class="accordion-collapse collapse {{ $key == 1 ? 'show' : '' }}" aria-labelledby="heading{{ $key }}" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        @foreach ($instruction->steps as $step)
                                            <p class="text-sm">
                                                {{ $loop->iteration }}. {!! $step !!}
                                            </p>
                                        @endforeach
                                    </div>
                                  </div>
                                </div>
                              @empty

                              @endforelse
                              </div>
                            </div>
                          </div>

                        <div class="d-flex mt-4 justify-content-between">
                            <p class="fw-semibold">Status</p>
                            <div>
                                @if ($data->feed == 'paid')
                                    <span class="badge ms-2 px-3 bg-light-success text-success">
                                        Sudah Bayar
                                    </span>
                                @elseif ($data->feed == 'notpaid')
                                    <span class="badge ms-2 px-3 bg-light-danger text-danger">
                                        Belum Bayar
                                    </span>
                                @endif
                            </div>
                        </div>
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
            const $pageSelect = $('#page-select');
            const $positionDivs = $('.form-check.form-check-inline');

            function showHidePositionDivs() {
                const selectedPage = $pageSelect.val();

                $positionDivs.each(function() {
                    const $positionInput = $(this).find('input[name="position_advertisement_id"]');
                    const positionPage = $positionInput.attr('id').split('-')[1];

                    if (selectedPage === positionPage) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }

            $pageSelect.on('change', showHidePositionDivs);
            showHidePositionDivs();
        });
</script>

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
