@extends('layouts.user.sidebar')

@section('content')
    <div class="">
        <div class="">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade active show" id="pills-account" role="tabpanel" aria-labelledby="pills-account-tab"
                    tabindex="0">
                    <div class="row">
                        <div class="col-lg-12 d-flex align-items-stretch">
                            <div class="card w-100 position-relative overflow-hidden">
                                <div class="card-body p-4">

                                    <h2 class="card-title fw-semibold">Edit Profile</h2>
                                    <p class="card-subtitle mb-4">Edit foto profile dan biodata disini</p>
                                    
                                    <div class="row border-bottom pb-5">
                                        <div class="col-lg-4">
                                            <h5 class="mt-5">Foto Profil</h5>
                                        </div>
                                        <div class="col-lg-8">
                                            <div>
                                                <img src="{{asset('admin/dist/images/profile/user-8.jpg')}}" alt=""
                                                    class="img-fluid rounded-circle" width="120" height="120">
                                                    <form method="POST" action="#" id="upload-photo" enctype="multipart/form-data">
                                                        {{-- @csrf --}}
                                                        <div style="margin-top: -20px; margin-left: 85px">
                                                            <span style="background-color: #D9D9D9; border-radius: 50%;" class="p-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#175a95" d="M5 19h1.425L16.2 9.225L14.775 7.8L5 17.575zm-2 2v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM19 6.4L17.6 5zm-3.525 2.125l-.7-.725L16.2 9.225z"/></svg>
                                                            </span>
                                                            {{-- <input type="file" style="display: none" name="photo" id="photo">
                                                            <button class="btn btn-primary btn-upload" type="button" id="btn-upload">Upload</button>
                                                            <button type="submit" style="display: none" id="submit-button">Save</button> --}}
                                                        </div>
                                                    </form>

                                            </div>
                                        </div>

                                    </div>

                                    <div class="row border-bottom pb-5">
                                        <div class="col-lg-4">
                                            <h5 class="mt-5">Nama</h5>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control mt-5">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-stretch">
                            <div class="card w-100 position-relative overflow-hidden">
                                <div class="card-body p-4">
                                    <h5 class="card-title fw-semibold">Ganti Password</h5>
                                    <p class="card-subtitle mb-4">Untuk mengubah kata sandi Anda, silakan konfirmasi di sini
                                    </p>
                                    <form action="#" method="POST">
                                        {{-- @method('post')
                                        @csrf --}}
                                        <div class="mb-4">
                                            <label for="exampleInputPassword1" class="form-label fw-semibold">Password
                                                Lama</label>
                                            <input type="password" name="old_password" class="form-control" id="exampleInputPassword1">
                                        </div>
                                        <div class="mb-4">
                                            <label for="exampleInputPassword1" class="form-label fw-semibold">Password
                                                Baru</label>
                                            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                                        </div>
                                        <div class="">
                                            <label for="exampleInputPassword1" class="form-label fw-semibold">Konfirmasi
                                                Password</label>
                                            <input type="password" name="confirm_passwrod" class="form-control" id="exampleInputPassword1">
                                        </div>
                                        <div class="col-12">
                                            <div class="d-flex align-items-center justify-content-end mt-4 gap-3">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                                <button class="btn btn-light-danger text-danger">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card w-100 position-relative overflow-hidden mb-0">
                                <div class="card-body p-4">
                                    <h5 class="card-title fw-semibold">Biodata</h5>
                                    <p class="card-subtitle mb-4">Untuk mengubah detail pribadi Anda, edit dan simpan dari
                                        sini</p>
                                    <form action="#" method="POST">
                                        {{-- @method('post')
                                        @csrf --}}
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-4">
                                                    <label for="exampleInputPassword1" class="form-label fw-semibold">Nama
                                                        Anda</label>
                                                    <input type="text" class="form-control"
                                                        value="M.Ardian" name="name" id="exampleInputtext">
                                                </div>
                                                <div class="mb-4">
                                                    <label for="exampleInputPassword1"
                                                        class="form-label fw-semibold">Email</label>
                                                    <input type="email" class="form-control" id="exampleInputtext"
                                                        value="ardian@gmail.com" name="email" placeholder="Masukan Email Anda">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-4">
                                                    <label for="exampleInputPassword1" class="form-label fw-semibold">No
                                                        Telephone</label>
                                                    <input type="text" class="form-control" id="exampleInputtext"
                                                        value="#" name="phone_number">
                                                </div>
                                                <div class="mb-4">
                                                    <label for="exampleInputPassword1"
                                                        class="form-label fw-semibold">Tanggal Lahir</label>
                                                    <input type="date" value="01/01/2022" name="birth_date" class="form-control" id="exampleInputtext">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="">
                                                    <label for="exampleInputPassword1"
                                                        class="form-label fw-semibold">Address</label>
                                                    <textarea type="text" class="form-control" name="address" id="exampleInputtext" placeholder="Jl. Indonesia" style="resize: none">Jl. Indonesia Raya</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-flex align-items-center justify-content-end mt-4 gap-3">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                    <button class="btn btn-light-danger text-danger">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- @section('script')
    <script>
        document.getElementById('btn-upload').addEventListener('click', function() {
            document.getElementById('photo').click();
        });

        document.getElementById('photo').addEventListener('change', function() {
            document.getElementById('submit-button').click();
        });
    </script>
@endsection --}}
