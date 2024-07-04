@extends(auth()->user()->hasRole('author') ? 'layouts.author.app' : 'layouts.user.sidebar')

@section('style')
    <style>
        .card-table {
            background-color: #fff;
            padding: 25px;
            border-radius: 10px;
        }

        .nav-underline .nav-link.active,
        .nav-underline .show>.nav-link {
            font-weight: 500;
            color: #175A95;
            border-bottom-color: currentcolor;
            padding-left: 15px;
            padding-right: 15px;
        }
    </style>
@endsection

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
    <div class="mt-4">
        <ul class="nav nav-underline" id="myTab" role="tablist">
            <li class="nav-item ms-2">
                <a class="nav-link active" id="artikel-tab" style="padding-right: 15px; padding-left: 15px;"
                    data-bs-toggle="tab" href="#artikel" role="tab" aria-controls="artikel">
                    <span>Menunggu</span>
                </a>
            </li>
            <li class="nav-item ms-2">
                <a class="nav-link" id="aktif-tab" style="padding-right: 15px; padding-left: 15px;" data-bs-toggle="tab"
                    href="#aktif" role="tab" aria-controls="aktif">
                    <span>Aktif</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="tab-content tabcontent-border mt-3" id="myTabContent">
        <div role="tabpanel" class="tab-pane fade show active" id="artikel" aria-labelledby="active-tab">
            <div class="table-responsive rounded-2">
                <table class="table border text-nowrap customize-table mb-0 align-middle ">
                    <thead>
                        <tr>
                            <th style="background-color: #D9D9D9;">Paket</th>
                            <th style="background-color: #D9D9D9;">Harga</th>
                            <th style="background-color: #D9D9D9;">Metode</th>
                            <th style="background-color: #D9D9D9;">Status</th>
                            <th style="background-color: #D9D9D9;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Paket 1</td>
                            <td>100.000</td>
                            <td>BCA</td>
                            <td>
                                <span class="mb-1 badge rounded-pill font-medium bg-light-danger text-danger w-30">Belum
                                    Bayar</span>
                            </td>
                            <td>
                                <button type="submit" style="background-color: #EF6E6E"
                                    class="btn btn-sm text-white btn-delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23"
                                        viewBox="0 0 24 24">
                                        <path fill="#ffffff"
                                            d="M7 21q-.825 0-1.412-.587T5 19V6q-.425 0-.712-.288T4 5t.288-.712T5 4h4q0-.425.288-.712T10 3h4q.425 0 .713.288T15 4h4q.425 0 .713.288T20 5t-.288.713T19 6v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zm-7 11q.425 0 .713-.288T11 16V9q0-.425-.288-.712T10 8t-.712.288T9 9v7q0 .425.288.713T10 17m4 0q.425 0 .713-.288T15 16V9q0-.425-.288-.712T14 8t-.712.288T13 9v7q0 .425.288.713T14 17M7 6v13z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="aktif" role="tabpanel" aria-labelledby="aktif-tab">
            <div class="table-responsive rounded-2">
                <table class="table border text-nowrap customize-table mb-0 align-middle ">
                    <thead>
                        <tr>
                            <th style="background-color: #D9D9D9;">Paket</th>
                            <th style="background-color: #D9D9D9;">Harga</th>
                            <th style="background-color: #D9D9D9;">Dimulai</th>
                            <th style="background-color: #D9D9D9;">Berakhir</th>
                            <th style="background-color: #D9D9D9;">status</th>
                            <th style="background-color: #D9D9D9;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Paket 1</td>
                            <td>100.000</td>
                            <td>10 mei 2020</td>
                            <td>30 mei 2020</td>
                            <td>
                                <span
                                    class="mb-1 badge rounded-pill font-medium bg-light-primary text-primary w-30">Aktif</span>
                            </td>
                            <td>
                                <button id="" class="btn btn-sm btn-primary btn-detail me-2" style="background-color:#175A95">
                                    <i><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                            viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M12 6.5a9.77 9.77 0 0 1 8.82 5.5c-1.65 3.37-5.02 5.5-8.82 5.5S4.83 15.37 3.18 12A9.77 9.77 0 0 1 12 6.5m0-2C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5m0 5a2.5 2.5 0 0 1 0 5a2.5 2.5 0 0 1 0-5m0-2c-2.48 0-4.5 2.02-4.5 4.5s2.02 4.5 4.5 4.5s4.5-2.02 4.5-4.5s-2.02-4.5-4.5-4.5" />
                                        </svg></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
