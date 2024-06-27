@extends('layouts.admin.app')

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

<head>
    <title>Admin | Notification-List</title>
</head>

@section('content')
<div>
    <ul class="nav nav-underline" id="myTab" role="tablist">
        <li class="nav-item ms-2">
            <a class="nav-link active" id="artikel-tab" style="padding-right: 15px; padding-left: 15px;" data-bs-toggle="tab" href="#artikel" role="tab"
                aria-controls="artikel">
                <span>artikel</span>
            </a>
        </li>
        <li class="nav-item ms-2">
            <a class="nav-link" id="komentar-tab" style="padding-right: 15px; padding-left: 15px;" data-bs-toggle="tab" href="#komentar" role="tab"
                aria-controls="komentar">
                <span>Komentar</span>
            </a>
        </li>
    </ul>
</div>

<div class="tab-content tabcontent-border p-3" id="myTabContent">
    <div role="tabpanel" class="tab-pane fade show active" id="artikel" aria-labelledby="active-tab">
        <div class="table-responsive rounded-2">
            <table class="table border text-nowrap customize-table mb-0 align-middle ">
                <thead>
                    <tr>
                        <th style="background-color: #D9D9D9;">Pelapor</th>
                        <th style="background-color: #D9D9D9;">Dilaporkan</th>
                        <th style="background-color: #D9D9D9;">Isi Laporan</th>
                        <th style="background-color: #D9D9D9;">Bukti</th>
                        <th style="background-color: #D9D9D9;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($articles as $article)
                        <tr>
                            <td>
                                @if ($article->user && $article->user->image != null && Storage::disk('public')->exists($article->user->image))
                                    <img src="{{ asset('storage/'. $article->user->image)}}" class="rounded-circle me-2 user-profile" style="object-fit: cover" width="35" height="35" alt="" />
                                @else
                                    <img src="{{ asset('default.png') }}" class="rounded-circle me-2 user-profile" style="object-fit: cover" width="35" height="35" alt="" />
                                @endif

                                @if ($article->user)
                                    {{ $article->user->name }}
                                @else
                                    Guest
                                @endif
                            </td>
                            <td>
                                @if ($article->news->image != null && Storage::disk('public')->exists($article->news->image))
                                <img src="{{ asset('storage/' . $article->news->image) }}" width="100px"
                                    height="90px" class="w-100" style="width: 100%; object-fit:cover;" />
                                @else
                                <img src="{{ asset('assets/blank-img.jpg') }}" width="100px"
                                    height="90px" class="w-100" style="width: 100%; object-fit:cover;" />
                                @endif
                            </td>
                            <td>{{ Str::limit($article->description, 20, '...') }}</td>
                            <td>
                                @if ($article->proof != null && Storage::disk('public')->exists($article->proof))
                                <img src="{{ asset('storage/' . $article->proof) }}" width="100px"
                                    height="90px" class="w-100" style="width: 100%; object-fit:cover;" />
                                @else
                                <img src="{{ asset('assets/blank-img.jpg') }}" width="100px"
                                    height="90px" class="w-100" style="width: 100%; object-fit:cover;" />
                                @endif
                            </td>
                            <td>
                                <button data-bs-toggle="tooltip" title="Detail" class="btn btn-sm btn-detail-article btn-primary me-2" style="background-color:#5D87FF"
                                    data-id="{{ $article->id }}"
                                    data-name-user-article="{{ $article->user->name }}"
                                    data-email-user-article="{{ $article->user->email }}"
                                    data-name-writer-article="{{ $article->news->user->name }}"
                                    data-email-writer-article="{{ $article->news->user->email }}"
                                    data-description-article="{{ $article->description }}"
                                    data-proof-detail="{{ $article->proof != null && Storage::disk('public')->exists($article->proof) ? asset('storage/' . $article->proof) : asset('assets/blank-img.jpg') }}"
                                    data-news-image="{{ $article->news->image != null && Storage::disk('public')->exists($article->news->image) ? asset('storage/' . $article->news->image) : asset('assets/blank-img.jpg') }}"
                                    data-news-category="{{ $article->news->newsCategories[0]->category->name }}"
                                    data-news-name="{{ Str::limit($article->news->name, 40, '...') }}"
                                    data-news-date="{{ \Carbon\Carbon::parse($article->news->date)->locale('id_ID')->isoFormat('D MMMM Y') }}"
                                    data-news-view="{{ $article->news->newsViews()->count() }}x dilihat"
                                    data-news-id="{{ $article->news_id }}"
                                    data-url="{{ route('news.singlepost', $article->news->slug) }}"
                                >
                                    <i><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M12 6.5a9.77 9.77 0 0 1 8.82 5.5c-1.65 3.37-5.02 5.5-8.82 5.5S4.83 15.37 3.18 12A9.77 9.77 0 0 1 12 6.5m0-2C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5m0 5a2.5 2.5 0 0 1 0 5a2.5 2.5 0 0 1 0-5m0-2c-2.48 0-4.5 2.02-4.5 4.5s2.02 4.5 4.5 4.5s4.5-2.02 4.5-4.5s-2.02-4.5-4.5-4.5" />
                                        </svg></i>
                                </button>

                                @if ($article->news->status == 'banned')
                                    <button data-id="{{ $article->news->id }}" data-bs-toggle="tooltip" title="Buka Banned" class="btn btn-sm btn-success btn-unbanned text-white me-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                            <path fill="#fff" d="M6.615 9H15V7q0-1.25-.875-2.125T12 4q-1.25 0-2.125.875T9 7H8q0-1.671 1.164-2.836T12 3q1.671 0 2.836 1.164T16 7v2h1.385q.666 0 1.14.475q.475.474.475 1.14v8.77q0 .666-.475 1.14q-.474.475-1.14.475H6.615q-.666 0-1.14-.475Q5 20.051 5 19.385v-8.77q0-.666.475-1.14Q5.949 9 6.615 9M12 16.5q.633 0 1.066-.434q.434-.433.434-1.066t-.434-1.066Q12.633 13.5 12 13.5t-1.066.434Q10.5 14.367 10.5 15t.434 1.066q.433.434 1.066.434" />
                                        </svg>  
                                    </button>
                                @else
                                    <button data-id="{{ $article->news->id }}" data-bs-toggle="tooltip" title="Banned" class="btn btn-sm btn-warning btn-banned text-white me-2">
                                        <svg width="25" height="25" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.4724 0.442445C16.0303 0.430664 20.5873 4.96838 20.5991 10.5263C20.6109 16.0841 16.0732 20.6411 10.5153 20.6529C4.95739 20.6647 0.400391 16.127 0.388609 10.5691C0.376827 5.01123 4.91455 0.454227 10.4724 0.442445ZM10.4767 2.46349C8.55672 2.46756 6.84011 3.07752 5.52879 4.19188L16.8706 15.4858C17.8782 14.0689 18.5819 12.3495 18.578 10.5305C18.5686 6.08424 14.923 2.45407 10.4767 2.46349ZM15.4589 16.9035L4.11705 5.60961C3.00826 6.92565 2.40559 8.64483 2.40966 10.5648C2.41908 15.0111 6.06468 18.6413 10.511 18.6319C12.431 18.6278 14.1476 18.0179 15.4589 16.9035Z" fill="white"/>
                                        </svg>    
                                    </button>
                                @endif
            
                                <button type="submit" style="background-color: #EF6E6E" class="btn btn-sm text-white btn-delete" data-id="{{ $article->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24">
                                        <path fill="#ffffff" d="M7 21q-.825 0-1.412-.587T5 19V6q-.425 0-.712-.288T4 5t.288-.712T5 4h4q0-.425.288-.712T10 3h4q.425 0 .713.288T15 4h4q.425 0 .713.288T20 5t-.288.713T19 6v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zm-7 11q.425 0 .713-.288T11 16V9q0-.425-.288-.712T10 8t-.712.288T9 9v7q0 .425.288.713T10 17m4 0q.425 0 .713-.288T15 16V9q0-.425-.288-.712T14 8t-.712.288T13 9v7q0 .425.288.713T14 17M7 6v13z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="text-center mt-5">
                                    <img src="{{ asset('assets/Empty-cuate.png') }}" alt="" width="200px">
                                    <p>Tidak ada berita</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="komentar" role="tabpanel" aria-labelledby="komentar-tab">
        <div class="table-responsive rounded-2">
            <table class="table border text-nowrap customize-table mb-0 align-middle ">
                <thead>
                    <tr>
                        <th style="background-color: #D9D9D9;">Pelapor</th>
                        <th style="background-color: #D9D9D9;">Dilaporkan</th>
                        <th style="background-color: #D9D9D9;">Isi Laporan</th>
                        <th style="background-color: #D9D9D9;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                   @forelse ($comments as $comment)
                        <tr>
                            <td>
                                @if ($comment->user->image != null && Storage::disk('public')->exists($comment->user->image))
                                <img src="{{ asset('storage/'. $comment->user->image)}}" class="rounded-circle me-2 user-profile" style="object-fit: cover" width="35" height="35" alt="" />
                                @else
                                    <img src="{{ asset('default.png') }}" class="rounded-circle me-2 user-profile" style="object-fit: cover" width="35" height="35" alt="" />
                                @endif
                                {{ $comment->user->name }}
                            </td>
                            <td>{{ Str::limit($comment->comment->description, 30, '...') }}</td>
                            <td>{{ Str::limit($comment->description, 40, '...') }}</td>
                            <td>
                                <button data-bs-toggle="tooltip" title="Detail" class="btn btn-sm btn-detail btn-primary me-2" style="background-color:#5D87FF"
                                    data-id="{{ $comment->id }}"
                                    data-name-user="{{ $comment->user->name }}"
                                    data-email-user="{{ $comment->user->email }}"
                                    data-comment="{{ $comment->comment->description }}"
                                    data-name-writer="{{ $comment->comment->user->name }}"
                                    data-email-writer="{{ $comment->comment->user->email }}"
                                    data-description="{{ $comment->description }}"
                                >
                                    <i><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M12 6.5a9.77 9.77 0 0 1 8.82 5.5c-1.65 3.37-5.02 5.5-8.82 5.5S4.83 15.37 3.18 12A9.77 9.77 0 0 1 12 6.5m0-2C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5m0 5a2.5 2.5 0 0 1 0 5a2.5 2.5 0 0 1 0-5m0-2c-2.48 0-4.5 2.02-4.5 4.5s2.02 4.5 4.5 4.5s4.5-2.02 4.5-4.5s-2.02-4.5-4.5-4.5" />
                                        </svg></i>
                                </button>
            
                                <button type="submit" style="background-color: #EF6E6E" class="btn btn-sm text-white btn-delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24">
                                        <path fill="#ffffff" d="M7 21q-.825 0-1.412-.587T5 19V6q-.425 0-.712-.288T4 5t.288-.712T5 4h4q0-.425.288-.712T10 3h4q.425 0 .713.288T15 4h4q.425 0 .713.288T20 5t-.288.713T19 6v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zm-7 11q.425 0 .713-.288T11 16V9q0-.425-.288-.712T10 8t-.712.288T9 9v7q0 .425.288.713T10 17m4 0q.425 0 .713-.288T15 16V9q0-.425-.288-.712T14 8t-.712.288T13 9v7q0 .425.288.713T14 17M7 6v13z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                   @empty
                        <tr>
                            <td colspan="4">
                                <div class="text-center mt-5">
                                    <img src="{{ asset('assets/Empty-cuate.png') }}" alt="" width="200px">
                                    <p>Tidak ada berita</p>
                                </div>
                            </td>
                        </tr>
                   @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                
            </div>
        </div>
    </div>
