@extends('layouts.admin.app')

<head>
    <title>Admin | News</title>
</head>

@section('content')
<div class="">
    <div class="d-flex gap-2 mb-3 mt-2">
        <form class="d-flex gap-2 w-100">
            <div>
                <div class="position-relative d-flex">
                    <div class="">
                        <input type="text" name="search" class="form-control search-chat py-2 px-5 ps-5"
                            id="search-name" placeholder="Search">
                        <i class="ti ti-search position-absolute top-50 translate-middle-y fs-6 text-dark ms-3"></i>
                    </div>
                </div>
            </div>

            <div>
                <div class="d-flex gap-2">
                    <select class="form-select" id="opsi-latest" style="width: 200px">
                        <option value="">Tampilkan semua</option>
                        <option value="terbaru">Terbaru</option>
                        <option value="terlama">Terlama</option>
                    </select>
                </div>
            </div>

            <div>
                <div class="d-flex gap-2">
                    <select class="form-select" id="opsi-perpage" style="width: 200px">
                        <option value="50">Status</option>
                        <option value="50">Sudah Bayar</option>
                        <option value="100">Belum Bayar</option>
                    </select>
                </div>
            </div>

            <div>
                <div class="d-flex gap-2">
                    <select class="form-select" id="opsi-latest" style="width: 200px">
                        <option value="terbaru">Jenis iklan</option>
                        <option value="terbaru">Gambar</option>
                        <option value="terlama">Video</option>
                    </select>
                </div>
            </div>

            <div class="ms-auto">
                <div class="d-flex gap-2">
                    <a href="/set-price" type="button" class="btn waves-effect waves-light btn-primary" style="background-color:#0F4D8A; border: none">Atur Posisi Iklan</a>
                </div>
            </div>
        </form>
    </div>
</div>


    <div class="table-responsive rounded-2 mt-4">
        <table class="table border text-nowrap customize-table mb-0 align-middle">
            <thead>
                <tr>
                    <th style="background-color: #D9D9D9;">No</th>
                    <th style="background-color: #D9D9D9;">Jenis Iklan</th>
                    <th style="background-color: #D9D9D9;">Tanggal Mulai</th>
                    <th style="background-color: #D9D9D9;">Tanggal Akhir</th>
                    <th style="background-color: #D9D9D9;">Halaman</th>
                    <th style="background-color: #D9D9D9; border-radius: 0 5px 5px 0;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($data as $advertisement)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $advertisement->type }}</td>
                        <td>{{ $advertisement->start_date }}</td>
                        <td>{{ $advertisement->end_date }}</td>
                        <td>{{ $advertisement->page }}</td>
                        <td>
                            <a href="{{ route('detail-advertisement.admin', ['advertisement' => $advertisement->id]) }}" data-bs-toggle="tooltip"
                                title="Detail" class="btn btn-sm btn-primary btn-detail"
                                style="background-color:#0F4D8A; border: none">
                                <i><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M12 6.5a9.77 9.77 0 0 1 8.82 5.5c-1.65 3.37-5.02 5.5-8.82 5.5S4.83 15.37 3.18 12A9.77 9.77 0 0 1 12 6.5m0-2C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5m0 5a2.5 2.5 0 0 1 0 5a2.5 2.5 0 0 1 0-5m0-2c-2.48 0-4.5 2.02-4.5 4.5s2.02 4.5 4.5 4.5s4.5-2.02 4.5-4.5s-2.02-4.5-4.5-4.5" />
                                    </svg></i>
                            </a>
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>

        </table>

    </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pzjw8V+VbWFr6J3QKZZxCpZ8F+3t4zH1t03eNV6zEYl5S+XnvLx6D5IT00jM2JpL" crossorigin="anonymous">
    </script>

    <script>
        get(1)
        let debounceTimer;

        $('#search-name').keyup(function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(function() {
                get(1)
            }, 500);
        });

        $('#opsi-latest').change(function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(function() {
                get(1)
            }, 500);
        });



        $('#opsi-perpage').change(function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(function() {
                get(1)
            }, 500);
        });
    </script>
@endsection
