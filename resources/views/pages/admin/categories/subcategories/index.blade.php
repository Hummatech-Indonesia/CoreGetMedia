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
    <title>Admin | Sub-Category</title>
</head>

@section('content')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
            <form class="d-flex">
                <div class="position-relative d-flex">
                    <input type="text" name="search" id="search-name" class="form-control search-chat py-2 px-5 ps-5"
                        placeholder="Search">
                    <i class="ti ti-search position-absolute top-50 translate-middle-y fs-6 text-dark ms-3"></i>
                </div>
            </form>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
            <div class="d-flex justify-content-end">
                <a href="{{route('category.list.admin')}}" class="btn mr-2 me-2" style="background-color: #D9D9D9"> <svg
                        xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="me-2" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M20 11H6.83l2.88-2.88A.996.996 0 1 0 8.3 6.71L3.71 11.3a.996.996 0 0 0 0 1.41L8.3 17.3a.996.996 0 1 0 1.41-1.41L6.83 13H20c.55 0 1-.45 1-1s-.45-1-1-1" />
                    </svg> Kembali</a>

                <button type="button" style="background-color: #175A95" class="btn btn-md text-white px-5"
                    data-bs-toggle="modal" data-bs-target="#modal-create">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 2 30 24">
                        <path fill="currentColor"
                            d="M18 12.998h-5v5a1 1 0 0 1-2 0v-5H6a1 1 0 0 1 0-2h5v-5a1 1 0 0 1 2 0v5h5a1 1 0 0 1 0 2" />
                    </svg>
                    Tambah
                </button>
            </div>
        </div>

    </div>

    <div class="">
        <div class="table-responsive rounded-2 mb-3">
            <table class="table border text-nowrap customize-table mb-0 align-middle">
                <thead class=" table">
                    <th style="background-color: #D9D9D9;">No</th>
                    <th style="background-color: #D9D9D9;">Name</th>
                    <th style="background-color: #D9D9D9;">Aksi</th>
                </thead>
                <tbody>
                    @forelse ($subCategories as $subcategory)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $subcategory->name }}</td>
                            <td>
                                <button id="btn-edti-{{ $subcategory->id }}" data-id="{{$subcategory->id}}" data-name="{{ $subcategory->name }}" style="background-color: #FFD643;" class="btn btn-sm btn-edit text-white me-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24"><path fill="#ffffff" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h8.925l-2 2H5v14h14v-6.95l2-2V19q0 .825-.587 1.413T19 21zm4-6v-4.25l9.175-9.175q.3-.3.675-.45t.75-.15q.4 0 .763.15t.662.45L22.425 3q.275.3.425.663T23 4.4t-.137.738t-.438.662L13.25 15zM21.025 4.4l-1.4-1.4zM11 13h1.4l5.8-5.8l-.7-.7l-.725-.7L11 11.575zm6.5-6.5l-.725-.7zl.7.7z"/></svg>
                                </button>
                                <button data-id="{{$subcategory->id}}" type="submit" style="background-color: #EF6E6E"
                                    class="btn btn-sm btn-delete text-white me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24"><path fill="#ffffff" d="M7 21q-.825 0-1.412-.587T5 19V6q-.425 0-.712-.288T4 5t.288-.712T5 4h4q0-.425.288-.712T10 3h4q.425 0 .713.288T15 4h4q.425 0 .713.288T20 5t-.288.713T19 6v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zm-7 11q.425 0 .713-.288T11 16V9q0-.425-.288-.712T10 8t-.712.288T9 9v7q0 .425.288.713T10 17m4 0q.425 0 .713-.288T15 16V9q0-.425-.288-.712T14 8t-.712.288T13 9v7q0 .425.288.713T14 17M7 6v13z"/></svg>
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
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Sub Kategori</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('subcategory.create.admin', ['category' => $category]) }}" method="POSt">
                    @method('post')
                    @csrf
                    <div class="modal-body">
                        <div>
                            <label class="form-label mt-2">Sub Kategori</label>
                            <input id="create-name" class="form-control" type="text" name="name">
                            <ul class="error-text"></ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-rounded btn-light-danger text-danger"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-rounded btn-light-success text-success">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-update" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit Sub Kategori</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-update" method="POST">
                    @method('put')
                    @csrf
                    <div class="modal-body text-start">
                        <label class="form-label mt-2">Name</label>
                        <input id="update-name" class="form-control" type="text" name="name">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-rounded btn-light-danger text-danger"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-rounded btn-light-success text-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <form id="form-delete" method="POST" class="modal-content">
                @method('DELETE')
                @csrf
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
        $('.btn-edit').click(function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            $('#update-name').val(name);
            $('#form-update').attr('action', '/subcategory-update/' + id);
            $('#modal-update').modal('show');
        })

        $('.btn-delete').click(function() {
            var id = $(this).data('id');
            $('#form-delete').attr('action', '/subcategory-delete/' + id);
            $('#modal-delete').modal('show');
        })
    </script>
@endsection