</div>

{{-- delete modal start --}}
    <div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <form id="form-delete" method="POST" class="modal-content">
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
                    <button type="button" class="btn btn-light-danger text-danger font-medium waves-effect" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-light-danger text-secondery font-medium waves-effect" data-bs-dismiss="modal">
                        Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
{{-- delete modal end --}}

{{-- detail modal start --}}
<div class="modal fade" id="detail-modal-article" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content px-3">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail Laporan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-1">
                    <p class="text-muted mb-0">Pelapor:</p>
                    <h6 class="m-0" id="name-user-article"></h6>
                    <p class="mt-0" id="email-user-article"></p>
                </div>
                <div class="mb-1">
                    <p class="text-muted mb-0">Penulis artikel:</p>
                    <h6 class="m-0" id="name-writer-article"></h6>
                    <p class="mt-0" id="email-writer-article"></p>
                </div>
                <div class="mb-1">
                    <p class="text-muted mb-0">Artikel yang dilaporkan:</p>
                    <div class="card shadow-none border-1">
                        <div class="p-3">
                            <div class="row">
                                <div class="col-lg-2">
                                    <img id="news-image" width="80px" height="80px" style="object-fit: cover" alt="">
                                </div>
                                <div class="col-lg-6">
                                    <p id="news-category" style="color: #175A95; margin-bottom: 5px;"></p>
                                    <b id="news-name"></b>
                                    <div class="d-flex mt-3 gap-3">
                                        <div class="d-flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                                <path fill="#ef6e6e" d="M5 22q-.825 0-1.412-.587T3 20V6q0-.825.588-1.412T5 4h1V2h2v2h8V2h2v2h1q.825 0 1.413.588T21 6v14q0 .825-.587 1.413T19 22zm0-2h14V10H5zM5 8h14V6H5zm0 0V6z" /></svg>
                                            <span style="font-size: 13px;" class="ms-1" id="news-date"></span>
                                        </div>
                                        <div class="d-flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22" viewBox="0 0 24 24">
                                                <path fill="#ef6e6e" d="M12 6.5a9.77 9.77 0 0 1 8.82 5.5c-1.65 3.37-5.02 5.5-8.82 5.5S4.83 15.37 3.18 12A9.77 9.77 0 0 1 12 6.5m0-2C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5m0 5a2.5 2.5 0 0 1 0 5a2.5 2.5 0 0 1 0-5m0-2c-2.48 0-4.5 2.02-4.5 4.5s2.02 4.5 4.5 4.5s4.5-2.02 4.5-4.5s-2.02-4.5-4.5-4.5" /></svg>
                                            <span style="font-size: 13px;" class="ms-1" id="news-view"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-1">
                    <p class="text-muted mb-0">Isi laporan:</p>
                    <p id="description-article"></p>
                </div>
                <div class="mb-1">
                    <p class="text-muted mb-0">Bukti:</p>
                    <img id="proof-detail" class="w-100">
                </div>
            </div>
            <div class="modal-footer w-100 d-flex justify-content-between">
                <a id="download-proof" class=" btn btn-sm btn-light-primary text-primary text-start">Download bukti</a>
                <div class="gap-4">
                    <a id="url-article" class=" btn btn-sm btn-light-success text-success" target="_blank">Lihat artikel</a>
                    <button type="button" class=" btn btn-sm btn-light-danger text-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- detail modal end --}}

