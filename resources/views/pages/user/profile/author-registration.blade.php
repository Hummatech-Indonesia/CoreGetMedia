@extends('layouts.user.sidebar')
@section('content')
<div class="card">
    <div class="card-body" style="background-color: #E8F0F4;" width="100%" height="150px">
        <h2 class="fw-bolder mb-3">Ingin Menulis Beritamu Sendiri?</h2>
        <h5>Daftarkan Diri Anda Menjadi Penulis Di GetMedia!</h5>
    </div>
</div>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade active show" id="pills-account" role="tabpanel" aria-labelledby="pills-account-tab"
        tabindex="0">
        <div class="col-12">
            <div class="card w-100 position-relative overflow-hidden mb-0">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold">Pengisian Biodata</h5>
                    <p class="card-subtitle mb-2" style="color: #888888;">Pastikan biodata di isi dengan tepat untuk
                        menjadi penulis</p>
                    <form action="{{ route('author.create') }}" method="POST" enctype="multipart/form-data">
                        @method('post')
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="exampleInputPassword1" class="form-label fw-semibold mt-4">Nama
                                    Anda</label>
                                <input type="text" class="form-control" placeholder="Name"
                                    value="{{ auth()->user()->name }}" name="name" id="exampleInputtext">
                            </div>
                            <div class="col-lg-12">
                                <label for="exampleInputPassword1" class="form-label fw-semibold mt-4">Email</label>
                                <input type="email" class="form-control" id="exampleInputtext"
                                    value="{{ auth()->user()->email }}" name="email" placeholder="Email">
                            </div>
                            <div class="col-lg-12">
                                <label for="exampleInputPassword1" class="form-label fw-semibold mt-4">No
                                    Telepon (opsional)</label>
                                <input type="text" class="form-control" id="exampleInputtext" placeholder="No Telepon"
                                    value="{{ auth()->user()->phone_number }}" name="phone_number">
                            </div>
                            <div class="col-12">
                                <div class="">
                                    <label for="exampleInputPassword1" class="form-label fw-semibold mt-4">Alamat
                                        (opsional)</label>
                                    <textarea type="text" class="form-control" name="address" id="exampleInputtext"
                                        placeholder="Alamat" value="{{ auth()->user()->address }}"
                                        style="resize: none">{{ auth()->user()->address }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="">
                                    <div class="d-flex justify-content-between mt-4">
                                        <label for="exampleInputPassword1" class="form-label fw-semibold">CV</label>
                                        <button type="button" class="btn btn-success mb-2" id="viewPdfBtn" style="background-color: #175A95; border: none" disabled>Lihat cv</button>
                                    </div>
                                    <input type="file" class="form-control" id="cvInput" name="cv" accept="application/pdf">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label for="exampleInputPassword1" class="form-label fw-semibold mt-4">Profil
                                    Singkat (untuk tampil di akun) (opsional)</label>
                                <input type="text" class="form-control" id="exampleInputtext" value=""
                                    name="description">
                            </div>
                            <div class="row">

                            </div>
                            <div class="col-6 mt-4">
                                <h5 class="card-title fw-semibold">Ketentuan dan Persyaratan</h5>
                                <p class="card-subtitle my-3" style="color: #888888;">Pastikan membaca ketentuan &
                                    Persyaratan untuk menjadi
                                    penulis
                                </p>
                                <a href="{{ route('terms-conditions') }}" class="btn btn-xs px-3 py-1 text-white" style="background-color: #175A95; font-size: 16px;">Ketentuan dan Persyaratan</a>
                            </div>
                            <div class="col-lg-12 mt-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckChecked">
                                    <label class="col-4 form-check-label" for="flexSwitchCheckChecked"
                                        style="color: #888888; font-size: larger;">Ya, saya sudah membaca, memahami dan
                                        setuju
                                        dengan
                                        ketentuan & persyaran untuk jadi penulis GetMedia</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-end mt-4 gap-3">
                                    <button class="button-kirim btn btn-sm px-4 py-2 text-white" type="submit"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal1"
                                        style=" font-size: large; background-color: #d9d9d9;">Kirim Pengajuan <i
                                            data-feather="send"></i></button>
                                    <!-- <button type="submit" class="btn btn-primary">Save</button>
                                    <button class="btn btn-light-danger text-danger">Cancel</button> -->
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    feather.replace();
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
     $(document).ready(function() {
        var pdfUrl;

        $('#cvInput').on('change', function() {
            if (this.files && this.files[0]) {
                pdfUrl = URL.createObjectURL(this.files[0]);
                $('#viewPdfBtn').prop('disabled', false);
            } else {
                $('#viewPdfBtn').prop('disabled', true);
            }
        });

        $('#viewPdfBtn').click(function() {
            if (pdfUrl) {
                window.open(pdfUrl);
            }
        });
    });
</script>

<script>
    const switchInput = document.querySelector('.form-check-input');
    const buttonKirim = document.querySelector('.button-kirim');
    switchInput.addEventListener('click', function () {
        if (switchInput.checked) {
            buttonKirim.style.backgroundColor = "#175A95"
        } else {
            buttonKirim.style.backgroundColor = "#d9d9d9"
        }
    })
</script>


@endsection
