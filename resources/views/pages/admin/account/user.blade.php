@extends('layouts.admin.app')

@section('title')
    User List
@endsection

@section('content')
    <div class="modal fade" id="modal-detail" tabindex="-1" aria-labelledby="modal-detail Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal content -->
                <div class="modal-header">
                    <h3 class="modal-title">Detail data User</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <img class="rounded-circle mb-4" id="detail-image" width="150" alt="photo" height="150" />
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item" style="font-weight: bold;">Nama :<span id="detail-name"
                                            style="font-weight: normal;"></span>
                                    </li>
                                    <li class="list-group-item" style="font-weight: bold;">Email:<span id="detail-email"
                                            style="font-weight: normal;"></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item" style="font-weight: bold;">Tanggal Lahir: <span
                                            id="detail-birth_date" style="font-weight: normal;"></span></li>
                                    <li class="list-group-item" style="font-weight: bold;">Alamat: <span id="detail-address"
                                            style="font-weight: normal;"></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-danger text-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
            <form class="d-flex gap-2">
                <div>
                    <div class="position-relative d-flex">
                        <div class="">
                            <input type="text" name="name" value="{{ old('name', request()->name) }}" class="form-control search-chat py-2 px-5 ps-5"
                                id="search-name" placeholder="Search">
                            <i class="ti ti-search position-absolute top-50 translate-middle-y fs-6 text-dark ms-3"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="d-flex gap-2">
                        <select class="form-select" id="opsi">
                            <option value="terbaru">Terbaru</option>
                            <option value="terlama">Terlama</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modal-detail" tabindex="-1" aria-labelledby="modal-detail Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal content -->
                <div class="modal-header">
                    <h3 class="modal-title">Detail data User</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <img src="" class="rounded-circle mb-4" id="detail-photo" width="150" alt="photo-siswa"
                            height="150" />
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item" style="font-weight: bold;">Nama : <span id="detail-name"
                                            style="font-weight: normal;"></span>
                                    </li>
                                    <li class="list-group-item" style="font-weight: bold;">Nomer Telepon : <span
                                            id="detail-phone_number" style="font-weight: normal;"></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item" style="font-weight: bold;">Email: <span id="detail-email"
                                            style="font-weight: normal;"></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-danger mt-3 text-danger"
                        data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <div class="table-responsive rounded-2 mt-4">
            <table class="table border text-nowrap customize-table mb-0 align-middle">
                <thead>
                    <tr>
                        <th style="background-color: #D9D9D9;">No</th>
                        <th style="background-color: #D9D9D9;">Nama</th>
                        <th style="background-color: #D9D9D9;">Email</th>
                        <th style="background-color: #D9D9D9;">Status</th>
                        <th style="background-color: #D9D9D9;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset($user->image ? 'storage/' . $user->image : 'default.png') }}"
                                    class="rounded-circle me-2 user-profile" style="object-fit: cover" width="35"
                                    height="35" alt="" />
                                {{ $user->name }}
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->status }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    @if ($user->status === 'active')
                                        <form action="/banned-user/{{ $user->id }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-danger">Banned</button>
                                        </form>
                                        <button title="Detail" data-name="{{ $user->name }}"
                                            data-birth="{{ $user->date_of_birth ? $user->date_of_birth : '-' }}"
                                            data-address="{{ $user->address ? $user->address : '-' }}"
                                            data-image="{{ $user->image ? 'storage/' . $user->image : 'default.png' }}"
                                            data-email="{{ $user->email }}"
                                            class="btn btn-sm btn-primary btn-detail me-2"
                                            style="background-color:#5D87FF">
                                            <i><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M12 6.5a9.77 9.77 0 0 1 8.82 5.5c-1.65 3.37-5.02 5.5-8.82 5.5S4.83 15.37 3.18 12A9.77 9.77 0 0 1 12 6.5m0-2C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5m0 5a2.5 2.5 0 0 1 0 5a2.5 2.5 0 0 1 0-5m0-2c-2.48 0-4.5 2.02-4.5 4.5s2.02 4.5 4.5 4.5s4.5-2.02 4.5-4.5s-2.02-4.5-4.5-4.5" />
                                                </svg></i>
                                        </button>
                                    @else
                                        <form action="/active-user/{{ $user->id }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-warning">Active</button>
                                        </form>

                                        <button title="Detail" data-name="{{ $user->name }}"
                                            data-birth="{{ $user->date_of_birth ? $user->date_of_birth : '-' }}"
                                            data-address="{{ $user->address ? $user->address : '-' }}"
                                            data-image="{{ $user->image ? 'storage/' . $user->image : 'default.png' }}"
                                            data-email="{{ $user->email }}"
                                            class="btn btn-sm btn-primary btn-detail me-2"
                                            style="background-color:#5D87FF">
                                            <i><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M12 6.5a9.77 9.77 0 0 1 8.82 5.5c-1.65 3.37-5.02 5.5-8.82 5.5S4.83 15.37 3.18 12A9.77 9.77 0 0 1 12 6.5m0-2C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5m0 5a2.5 2.5 0 0 1 0 5a2.5 2.5 0 0 1 0-5m0-2c-2.48 0-4.5 2.02-4.5 4.5s2.02 4.5 4.5 4.5s4.5-2.02 4.5-4.5s-2.02-4.5-4.5-4.5" />
                                                </svg></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="6" class="text-center mt-5">
                                <img src="{{ asset('assets/Empty-cuate.png') }}" alt="" width="230px">
                                <p>Belum ada data</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                <x-paginatoradmin :paginator="$users" />
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script>
        $('.btn-detail').on('click', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var email = $(this).data('email');
            var image = $(this).data('image');
            var date = $(this).data('data_of_birth')
            var address = $(this).data('address')
            $('#form-tolak').attr('action', '/confirm-author/' + id);
            $('#form-terima').attr('action', '/confirm-author/' + id);
            $('#detail-name').text(name);
            $('#detail-email').text(email);
            $('#detail-image').attr('src', image);
            $('#detail-birth_date').text(date)
            $('#detail-address').text(address)
            console.log(id);
            $('#modal-detail').modal('show');
        });
    </script>
@endsection