{{-- detail modal start --}}
<div class="modal fade" id="detail-modal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content px-3">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail Laporan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-1">
                    <p class="text-muted mb-0">Pelapor:</p>
                    <h6 class="m-0" id="name-user"></h6>
                    <p class="mt-0" id="email-user"></p>
                </div>
                <div class="mb-1">
                    <p class="text-muted mb-0">Komentar yang dilaporkan:</p>
                    <p id="comment"></p>
                </div>
                <div class="mb-1">
                    <p class="text-muted mb-0">Penulis komentar:</p>
                    <h6 class="m-0" id="name-writer"></h6>
                    <p class="mt-0" id="email-writer"></p>
                </div>
                <div class="mb-1">
                    <p class="text-muted mb-0">Isi laporan:</p>
                    <p id="description"></p>
                </div>
            </div>
            <div class="modal-footer w-100 d-flex justify-content-between">
                <a href="" class="btn btn-sm btn-light-success text-success">Lihat komentar</a>
                <div class="text-end gap-4">
                    <button class="btn btn-sm btn-light-warning btn-delete-comment text-warning me-2">Hapus komentar</button>
                    <button type="button" class="btn btn-sm btn-light-danger text-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- detail modal end --}}

{{-- banned confirm start --}}
<div class="modal fade" id="confirm-banned-modal" tabindex="-1" aria-labelledby="vertical-center-modal" aria-hidden="true">
    <div class="modal-dialog modal-sm">
    <div class="modal-content modal-filled bg-light-warning">
        <form id="banned-form" method="post">
            @csrf
            @method('PATCH')
            <div class="modal-body p-4">
                <div class="text-center text-warning">
                    <i class="ti ti-alert-octagon fs-7"></i>
                    <h4 class="mt-2">Konfirmasi banned</h4>
                    <p class="mt-3">
                        Apakah Anda yakin ingin membanned berita ini?
                    </p>
                    <button type="button" class="btn btn-light-danger text-danger my-2 me-2" data-bs-dismiss="modal">
                    Tidak
                    </button>
                    <button type="submit" class="btn btn-warning my-2 btn-banned-submit">
                    Yakin
                    </button>
                </div>
            </div>
        </form>
    </div>
    </div>
