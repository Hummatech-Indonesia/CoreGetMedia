@extends('layouts.admin.app')

@section('style')
    <style>
        .card-table {
            background-color: #fff;
            padding: 25px;
            border-radius: 10px;
        }

        .table-border {
            border: 1px solid #DADADA;
            border-radius: 5px;
            /* padding: 25px; */
        }
    </style>
@endsection

<head>
    <title>Admin | Author</title>
</head>

@section('content')
    <div class="modal fade" id="modal-reject" tabindex="-1" aria-labelledby="modal-reject Label">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal content -->
                <div class="modal-header">
                    <h3 class="modal-title ms-2 mt-2">Tolak Penulis Ini?</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form id="form-reject" method="POST">
                        @csrf
                        @method('put')
                        <div class="container">
                            <div class="mb-3">
                                <div>
                                    <h5 class="mb-3">Berikan Alasan</h5>
                                </div>
                                <div>
                                    <textarea class="form-control" name="reject_description" id="" cols="30" rows="10"
                                        placeholder="Alasan tolak iklan" style="resize: none;"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-12">
                                <div class="d-flex justify-content-end gap-2">
                                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                                    <button data-bs-toggle="tooltip" type="submit" title="Tolak"
                                        class="btn btn-danger me-2">Tolak</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-approved" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <form id="form-approved" method="POST" class="modal-content">
                @method('put')
                @csrf
                <div class="modal-header d-flex align-items-center">
                    <h4 class="modal-title" id="myModalLabel">
                        Teima Penulis
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <p>Apakah anda yakin akan menerima penulis ini?</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-warning text-warning font-medium waves-effect"
                        data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-light-success text-success font-medium waves-effect"
                        data-bs-dismiss="modal">
                        Terima
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex justify-content-between">
        <div class="d-flex justify-content-start gap-2 ">
            <form>
                <div class="position-relative d-flex">
                    <div class="">
                        <input type="text" name="name" id="search-name" value="{{ old('name', request()->name) }}"
                            class="form-control search-chat py-2 px-5 ps-5" value="" placeholder="Cari..">
                        <i class="ti ti-search position-absolute top-50 translate-middle-y fs-6 text-dark ms-3"></i>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="mt-4 col-md-12 col-lg-12">
        <div class="table-responsive rounded-2 mb-3">
            <table class="table border text-nowrap customize-table mb-0 align-middle">
                <thead>
                    <tr>
                        <th style="background-color: #D9D9D9;">No</th>
                        <th style="background-color: #D9D9D9;">Name</th>
                        <th style="background-color: #D9D9D9;">Email</th>
                        <th style="background-color: #D9D9D9;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($authors as $author)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset($author->user->photo ? 'storage/' . $author->user->photo : 'default.png') }}"
                                    class="rounded-circle me-2 user-profile" style="object-fit: cover" width="35"
                                    height="35" alt="" />
                                {{ $author->user->name }}
                            </td>
                            <td>{{ $author->user->email }}</td>
                            <td>
                                <button data-bs-toggle="tooltip" title="Detail" data-id="{{ $author->id }}"
                                    data-name="{{ $author->user->name }}" data-cv="{{ asset('storage/' . $author->cv) }}"
                                    data-image="{{ $author->user->image ? 'storage/' . $author->user->image : 'default.png' }}"
                                    data-email="{{ $author->user->email }}"
                                    data-birth="{{ $author->user->date_of_birth ? $author->user->date_of_birth : '-' }}"
                                    data-address="{{ $author->user->address ? $author->user->address : '-' }}"
                                    class="btn btn-sm btn-primary btn-detail me-2" style="background-color:#5D87FF">
                                    <i><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                            viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M12 6.5a9.77 9.77 0 0 1 8.82 5.5c-1.65 3.37-5.02 5.5-8.82 5.5S4.83 15.37 3.18 12A9.77 9.77 0 0 1 12 6.5m0-2C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5m0 5a2.5 2.5 0 0 1 0 5a2.5 2.5 0 0 1 0-5m0-2c-2.48 0-4.5 2.02-4.5 4.5s2.02 4.5 4.5 4.5s4.5-2.02 4.5-4.5s-2.02-4.5-4.5-4.5" />
                                        </svg></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td class="text-center align-middle" colspan="100%">
                            <img src="{{ asset('assets/img/no-data.svg') }}" width="200px" alt="">
                            <p>Belum ada data</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        <div class="modal fade" id="modal-detail" tabindex="-1" aria-labelledby="modal-detail Label"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Modal content -->
                    <div class="modal-header">
                        <h3 class="modal-title">Detail data Author</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-center">
                            <img class="rounded-circle mb-2" id="detail-photo" width="150" alt="photo-siswa"
                                height="150" />
                        </div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item mb-3" style="font-weight: bold;">Nama : <span
                                                id="detail-name" style="font-weight: normal;"></span>
                                        </li>
                                        <li class="list-group-item mb-3" style="font-weight: bold;">Email: <span
                                                id="detail-email" style="font-weight: normal;"></span>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">

                                        <li class="list-group-item" style="font-weight: bold;">Tanggal Lahir: <span
                                                id="detail-birth_date" style="font-weight: normal;"></span></li>

                                        <li class="list-group-item" style="font-weight: bold;">Alamat: <span
                                                id="detail-address" style="font-weight: normal;"></span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        @if (isset($author) && file_exists(public_path('storage/' . $author->cv)))
                            <a href="{{ asset('storage/' . $author->cv) }}" target="_blank"
                                class="btn btn-light-primary text-primary me-2 fs-4 px-2 py-2">Lihat CV</a>
                            <a href="#" type="button"
                                class="btn btn-light-primary text-primary me-2 fs-4 px-2 py-2 btn-download"
                                data-id="{{ $author->id }}" data-task="{{ asset('storage/' . $author->cv) }}"
                                data-name="{{ optional($author->user)->name }}">
                                <div class="mx-1">Download CV</div>
                            </a>
                        @else
                            <p class="mb-0 me-2">CV tidak tersedia</p>
                        @endif

                        <a class="download-file" style="display: none;"></a>
                        <button type="button" data-id="button-tolak" id="btn-tolak"
                            class="btn btn-sm btn-reject btn-light-danger text-danger fs-4 me-2 px-2">Tolak</button>
                        <button data-id="button-terima" id="btn-terima" type="button"
                            class="btn btn-sm btn-accepted btn-light-success text-success fs-4 px-2">Terima</button>
                    </div>



                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="mySmallModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <form id="form-delete" method="POST" class="modal-content">
                    @csrf
                    @method('post')
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

    </div>
