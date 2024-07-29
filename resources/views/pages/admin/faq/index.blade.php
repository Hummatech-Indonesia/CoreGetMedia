@extends('layouts.admin.app')

@section('style')
    <style>
        .card-table {
            background-color: #fff;
            padding: 25px;
            border-radius: 10px;
        }
    </style>
@endsection

<head>
    <title>Admin | Faq-List</title>
</head>

@section('content')
    <div class="mb-3">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                <form class="d-flex">
                    <div class="position-relative d-flex">
                        <div class="">
                            <input type="text" name="name" id="search-name"
                                class="form-control search-chat py-2 px-5 ps-5" value="{{ old('name', request()->name) }}"
                                placeholder="Cari..">
                            <i class="ti ti-search position-absolute top-50 translate-middle-y fs-6 text-dark ms-3"></i>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="d-flex justify-content-end">
                    <button type="button" style="background-color: #175A95;" class="btn btn-mdx text-white px-5"
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
    </div>


    <div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="tambahdataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahdataLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('faq.store.admin') }}" method="post">
                    @method('post')
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="question" class="form-label">Pertanyaan:</label>
                            <textarea id="question" name="question" value="{{ old('question') }}" placeholder="Question"
                                class="form-control @error('question') is-invalid @enderror" style="resize: none"></textarea>
                            @error('question')
                                <span class="invalid-feedback" role="alert" style="color: red;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="answer" class="form-label">Jawaban:</label>
                            <textarea id="answer" name="answer" value="{{ old('answer') }}" placeholder="Answer"
                                class="form-control @error('answer') is-invalid @enderror" style="resize: none"></textarea>
                            @error('answer')
                                <span class="invalid-feedback" role="alert" style="color: red;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-rounded btn-light-danger text-danger"
                            data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-rounded btn-light-success text-success">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="table-responsive rounded-2">
        <table class="table border text-nowrap customize-table mb-0 align-middle ">
            <thead>
                <tr>
                    <th style="background-color: #D9D9D9;">No</th>
                    <th style="background-color: #D9D9D9;">Pertanyaan</th>
                    <th style="background-color: #D9D9D9;">Jawaban</th>
                    <th style="background-color: #D9D9D9;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($faqs as $faq)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $faq->question }}</td>
                        <td>{{ $faq->answer }}</td>
                        <td>
                            {{-- <button type="button" class="btn btn-sm text-white btn-edit me-2"
                        style="background-color: #FFD643;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24"><path fill="#ffffff" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h8.925l-2 2H5v14h14v-6.95l2-2V19q0 .825-.587 1.413T19 21zm4-6v-4.25l9.175-9.175q.3-.3.675-.45t.75-.15q.4 0 .763.15t.662.45L22.425 3q.275.3.425.663T23 4.4t-.137.738t-.438.662L13.25 15zM21.025 4.4l-1.4-1.4zM11 13h1.4l5.8-5.8l-.7-.7l-.725-.7L11 11.575zm6.5-6.5l-.725-.7zl.7.7z"/></svg>
                        </button> --}}
                            <button class="btn btn-sm me-2 btn-edit" style="background-color: #FFD643;" type="button"
                                data-question="{{ $faq->question }}" data-id="{{ $faq->id }}"
                                data-answer="{{ $faq->answer }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24">
                                    <path fill="#ffffff"
                                        d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h8.925l-2 2H5v14h14v-6.95l2-2V19q0 .825-.587 1.413T19 21zm4-6v-4.25l9.175-9.175q.3-.3.675-.45t.75-.15q.4 0 .763.15t.662.45L22.425 3q.275.3.425.663T23 4.4t-.137.738t-.438.662L13.25 15zM21.025 4.4l-1.4-1.4zM11 13h1.4l5.8-5.8l-.7-.7l-.725-.7L11 11.575zm6.5-6.5l-.725-.7zl.7.7z" />
                                </svg>
                            </button>
                            <button type="submit" style="background-color: #EF6E6E"
                                class="btn btn-sm text-white btn-delete" data-id="{{ $faq->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24">
                                    <path fill="#ffffff"
                                        d="M7 21q-.825 0-1.412-.587T5 19V6q-.425 0-.712-.288T4 5t.288-.712T5 4h4q0-.425.288-.712T10 3h4q.425 0 .713.288T15 4h4q.425 0 .713.288T20 5t-.288.713T19 6v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zm-7 11q.425 0 .713-.288T11 16V9q0-.425-.288-.712T10 8t-.712.288T9 9v7q0 .425.288.713T10 17m4 0q.425 0 .713-.288T15 16V9q0-.425-.288-.712T14 8t-.712.288T13 9v7q0 .425.288.713T14 17M7 6v13z" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center align-middle" colspan="100%">
                            Belum ada data
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            <x-paginatoradmin :paginator="$faqs" />
        </div>
    </div>


    <!-- Edit Modal -->
    <div class="modal fade" id="modal-update" tabindex="-1" aria-labelledby="tambahdataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal content -->
                <div class="modal-header">
                    <h3 class="modal-title">Edit data faq</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <form id="form-update" method="post">
                    @method('put')
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="question" class="form-label">Question:</label>
                            <textarea name="question" class="form-control @error('question') is-invalid @enderror" value="{{ old('question') }}"
                                id="question-update" placeholder="{{ old('question') }}">
                            </textarea>
                            @error('question')
                                <span class="invalid-feedback" role="alert" style="color: red;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="answer" class="form-label">Answer:</label>
                            <textarea name="answer" value="{{ old('answer') }}" class="form-control @error('answer') is-invalid @enderror"
                                id="answer-update" placeholder="Answer">
                            </textarea>
                            @error('answer')
                                <span class="invalid-feedback" role="alert" style="color: red;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
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
            var question = $(this).data('question');
            var answer = $(this).data('answer');
            $('#form-update').attr('action', '/faq-list/' + id);
            $('#question-update').val(question);
            $('#answer-update').val(answer);
            console.log(id);
            $('#modal-update').modal('show');
        });

        $('.btn-delete').on('click', function() {
            var id = $(this).data('id');
            $('#form-delete').attr('action', '/faq-list/' + id);
            console.log(id);
            $('#modal-delete').modal('show');
        });
    </script>
@endsection