</div>
{{-- banned confirm end --}}

{{-- unbanned confirm start --}}
<div class="modal fade" id="confirm-unbanned-modal" tabindex="-1" aria-labelledby="vertical-center-modal" aria-hidden="true">
    <div class="modal-dialog modal-sm">
    <div class="modal-content modal-filled bg-light-success">
        <form id="unbanned-form" method="post">
            @csrf
            @method('PATCH')
            <div class="modal-body p-4">
                <div class="text-center text-success">
                    <i class="ti ti-alert-octagon fs-7"></i>
                    <h4 class="mt-2">Konfirmasi buka banned</h4>
                    <p class="mt-3">
                        Apakah Anda yakin ingin membuka banned berita ini?
                    </p>
                    <button type="button" class="btn btn-light-danger text-danger my-2 me-2" data-bs-dismiss="modal">
                    Tidak
                    </button>
                    <button type="submit" class="btn btn-success my-2 btn-unbanned-submit">
                    Yakin
                    </button>
                </div>
            </div>
        </form>
    </div>
    </div>
</div>
{{-- unbanned confirm end --}}
@endsection

@section('script')
    <script>
        $('.btn-delete').click(function() {
            var id = $(this).data('id');
            $('#form-delete').attr('action', '/news-report/'+id);
            $('#modal-delete').modal('show');
        });

        $('.btn-banned').click(function() {
            var id = $(this).data('id');
            $('#banned-form').attr('action', '/news/banned/'+id);
            $('#confirm-banned-modal').modal('show');
        });

        $('.btn-unbanned').click(function() {
            var id = $(this).data('id');
            $('#unbanned-form').attr('action', '/news/unbanned/'+id);
            $('#confirm-unbanned-modal').modal('show');
        });
    
        $('.btn-detail').click(function() {
            var id = $(this).data('id');
            var nameUser = $(this).data('name-user');
            var emailUser = $(this).data('email-user');
            var comment = $(this).data('comment');
            var nameWriter = $(this).data('name-writer');
            var emailWriter = $(this).data('email-writer');
            var description = $(this).data('description');

            $('#name-user').text(nameUser);
            $('#email-user').text(emailUser);
            $('#comment').text(comment);
            $('#name-writer').text(nameWriter);
            $('#email-writer').text(emailWriter);
            $('#description').text(description);
            $('#detail-modal').modal('show');
        });

        $('.btn-detail-article').click(function() {
            var id = $(this).data('id');
            var nameUser = $(this).data('name-user-article');
            var emailUser = $(this).data('email-user-article');
            var nameWriter = $(this).data('name-writer-article');
            var emailWriter = $(this).data('email-writer-article');
            var description = $(this).data('description-article');
            var proof = $(this).data('proof-detail');
            var button = $(this).data('button');

            var newsImage = $(this).data('news-image');
            var newsImageName = 'bukti-laporan-'+nameUser+'.png';
            var newsCategory = $(this).data('news-category');
            var newsName = $(this).data('news-name');
            var newsDate = $(this).data('news-date');
            var newsView = $(this).data('news-view');
            var newsUrl = $(this).data('url');
            var newsId = $(this).data('news-id');

            $('#name-user-article').text(nameUser);
            $('#email-user-article').text(emailUser);
            $('#name-writer-article').text(nameWriter);
            $('#email-writer-article').text(emailWriter);
            $('#description-article').text(description);
            $('#proof-detail').attr('src', proof);

            $('#news-image').attr('src', newsImage);
            $('#news-category').text(newsCategory);
            $('#news-name').text(newsName);
            $('#news-date').text(newsDate);
            $('#news-view').text(newsView);
            $('#url-article').attr('href', newsUrl);
            $('#download-proof').attr('href', newsImage);
            $('#download-proof').attr('download', newsImageName);
            
            $('#detail-article-btn').html(button);

            $('#detail-modal-article').modal('show');
        });
    </script>
@endsection