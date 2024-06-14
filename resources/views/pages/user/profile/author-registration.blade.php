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
                                <input type="text" class="form-control" placeholder="Name" value="{{ auth()->user()->name }}" name="name"
                                    id="exampleInputtext">
                            </div>
                            <div class="col-lg-12">
                                <label for="exampleInputPassword1" class="form-label fw-semibold mt-4">Email</label>
                                <input type="email" class="form-control" id="exampleInputtext" value="{{ auth()->user()->email }}"
                                    name="email" placeholder="Email">
                            </div>
                            <div class="col-lg-12">
                                <label for="exampleInputPassword1" class="form-label fw-semibold mt-4">No
                                    Telephone (opsional)</label>
                                <input type="text" class="form-control" id="exampleInputtext" placeholder="No Telephone" value="{{ auth()->user()->phone_number }}"
                                    name="phone_number">
                            </div>
                            <div class="col-12">
                                <div class="">
                                    <label for="exampleInputPassword1"
                                        class="form-label fw-semibold mt-4">Address (opsional)</label>
                                    <textarea type="text" class="form-control" name="address" id="exampleInputtext"
                                        placeholder="Address" value="{{ auth()->user()->address }}" style="resize: none">{{ auth()->user()->address }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="">
                                    <label for="exampleInputPassword1" class="form-label fw-semibold mt-4">CV</label>
                                    <input type="file" class="form-control" id="exampleInputtext" value="#" name="cv">
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
                                <button class="btn btn-sm px-5 py-2 text-white" type="button" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal1"
                                    style="background-color: #175A95; font-size: large;">Ketentuan dan
                                    Persyaratan</button>
                            </div>
                            <div class="col-lg-12 mt-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckChecked" checked>
                                    <label class="col-4 form-check-label" for="flexSwitchCheckChecked"
                                        style="color: #888888; font-size: larger;">Ya, saya sudah membaca, memahami dan
                                        setuju
                                        dengan
                                        ketentuan & persyaran untuk jadi penulis GetMedia</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-end mt-4 gap-3">
                                    <button class="btn btn-sm px-4 py-2 text-white" type="submit" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal1"
                                        style="background-color: #175A95; font-size: large;">Kirim Pengajuan <i
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
@endsection











@endsection
