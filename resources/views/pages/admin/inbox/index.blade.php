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
                                @if ($article->user->image != null && Storage::disk('public')->exists($article->user->image))
                                    <img src="{{ asset('storage/'. $article->user->image)}}" class="rounded-circle me-2 user-profile" style="object-fit: cover" width="35" height="35" alt="" />
                                @else
                                    <img src="{{ asset('default.png') }}" class="rounded-circle me-2 user-profile" style="object-fit: cover" width="35" height="35" alt="" />
                                @endif
                                {{ $article->user->name }}
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
                                    data-button="{{ $article->news->status == 'banned' ? '<button class="btn btn-sm btn-light-warning btn-unbanned text-warning">Buka banned artikel</button>' : '<button class="btn btn-sm btn-light-warning btn-banned text-warning">Banned artikel</button>' }}"
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
                <a href="" class="btn btn-sm btn-light-primary text-primary text-start">Download bukti</a>
                <div class="text-end gap-4">
                    <a id="url-article" class="btn btn-sm btn-light-success text-success" target="_blank">Lihat artikel</a>
                    <div id="detail-article-btn">

                    </div>
                    <button type="button" class="btn btn-sm btn-light-danger text-danger" data-bs-dismiss="modal">Tutup</button>
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
                    <button type="button" class="btn btn-light my-2 me-2" data-bs-dismiss="modal">
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
@endsection

@section('script')
    <script>
        $('.btn-banned').click(function() {
            var id = $(this).data('id');
            $('#banned-form').attr('action', '/news/banned/'+id);
            $('#confirm-banned-modal').modal('show');
            $('#detail-modal-article').modal('hide');
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
            
            $('#detail-article-btn').html(button);

            $('.btn-banned').attr('data-id', newsId);

            $('#detail-modal-article').modal('show');
        });
    </script>
@endsection