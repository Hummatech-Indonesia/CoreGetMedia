@extends('layouts.admin.app')

@section('style')
<style>
    .table-border {
        border: 1px solid #DADADA;
        border-radius: 5px;
        /* padding: 25px; */
    }

</style>
@endsection

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

@section('content')
<div class="">
    <div class="row">
        <div class="col-8 d-flex gap-2 mb-3 mt-2">
            <form class="d-flex gap-2">
                <div>
                    <div class="position-relative d-flex">
                        <div class="">
                            <input type="text" name="search" class="form-control search-chat py-2 px-5 ps-5" id="search-name" placeholder="Search">
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
                        <select class="form-select" name="perpage" id="opsi-perpage" style="width: 200px">
                            <option selected value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-4 d-flex align-items-center justify-content-end gap-3">
            <a href="{{ route('news-list.admin') }}" class="btn btn-secondary">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-narrow-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l4 4" /><path d="M5 12l4 -4" /></svg>
                <span class="ms-1">Kembali</span></a>
        </div>
    </div>
</div>

<div class="table-responsive rounded-2 mt-4">
    <table class="table border text-nowrap customize-table mb-0 align-middle">
        <thead>
            <tr>
                <th style="background-color: #D9D9D9; border-radius: 5px 0 0 5px;">No</th>
                <th style="background-color: #D9D9D9;">Penulis</th>
                <th style="background-color: #D9D9D9;">Email</th>
                <th style="background-color: #D9D9D9;">Judul berita</th>
                <th style="background-color: #D9D9D9;">Tanggal Upload</th>
                <th style="background-color: #D9D9D9; border-radius: 0 5px 5px 0;">Option</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($news as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->user->email }}</td>
                <td><a href="{{ route('news.singlepost', ['news' => $item->slug]) }}" style="color: #4a4a4a">{!! Illuminate\Support\Str::limit(strip_tags($item->name), 50, '...') !!}</a></td>
                <td>{{ \Carbon\Carbon::parse($item->date)->translatedFormat('d F Y') }}</td>
                <td>
                    @if ($item->user->roles->pluck('name')[0] == "admin")
                    <a href="{{ route('edit.news', ['news' => $item->slug]) }}" data-bs-toggle="tooltip" title="Detail" class="btn btn-sm btn-detail" style="background-color: #FFD643;">
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 512 512">
                                <path d="M64 368v80h80l235.727-235.729-79.999-79.998L64 368zm377.602-217.602c8.531-8.531 8.531-21.334 0-29.865l-50.135-50.135c-8.531-8.531-21.334-8.531-29.865 0l-39.468 39.469 79.999 79.998 39.469-39.467z" fill="#ffffff" />
                            </svg>
                        </i>
                    </a>
                    @endif
                    <button type="button" style="background-color: #EF6E6E" class="btn btn-sm text-white btn-delete" data-id="{{$item->id}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24">
                            <path fill="#ffffff" d="M7 21q-.825 0-1.412-.587T5 19V6q-.425 0-.712-.288T4 5t.288-.712T5 4h4q0-.425.288-.712T10 3h4q.425 0 .713.288T15 4h4q.425 0 .713.288T20 5t-.288.713T19 6v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zm-7 11q.425 0 .713-.288T11 16V9q0-.425-.288-.712T10 8t-.712.288T9 9v7q0 .425.288.713T10 17m4 0q.425 0 .713-.288T15 16V9q0-.425-.288-.712T14 8t-.712.288T13 9v7q0 .425.288.713T14 17M7 6v13z"/>
                        </svg>
                    </button>
                    <a href="{{route('detail-news.admin', ['news' => $item->slug])}}" data-bs-toggle="tooltip" title="Detail" class="btn btn-sm btn-primary btn-detail" style="background-color: #0F4D8A;">
                        <i><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M12 6.5a9.77 9.77 0 0 1 8.82 5.5c-1.65 3.37-5.02 5.5-8.82 5.5S4.83 15.37 3.18 12A9.77 9.77 0 0 1 12 6.5m0-2C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5m0 5a2.5 2.5 0 0 1 0 5a2.5 2.5 0 0 1 0-5m0-2c-2.48 0-4.5 2.02-4.5 4.5s2.02 4.5 4.5 4.5s4.5-2.02 4.5-4.5s-2.02-4.5-4.5-4.5" />
                            </svg></i>
                    </a>
                    @if ($item->pin == 1)
                    <a class="" data-bs-toggle="tooltip" title="Berita di Pin">
                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24">
                            <path fill="#000" d="M16 3a1 1 0 0 1 .117 1.993L16 5v4.764l1.894 3.789a1 1 0 0 1 .1.331L18 14v2a1 1 0 0 1-.883.993L17 17h-4v4a1 1 0 0 1-1.993.117L11 21v-4H7a1 1 0 0 1-.993-.883L6 16v-2a1 1 0 0 1 .06-.34l.046-.107L8 9.762V5a1 1 0 0 1-.117-1.993L8 3z" />
                        </svg>
                    </a>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center mt-5">
                    <img src="{{ asset('assets/Empty-cuate.png') }}" alt="" width="230px">
                    <p>Tidak ada draft</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- <x-delete-modal-component /> --}}
{{-- <div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <form id="form-delete" method="POST" class="modal-content">
            @csrf
            @method('delete')
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="myModalLabel">
                    Tolak Artikel
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin akan menolak data ini? </p>
                <div class="col-lg-12">
                    <textarea class="form-control" name="" id="" cols="30" rows="7"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-danger text-danger font-medium waves-effect" data-bs-dismiss="modal">
                    Batal
                </button>
                <button type="submit" class="btn btn-light-danger text-secondery font-medium waves-effect" data-bs-dismiss="modal">
                    Hapus
                </button>
            </div>
        </form>
    </div>
</div> --}}

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
                <p>Apakah anda yakin akan menghapus data ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-danger text-danger font-medium waves-effect" data-bs-dismiss="modal">
                    Batal
                </button>
                <button type="submit" class="btn btn-light-danger text-secondery font-medium waves-effect">
                    Hapus
                </button>
            </div>
        </form>
    </div>
</div>


@endsection

@section('script')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8V+VbWFr6J3QKZZxCpZ8F+3t4zH1t03eNV6zEYl5S+XnvLx6D5IT00jM2JpL" crossorigin="anonymous">
</script>

<script>
    $(document).ready(function() {
        $('#synopsis').summernote({
            toolbar: [
                ['style', ['style']]
                , ['font', ['bold', 'underline', 'clear']]
                , ['color', ['color']]
                , ['para', ['ul', 'ol', 'paragraph']]
                , ['table', ['table']]
                , ['insert', ['link', 'picture', 'video']]
                , ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });

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


    function splitDate(dateString) {
        const months = {
            "Januari": 1
            , "Februari": 2
            , "Maret": 3
            , "April": 4
            , "Mei": 5
            , "Juni": 6
            , "Juli": 7
            , "Agustus": 8
            , "September": 9
            , "Oktober": 10
            , "November": 11
            , "Desember": 12
        };

        const dateParts = dateString.split(' ');

        const day = parseInt(dateParts[0]);
        const month = months[dateParts[1]];
        const year = parseInt(dateParts[2]);

        return {
            day
            , month
            , year
        };
    }

</script>

<script>
        $('.btn-delete').on('click', function() {
        var id = $(this).data('id');
        $('#form-delete').attr('action', '/delete-news/' + id);
        console.log(id);
        $('#modal-delete').modal('show');
    });
</script>
@endsection