@endsection

@section('script')
    <script>
        $('.btn-detail').on('click', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var email = $(this).data('email');
            var image = $(this).data('image');
            var date = $(this).data('data_of_birth');
            var address = $(this).data('address');
            var cv = $(this).data('cv');
            $('#detail-name').text(name);

            var $btnCv = $('#btn-cv');
            if ($btnCv.length > 0) {
                $btnCv.attr('data-cv', cv);
            } else {
                console.error('Elemen dengan id "btn-cv" tidak ditemukan');
            }

            $('#btn-tolak').attr('data-id', id);
            $('#btn-terima').attr('data-id', id);
            $('#detail-email').text(email);
            $('#detail-photo').attr('src', image);
            $('#detail-birth_date').text(date)
            $('#detail-address').text(address)
            console.log(id);
            $('#modal-detail').modal('show');
        });

        $('.btn-lihat-cv').on('click', function() {
            var cvUrl = $(this).data('cv');
            if (cvUrl) {
                showPdfViewer(cvUrl);
            } else {
                console.error('Tidak ada URL CV yang tersedia');
            }
        });

        function showPdfViewer(pdfUrl) {
            pdfjsLib.getDocument(pdfUrl).promise.then(function(pdf) {
                pdf.getPage(1).then(function(page) {
                    var scale = 1.5;
                    var viewport = page.getViewport({
                        scale: scale
                    });

                    var canvas = document.getElementById('pdf-viewer');
                    var context = canvas.getContext('2d');
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    var renderContext = {
                        canvasContext: context,
                        viewport: viewport
                    };
                    page.render(renderContext);
                });
            }).catch(function(error) {
                console.error('Error rendering PDF:', error);
            });
        }

        $('.btn-reject').on('click', function() {
            var id = $('#btn-tolak').attr('data-id');
            $('#form-reject').attr('action', '/reject-author/' + id);
            $('#modal-detail').modal('hide');
            $('#modal-reject').modal('show');
        });

        $('.btn-accepted').on('click', function() {
            var id = $('#btn-terima').attr('data-id');
            $('#form-approved').attr('action', '/confirm-author/' + id);
            $('#modal-detail').modal('hide');
            $('#modal-approved').modal('show');
        });

        $(document).ready(function() {
            let cvPath = $('.btn-download').data('task');
            $('#open-cv').attr('href', cvPath);

            $('.btn-download').click(function(e) {
                e.preventDefault();
                let file = $(this).data('task');
                let fileName = $(this).data('name') + '.pdf';
                $('.download-file').attr('href', file);
                $('.download-file').attr('download', fileName);
                $('.download-file')[0].click();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            let cvPath = $('.btn-download').data('task');
            $('#open-cv').attr('href', cvPath);

            $('.btn-download').click(function(e) {
                e.preventDefault();
                let file = $(this).data('task');
                let fileName = $(this).data('name') + '.pdf';
                $('.download-file').attr('href', file);
                $('.download-file').attr('download', fileName);
                $('.download-file')[0].click();
            });
        });
    </script>
@endsection
