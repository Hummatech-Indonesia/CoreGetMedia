@extends('layouts.admin.app')

@section('content')
{{-- <div class="mb-4 mt-2 d-flex justify-content-between"> --}}
<div class="row">
    <div class="col-12 mb-3">
        <div class="d-flex gap-2 w-100 justify-content-between">
            <form>
                <div>
                    <div class="position-relative d-flex">
                        <div class="">
                            <input type="text" name="name" value="{{ old('name', request()->name) }}" class="form-control search-chat py-2 px-5 ps-5" id="search-name" placeholder="Search">
                            <i class="ti ti-search position-absolute top-50 translate-middle-y fs-6 text-dark ms-3"></i>
                        </div>
                    </div>
                </div>
            </form>
            <div class="d-flex justify-content-between">
                <button type="button" style="width: 150px; background-color: #175A95;" class="btn btn-md text-white px-4" data-bs-toggle="modal" data-bs-target="#modal-create">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 2 30 24">
                        <path fill="currentColor" d="M18 12.998h-5v5a1 1 0 0 1-2 0v-5H6a1 1 0 0 1 0-2h5v-5a1 1 0 0 1 2 0v5h5a1 1 0 0 1 0 2" />
                    </svg>
                    Tambah
                </button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    @forelse ($admins as $admin)
    <div class="col-md-12 col-lg-3 mb-4">
        <div class="card border hover-img shadow-sm">
            <div class="card-body p-2">
                <div class="dropdown dropstart" style="margin-left: auto;">
                    <a href="#" class="link" style="float: right;" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 256 256">
                            <path fill="#000000" d="M156 128a28 28 0 1 1-28-28a28 28 0 0 1 28 28m-28-52a28 28 0 1 0-28-28a28 28 0 0 0 28 28m0 104a28 28 0 1 0 28 28a28 28 0 0 0-28-28" />
                        </svg>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li>
                            <button class="dropdown-item btn-edit" data-name="{{ $admin->name }}" data-email="{{ $admin->email }}" data-password="{{ $admin->password }}" data-id="{{ $admin->id }}">Edit</button>
                        </li>
                        <li>
                            <a class="dropdown-item btn-delete" data-id="{{ $admin->id }}" style="color: red">Hapus</a>
                        </li>
                    </ul>
                </div>
                <div class="p-4 text-center">
                    <div>
                        <img src="{{asset($admin->photo ? 'storage/'.$admin->photo : "default.png")}}" alt="" class="rounded-circle mb-3" style="object-fit: cover" width="120" height="120">
                    </div>
                    <h5>{{ $admin->name }}</h5>
                    <p class="fs-5">{{ $admin->email }}</p>
                </div>
            </div>
            <div class="card-footer" style="border-top-width: 4px">
                <h5 class="text-center">
                    Admin
                </h5>
            </div>
        </div>
    </div>
    @empty
    <div class="d-flex justify-content-center vh-100 text-center">
        <div>
            <img src="{{ asset('assets/Empty-cuate.png') }}" alt="No Data" width="230px">
            <p>Belum ada data</p>
        </div>
    </div>

    @endforelse

</div>


<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="tambahdataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahdataLabel">Tambah Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin-account.store') }}" method="POST">
                @csrf
                @method('post')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="name" class="form-label">Nama:</label>
                            <input type="text" id="name" name="name" placeholder="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                            <span class="invalid-feedback" role="alert" style="color: red;">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="text" id="email" name="email" placeholder="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                            <span class="invalid-feedback" role="alert" style="color: red;">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="text" id="password" name="password" placeholder="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                            <span class="invalid-feedback" role="alert" style="color: red;">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-light-danger text-danger" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-rounded btn-light-success text-success">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-update" tabindex="-1" aria-labelledby="updatedataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updatedataLabel">Update Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-update" method="POST">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="name" class="form-label">Nama:</label>
                            <input type="text" name="name" placeholder="name" value="{{ old('name') }}" id="name-update" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                            <span class="invalid-feedback" role="alert" style="color: red;">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="text" name="email" placeholder="email" value="{{ old('email') }}" id="email-update" class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                            <span class="invalid-feedback" role="alert" style="color: red;">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-light-danger text-danger" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-rounded btn-light-success text-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="tambahdataLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <form id="form-delete" class="modal-content" method="post">
            @csrf
            @method('delete')
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
    $('.btn-edit').on('click', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var email = $(this).data('email');
        var password = $(this).data('password');
        $('#form-update').attr('action', '/admin-account-update/' + id);
        $('#name-update').val(name);
        $('#email-update').val(email);
        $('#password-update').val(password);
        console.log(id);
        $('#modal-update').modal('show');
    });

    $('.btn-delete').on('click', function() {
        var id = $(this).data('id');
        $('#form-delete').attr('action', '/admin-account-list/' + id);
        console.log(id);
        $('#modal-delete').modal('show');
    });

</script>
@endsection
