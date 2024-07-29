@extends('layouts.user.app')

@section('title')
    {{ Str::limit($news->name, 20, '...') }}
@endsection

@section('seo')
<meta name="description" content="{{ Str::limit(strip_tags($news->description), 200) }}" />
<meta name="title" content="{{ $news->name }} - Get Media" />
<meta name="og:image" content="{{ asset('storage/' . $news->image) }}" />
<meta name="og:image:secure_url" content="{{ asset('storage/' . $news->image) }}" />
<meta name="og:image:type" content="image/jpeg" />
<meta property="og:image" content="{{ asset('storage/' . $news->image) }}" />
<meta property="og:image:alt" content="{{ $news->name }}" />
<meta property="og:url" content="{{ url('/') }}" />
<meta property="og:type" content="article" />
<link rel="canonical" href="{{ url('/') }}" />
@endsection

@section('style')
<style>
    .tag-list li a:hover {
        background-color: #175A95;
        color: var(--whiteColor);
    }

    .tag-list li a {
        color: var(--optionalColor);
        background-color: var(--whiteColor);
        border-radius: 5px;
        padding: 7px 15px 3px 17px;
        font-size: 14px;
        line-height: 30px;
        display: inline-block;
        border: 1px solid #eee;
    }

    .theme-dark .tag-list li a:hover {
        background-color: #175A95;
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: var(--whiteColor);
    }

    .breadcrumb-menu li:after {
        color: #000;
    }

    .read-more {
        color: blue;
        cursor: pointer;
        display: inline-block;
        margin-top: 10px;
    }

</style>

<style>
    #copy-tooltip {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: white;
        color: #1EBB9E;
        padding: 10px;
        border-radius: 5px;
        display: none;
        z-index: 1000;
    }

</style>

<style>
    @media only screen and (max-width: 767px) {
        .sidebar-widget {
            padding: 15px;
            width: 100%;
        }

        .news-card-three {
            display: flex;
            flex-direction: column;
            align-items: left;
        }

        .news-card-img img {
            width: 100%;
            height: auto;
        }

        .news-card-info h3 {
            font-size: 1.2em;
            text-align: left;
        }

        .news-metainfo {
            justify-content: left;
        }

        .news-metainfo li {
            margin-right: 15px;
            font-size: 0.9em;
        }

        .sidebar {
            width: 100%;
        }

        .sidebar-widget-title {
            font-size: 1.2em;
        }
    }

    @keyframes slideInLeft {
        0% {
            opacity: 0;
            -webkit-transform: translateX(-150px);
            -ms-transform: translateX(-150px);
            transform: translateX(-150px);
        }

        100% {
            -webkit-transform: translateX(0);
            -ms-transform: translateX(0);
            transform: translateX(0);
        }
    }

    .slideInLeft {
        -webkit-animation-name: slideInLeft;
        animation-name: slideInLeft;
    }

    @media (min-width: 1024px) {
        .iklan-top {
            height: 250px;
        }
    }

    .theme-dark .form-control {
        display: block;
        width: 100%;
        padding: .375rem .75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: var(--bs-body-color) !important;
        background-color: var(--bs-body-bg);
        background-clip: padding-box;
        border: var(--bs-border-width) solid var(--bs-border-color) !important;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        border-radius: var(--bs-border-radius);
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .theme-dark .form-control .edit-coment {
        color: #ffffff !important;
    }

</style>

@endsection

@section('content')

<div class="modal fade" id="modal-news-report" tabindex="-1" aria-labelledby="tambahdataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal content -->
            <div class="modal-header">
                <h3 class="modal-title text-dark">Laporkan Berita</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <form id="form-news-report" method="post" enctype="multipart/form-data">
                @method('post')
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="proof" class="form-label">Bukti:</label>
                        <input type="file" name="proof" class="form-control @error('proof') is-invalid @enderror">
                        @error('proof')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi laporan:</label>
                        <textarea name="description" style="height: 150px; resize: none" class="form-control @error('description') is-invalid @enderror" placeholder="Deskripsi laporan"></textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert" style="color: rgb(255, 0, 0);">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn text-dark px-3" style="background-color: #c9c9c9" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white px-4" style="background-color: #DD1818;">Laporkan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-comment-report" tabindex="-1" aria-labelledby="tambahdataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal content -->
            <div class="modal-header">
                <h3 class="modal-title text-dark">Laporkan Komentar</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <form id="form-comment-report" method="post">
                @method('post')
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi laporan:</label>
                        <textarea name="description" style="height: 150px; resize: none" class="form-control @error('description') is-invalid @enderror" placeholder="Deskripsi laporan"></textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn text-dark" style="background-color: #C9C9C9;" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white" style="background-color: #DD1818;">Laporkan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-delete-comment" tabindex="-1" aria-labelledby="tambahdataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal content -->
            <div class="modal-header">
                <h3 class="modal-title text-dark">Hapus Komentar</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <form id="form-delete-comment" method="post">
                @method('DELETE')
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Hapus komentar Anda secara permanen?</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn text-dark" style="background-color: #C9C9C9" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white" style="background-color: #DD1818">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="news-details-wrap">
    <div class="container mt-5">
        {{-- komentar1 --}}
        <div class="row gx-55 gx-5">
            <div class="col-lg-8">
                <article>
                    <div>
                        <h1 class="wow slideInLeft" data-wow-duration="2s">{{ $news->name }}</h1>
                        <p class="d-flex gap-1">Share :
                            <button class="wpbtn" style="background-color: transparent; border: none" title="Share to WhatsApp" onclick="shareToWhatsApp()">
                                <svg height="19" width="19" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 58 58" xml:space="preserve" fill="#000000">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <g>
                                            <path style="fill:#2CB742;" d="M0,58l4.988-14.963C2.457,38.78,1,33.812,1,28.5C1,12.76,13.76,0,29.5,0S58,12.76,58,28.5 S45.24,57,29.5,57c-4.789,0-9.299-1.187-13.26-3.273L0,58z"></path>
                                            <path style="fill:#FFFFFF;" d="M47.683,37.985c-1.316-2.487-6.169-5.331-6.169-5.331c-1.098-0.626-2.423-0.696-3.049,0.42 c0,0-1.577,1.891-1.978,2.163c-1.832,1.241-3.529,1.193-5.242-0.52l-3.981-3.981l-3.981-3.981c-1.713-1.713-1.761-3.41-0.52-5.242 c0.272-0.401,2.163-1.978,2.163-1.978c1.116-0.627,1.046-1.951,0.42-3.049c0,0-2.844-4.853-5.331-6.169 c-1.058-0.56-2.357-0.364-3.203,0.482l-1.758,1.758c-5.577,5.577-2.831,11.873,2.746,17.45l5.097,5.097l5.097,5.097 c5.577,5.577,11.873,8.323,17.45,2.746l1.758-1.758C48.048,40.341,48.243,39.042,47.683,37.985z"></path>
                                        </g>
                                    </g>
                                </svg>
                            </button>
                            <a id="fb" title="Share to Facebook" onclick="shareToFacebook()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 263 263">
                                    <path fill="#1877F2" d="M256 128C256 57.308 198.692 0 128 0C57.308 0 0 57.308 0 128c0 63.888 46.808 116.843 108 126.445V165H75.5v-37H108V99.8c0-32.08 19.11-49.8 48.348-49.8C170.352 50 185 52.5 185 52.5V84h-16.14C152.959 84 148 93.867 148 103.99V128h35.5l-5.675 37H148v89.445c61.192-9.602 108-62.556 108-126.445" />
                                    <path fill="#FFF" d="m177.825 165l5.675-37H148v-24.01C148 93.866 152.959 84 168.86 84H185V52.5S170.352 50 156.347 50C127.11 50 108 67.72 108 99.8V128H75.5v37H108v89.445A128.959 128.959 0 0 0 128 256a128.9 128.9 0 0 0 20-1.555V165z" />
                                </svg>
                            </a>
                            <a id="tw" class="logo" style="margin-top: 7px;" title="Share to Twitter" onclick="shareToTwitter()">
                                <svg class="logo-dark" style="margin-top: 1px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 14 14">
                                    <g fill="none">
                                        <g clip-path="url(#primeTwitter0)">
                                            <path fill="#ffffff" d="M11.025.656h2.147L8.482 6.03L14 13.344H9.68L6.294 8.909l-3.87 4.435H.275l5.016-5.75L0 .657h4.43L7.486 4.71zm-.755 11.4h1.19L3.78 1.877H2.504z" />
                                        </g>
                                        <defs>
                                            <clipPath id="primeTwitter0">
                                                <path fill="#fff" d="M0 0h14v14H0z" />
                                            </clipPath>
                                        </defs>
                                    </g>
                                </svg>
                                <svg class="logo-light" style="margin-top: 1px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 14 14">
                                    <g fill="none">
                                        <g clip-path="url(#primeTwitter0)">
                                            <path fill="#000000" d="M11.025.656h2.147L8.482 6.03L14 13.344H9.68L6.294 8.909l-3.87 4.435H.275l5.016-5.75L0 .657h4.43L7.486 4.71zm-.755 11.4h1.19L3.78 1.877H2.504z" />
                                        </g>
                                        <defs>
                                            <clipPath id="primeTwitter0">
                                                <path fill="#fff" d="M0 0h14v14H0z" />
                                            </clipPath>
                                        </defs>
                                    </g>
                                </svg>
                            </a>
                            <a id="tele" title="Share to Telegram" onclick="shareToTelegram()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 263 263">
                                    <defs>
                                        <linearGradient id="logosTelegram0" x1="50%" x2="50%" y1="0%" y2="100%">
                                            <stop offset="0%" stop-color="#2AABEE" />
                                            <stop offset="100%" stop-color="#229ED9" />
                                        </linearGradient>
                                    </defs>
                                    <path fill="url(#logosTelegram0)" d="M128 0C94.06 0 61.48 13.494 37.5 37.49A128.038 128.038 0 0 0 0 128c0 33.934 13.5 66.514 37.5 90.51C61.48 242.506 94.06 256 128 256s66.52-13.494 90.5-37.49c24-23.996 37.5-56.576 37.5-90.51c0-33.934-13.5-66.514-37.5-90.51C194.52 13.494 161.94 0 128 0" />
                                    <path fill="#FFF" d="M57.94 126.648c37.32-16.256 62.2-26.974 74.64-32.152c35.56-14.786 42.94-17.354 47.76-17.441c1.06-.017 3.42.245 4.96 1.49c1.28 1.05 1.64 2.47 1.82 3.467c.16.996.38 3.266.2 5.038c-1.92 20.24-10.26 69.356-14.5 92.026c-1.78 9.592-5.32 12.808-8.74 13.122c-7.44.684-13.08-4.912-20.28-9.63c-11.26-7.386-17.62-11.982-28.56-19.188c-12.64-8.328-4.44-12.906 2.76-20.386c1.88-1.958 34.64-31.748 35.26-34.45c.08-.338.16-1.598-.6-2.262c-.74-.666-1.84-.438-2.64-.258c-1.14.256-19.12 12.152-54 35.686c-5.1 3.508-9.72 5.218-13.88 5.128c-4.56-.098-13.36-2.584-19.9-4.708c-8-2.606-14.38-3.984-13.82-8.41c.28-2.304 3.46-4.662 9.52-7.072" />
                                </svg>
                            </a>
                            <a id="copylink" tooltip="Salin Link" style="margin-top: 6px; position: relative;">
                                <span style="border-radius: 50%; background-color: #cccccc" class="d-flex justify-content-center p-1 copyLink" onclick="copyToClipboard()" id="copy">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 256 256">
                                        <path fill="#292929" d="M240 88.23a54.43 54.43 0 0 1-16 37L189.25 160a54.27 54.27 0 0 1-38.63 16h-.05A54.63 54.63 0 0 1 96 119.84a8 8 0 0 1 16 .45A38.62 38.62 0 0 0 150.58 160a38.4 38.4 0 0 0 27.31-11.31l34.75-34.75a38.63 38.63 0 0 0-54.63-54.63l-11 11A8 8 0 0 1 135.7 59l11-11a54.65 54.65 0 0 1 77.3 0a54.86 54.86 0 0 1 16 40.23m-131 97.43l-11 11A38.4 38.4 0 0 1 70.6 208a38.63 38.63 0 0 1-27.29-65.94L78 107.31a38.63 38.63 0 0 1 66 28.4a8 8 0 0 0 16 .45A54.86 54.86 0 0 0 144 96a54.65 54.65 0 0 0-77.27 0L32 130.75A54.62 54.62 0 0 0 70.56 224a54.28 54.28 0 0 0 38.64-16l11-11a8 8 0 0 0-11.2-11.34" />
                                    </svg>
                                </span>
                                <div id="copy-tooltip">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="m9.55 18l-5.7-5.7l1.425-1.425L9.55 15.15l9.175-9.175L20.15 7.4z" />
                                    </svg>
                                    Berhasil disalin
                                </div>
                            </a>
                        </p>
                    </div>

                    <div class="news-img">
                        <img src="{{ asset('storage/' . $news->image) }}" width="100%" height="470" style="object-fit: cover" alt="Image">
                        <a href="/{{ $news->newsCategories[0]->category->name }}" class="news-cat">{{ $news->newsCategories[0]->category->name }}</a>
                    </div>
                    <div>
                        <ul class="news-metainfo list-style">
                            <div class="d-flex justify-content-between">
                                <div class="col-lg-11 col-md-11">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-3 mb-3">
                                            <li class="author d-flex align-items-center justify-content-between w-100">
                                                <div class="d-flex align-items-center">
                                                    <span class="author-img">
                                                        @if (isset($news->user) && isset($news->user->author))
                                                        <a href="{{ route('author.detail', ['author' => $news->user->slug]) }}">
                                                            <img src="{{ asset($news->user->photo ? 'storage/' . $news->user->photo : 'default.png') }}" alt="Image" width="40px" height="30px" style="border-radius: 50%; object-fit:cover;" />
                                                        </a>
                                                        @else
                                                        <img src="{{ asset('default.png') }}" alt="Image" width="40px" height="30px" style="border-radius: 50%; object-fit:cover;" />
                                                        @endif
                                                    </span>
                                                    <div class="ml-2">
                                                        @if ($news->user->hasRole('admin'))
                                                        <a class="ms-3" style="display: inline; text-decoration: none" data-toggle="tooltip" data-placement="top" title="admin" href="#">{{ $news->user->name }}</a>
                                                        @else
                                                        <a class="ms-4" style="display: inline; text-decoration: none" data-toggle="tooltip" data-placement="top" title="author - {{ $news->user->name }}" href="{{ route('author.detail', ['author' => $news->user->slug]) }}">{{ $news->user->name }}</a>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="d-md-none">
                                                    <button style="border: none; background-color: #FFFFFF;" class="btn-news-report" type="button" data-id="{{ $news->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a5 5 0 0 1 7 0a5 5 0 0 0 7 0v9a5 5 0 0 1-7 0a5 5 0 0 0-7 0zm0 16v-7" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </li>
                                        </div>

                                        <div class="col-md-12 col-sm-12 col-lg-9">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <li class="mr-4"><i class="fi fi-rr-calendar-minus"></i>
                                                    <span id="formattedDate" class="font-date">{{ \Carbon\Carbon::parse($news->created_at)->translatedFormat('d F Y') }}</span>
                                                </li>
                                                <li class="mr-4">
                                                    <i class="fi fi-rr-eye" style="margin-top: 2px;"></i>
                                                    <span>{{ $news->news_views_count }}x dilihat</span>
                                                </li>
                                                <li class="d-flex align-items-center">

                                                    <form id="form-like">
                                                        @csrf
                                                        <button type="submit" style="background: transparent;border:transparent" class="like btn-like">
                                                            <svg class="last mb-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                                                <path fill="#E93314" d="M18 21H7V8l7-7l1.25 1.25q.175.175.288.475t.112.575v.35L14.55 8H21q.8 0 1.4.6T23 10v2q0 .175-.05.375t-.1.375l-3 7.05q-.225.5-.75.85T18 21m-9-2h9l3-7v-2h-9l1.35-5.5L9 8.85zM9 8.85V19zM7 8v2H4v9h3v2H2V8z" />
                                                            </svg>
                                                        </button>
                                                    </form>

                                                    <form id="form-liked" style="display: none;">
                                                        @csrf
                                                        <button type="button" style="background: transparent;border:transparent" class="liked btn-liked">
                                                            <svg class="last mb-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                                                <path fill="red" d="M18 21H8V8l7-7l1.25 1.25q.175.175.288.475t.112.575v.35L15.55 8H21q.8 0 1.4.6T23 10v2q0 .175-.037.375t-.113.375l-3 7.05q-.225.5-.75.85T18 21M6 8v13H2V8z" />
                                                            </svg>
                                                        </button>
                                                    </form>

                                                    <span id="like" data-like="{{ $likes }}">{{ $likes }}</span>
                                                </li>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1 col-sm-1 col-lg-1 d-none d-md-flex align-items-center justify-content-end mb-3">
                                    <button style="border: none;" class="btn-news-report bg-transparent" type="button" data-id="{{ $news->id }}">
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a5 5 0 0 1 7 0a5 5 0 0 0 7 0v9a5 5 0 0 1-7 0a5 5 0 0 0-7 0zm0 16v-7" />
                                            </svg>
                                        </li>
                                    </button>
                                </div>
                            </div>
                        </ul>
                    </div>

                    <div class="news-para">
                        @php
                            $paragraphs = explode('</p>', $news->description);
                            $insertAt = ceil(count($paragraphs) / 3);
                        @endphp

                        @foreach ($paragraphs as $index => $paragraph)
                            {!! $paragraph !!}
                            @if ($index == $insertAt)
                                <div class="related-news">
                                    <blockquote class="quote-box">
                                        <img src="{{ asset('CONTOHIKLAN.png') }}" alt="">
                                    </blockquote>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <p> Tag :
                        @forelse ($newsTags as $tag)
                        <a data-toggle="tooltip" data-placement="top" title="{{ $tag->tags->name }}" href="{{ route('news-tag-list.user', ['tag' => $tag->tags->slug]) }}" class="btn btn-rounded btn-outline-primary">{{ $tag->tags->name }}</a>
                        @empty
                        @endforelse
                    </p>
                </article>

                <div id="cmt-form">
                    @auth
                    <div class="mb-30">
                        <h3 class="comment-box-title">Tinggalkan Komentar</h3>
                    </div>
                    <form action="{{ route('comment.create', ['news' => $news->id]) }}" class="comment-form" method="POST">
                        @method('post')
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <textarea name="description" id="messages" cols="30" rows="10" placeholder="Tinggalkan komentar"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12 mt-1 d-flex justify-content-end">
                                <button type="submit" class="btn-two">Komentar</button>
                            </div>
                        </div>
                    </form>
                    @else
                    <div class="mb-30">
                        <h3 class="comment-box-title">Tinggalkan Komentar</h3>
                    </div>
                    <form action="{{ route('comment.create', ['news' => $news->id]) }}" class="comment-form" method="POST">
                        @method('post')
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="name" id="name" required placeholder="Nama">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" name="email" id="email" required placeholder="Alamat Email*">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <textarea name="description" id="messages" cols="30" rows="10" placeholder="Tinggalkan komentar"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12 mt-1 d-flex justify-content-end">
                                <button type="submit" class="btn-two">Komentar</button>
                            </div>
                        </div>
                    </form>
                    @endauth
                </div>

                <h3 class="comment-box-title mt-5">{{ $news->comments_count }} Komentar</h3>
                <div class="comment-item-wrap mb-5">
                    @php
                    $groupedReplies = [];
                    foreach ($comments as $comment) {
                    if ($comment->parent_id) {
                    $parentId = $comment->parent_id;
                    if (!isset($groupedReplies[$parentId])) {
                    $groupedReplies[$parentId] = [];
                    }
                    $groupedReplies[$parentId][] = $comment;
                    }
                    }
                    @endphp

                    @forelse ($comments as $comment)
                    @if ($comment->parent_id === null)
                    <div class="comment-item">
                        <div class="comment-author-img">
                            <img src="
                                    @if ($comment->user_id != null) {{ asset($comment->user->image ? 'storage/' . $comment->user->image : 'default.png') }}
                                    @else
                                        {{ asset('default.png') }} @endif
                                " alt="Image">
                        </div>
                        <div class="comment-author-wrap">
                            <div class="comment-author-info">
                                <div class="row align-items-start">
                                    <div class="col-md-9 col-sm-12 col-12 order-md-1 order-sm-1 order-1">
                                        <div class="comment-author-name">
                                            @if ($comment->user != null)
                                            <h5>{{ $comment->user->name }}</h5>
                                            @else
                                            <h5>{{ $comment->name }}</h5>
                                            @endif
                                            <span class="comment-date">{{ $comment->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-3 col-3 text-md-end order-md-1 order-sm-1 order-1">
                                        <a class="" href="javascript:void(0)" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24">
                                                <path fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="3" d="M12 12h.01v.01H12zm0-7h.01v.01H12zm0 14h.01v.01H12z" />
                                            </svg>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                @auth
                                                @if ($comment->user_id == auth()->user()->id && $comment->ip_address == $ipAddress)
                                                <li>
                                                    <button class="btn btn-sm btn-edit-comment" data-id="{{ $comment->id }}" data-description="{{ $comment->description }}">
                                                        Edit
                                                    </button>
                                                </li>
                                                <li>
                                                    <button class="btn btn-sm btn-comment-delete" data-id="{{ $comment->id }}">
                                                        Hapus
                                                    </button>
                                                </li>
                                                @endif
                                                @if ($comment->user_id != auth()->user()->id)
                                                <li>
                                                    <button class="btn btn-sm btn-comment-report" data-id="{{ $comment->id }}">
                                                        Laporkan
                                                    </button>
                                                </li>
                                                @endif
                                                @if ($news->user_id == auth()->user()->id)
                                                <li>
                                                    <button class="btn btn-sm btn-comment-delete" data-id="{{ $comment->id }}">
                                                        Hapus
                                                    </button>
                                                </li>
                                                @endif
                                                @else
                                                @if ($comment->user_id == null && $comment->ip_address == $ipAddress)
                                                <li>
                                                    <button class="btn btn-sm btn-edit-comment" data-id="{{ $comment->id }}" data-description="{{ $comment->description }}">
                                                        Edit
                                                    </button>
                                                </li>
                                                <li>
                                                    <button class="btn btn-sm btn-comment-delete" data-id="{{ $comment->id }}">
                                                        Hapus
                                                    </button>
                                                </li>
                                                @endif
                                                @if (!empty($comment->user_id))
                                                <li>
                                                    <button class="btn btn-sm btn-comment-report" data-id="{{ $comment->id }}">
                                                        Laporkan
                                                    </button>
                                                </li>
                                                @endif
                                                @endauth
                                            </ul>
                                        </a>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-12 order-md-3 order-sm-3 order-3">
                                        <div class="comment-text">
                                            <p>{{ $comment->description }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-12 text-md-start order-md-3 order-sm-3 order-3">
                                        <a href="avascript:void(0)" class="reply-btn" onclick="showReplyForm({{ $comment->id }})">Balas</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="edit-form-{{ $comment->id }}" class="reply-form mt-3 mb-3" style="display: none;">
                            <form id="form-edit-{{ $comment->id }}" method="post">
                                @method('put')
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12 mt-2">
                                        <textarea name="description" id="update-description-{{ $comment->id }}" class="form-control mb-2 edit-coment" cols="100" rows="2" placeholder="Balas Komentar" style="resize: none; colo"></textarea>
                                    </div>
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn-two w-40 btn-cancel-edit" data-id="{{ $comment->id }}" style="background-color: #0F4D8A;padding:10px !important">Batal</button>
                                    <button type="submit" class="btn-two w-100 btn" style="background-color: #0F4D8A;padding:10px !important">Edit
                                        Komentar</button>
                                </div>
                            </form>
                        </div>

                        <div id="reply-form-{{ $comment->id }}" class="reply-form mt-3" style="display: none;">
                            <form action="{{ route('reply.create', ['news' => $news->id, 'comment' => $comment->id]) }}" method="post">
                                @method('post')
                                @csrf
                                <div class="row">
                                    @auth
                                    <div class="col-lg-12 mt-2">
                                        <textarea name="description" class="form-control mb-2" cols="100" rows="2" placeholder="Balas Komentar" style="resize: none"></textarea>
                                    </div>
                                    @else
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="name" id="name" required placeholder="Nama">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control" name="email" id="email" required placeholder="Alamat Email*">
                                    </div>
                                    <div class="col-lg-12 mt-2">
                                        <textarea name="description" class="form-control mb-2" cols="100" rows="2" placeholder="Balas Komentar" style="resize: none"></textarea>
                                    </div>
                                    @endauth
                                </div>
                                <div>
                                    <button type="submit" class="btn-two w-100 btn" style="background-color: #0F4D8A;padding:10px !important">Kirim
                                        Balasan</button>
                                </div>
                            </form>
                        </div>


                        @foreach ($groupedReplies[$comment->id] ?? [] as $index => $reply)
                        <div class="comment-item reply">
                            <div class="comment-author-img">
                                <img src="
                                            @if ($reply->user_id != null) {{ asset($reply->user->image ? 'storage/' . $reply->user->image : 'default.png') }}
                                            @else
                                                {{ asset('default.png') }} @endif
                                            " alt="Image">
                            </div>
                            <div class="comment-author-wrap">
                                <div class="comment-author-info">
                                    <div class="row align-items-start">
                                        <div class="col-md-9 col-sm-12 col-12 order-md-1 order-sm-1 order-1">
                                            <div class="comment-author-name">
                                                @if ($reply->user != null)
                                                <h5>{{ $reply->user->name }}</h5>
                                                @else
                                                <h5>{{ $reply->name }}</h5>
                                                @endif
                                                <span class="comment-date">{{ $reply->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-3 text-md-end order-md-1 order-sm-1 order-1">
                                            <a class="" href="javascript:void(0)" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24">
                                                    <path fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="3" d="M12 12h.01v.01H12zm0-7h.01v.01H12zm0 14h.01v.01H12z" />
                                                </svg>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    @auth
                                                    @if ($reply->user_id == auth()->user()->id && $reply->ip_address == $ipAddress)
                                                    <li>
                                                        <button class="btn btn-sm btn-edit-comment" data-id="{{ $reply->id }}" data-description="{{ $reply->description }}">
                                                            Edit
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button class="btn btn-sm btn-comment-delete" data-id="{{ $reply->id }}">
                                                            Hapus
                                                        </button>
                                                    </li>
                                                    @endif
                                                    @if ($reply->user_id != auth()->user()->id)
                                                    <li>
                                                        <button class="btn btn-sm btn-comment-report" data-id="{{ $reply->id }}">
                                                            Laporkan
                                                        </button>
                                                    </li>
                                                    @endif
                                                    @if ($news->user_id == auth()->user()->id)
                                                    <li>
                                                        <button class="btn btn-sm btn-comment-delete" data-id="{{ $comment->id }}">
                                                            Hapus
                                                        </button>
                                                    </li>
                                                    @endif
                                                    @else
                                                    @if ($reply->user_id == null && $reply->ip_address == $ipAddress)
                                                    <li>
                                                        <button class="btn btn-sm btn-edit-comment" data-id="{{ $reply->id }}" data-description="{{ $reply->description }}">
                                                            Edit
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button class="btn btn-sm btn-comment-delete" data-id="{{ $reply->id }}">
                                                            Hapus
                                                        </button>
                                                    </li>
                                                    @endif
                                                    @if (!empty($reply->user_id))
                                                    <li>
                                                        <button class="btn btn-sm btn-comment-report" data-id="{{ $reply->id }}">
                                                            Laporkan
                                                        </button>
                                                    </li>
                                                    @endif
                                                    @endauth
                                                </ul>
                                            </a>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-12 order-md-3 order-sm-3 order-3">
                                            <div class="comment-text">
                                                <p>{{ $reply->description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="edit-reply-{{ $reply->id }}" class="reply-form mt-3 mb-3" style="display: none;">
                            <form id="reply-edit-{{ $reply->id }}" method="post">
                                @method('put')
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12 mt-2">
                                        <textarea name="description" id="update-reply-description-{{ $reply->id }}" class="form-control mb-2" cols="100" rows="2" placeholder="Balas Komentar" style="resize: none"></textarea>
                                    </div>
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn-two w-40 btn-cancel-reply-edit" data-id="{{ $reply->id }}" style="background-color: #0F4D8A;padding:10px !important">Batal</button>
                                    <button type="submit" class="btn-two w-100 btn" style="background-color: #0F4D8A;padding:10px !important">Edit
                                        Komentar</button>
                                </div>
                            </form>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    @empty
                    @endforelse
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sidebar">
                    <div class="sidebar-widget" id="popular-categories">
                        <h3 class="sidebar-widget-title">Kategori Populer</h3>
                        <ul class="category-widget list-style">
                            @foreach ($CategoryPopulars as $category)
                            <li>
                                <a data-toggle="tooltip" data-placement="top" title="{{ $category->name }}" href="{{ route('categories.show.user', ['category' => $category->slug]) }}">
                                    <img src="{{ asset('assets/img/icons/arrow-right.svg') }}" alt="Image">{{ $category->name }}
                                    <span>({{ $category->news_categories_count }})</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="sidebar-widget" id="popular-tags">
                        <h3 class="sidebar-widget-title">Tag Populer</h3>
                        <ul class="tag-list list-style">
                            @forelse ($popularTags as $popularTag)
                            <li><a href="{{ route('news-tag-list.user', ['tag' => $popularTag->slug]) }}">{{ $popularTag->name }}</a>
                            </li>
                            @empty
                            @endforelse
                        </ul>
                    </div>
                    {{-- komentar2 --}}
                </div>
            </div>
        </div>

        <div class="modal fade" id="quickview-modal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="quickview-modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <button type="button" class="btn_close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ri-close-line"></i>
                    </button>
                    <div class="modal-body">
                        <div class="video-popup">
                            <iframe width="885" height="498" {{-- src="https://www.youtube.com/embed/3FjT7etqxt8" --}} title="How to Design an Elvis Movie Poster in Photoshop" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="share" tabindex="-1" aria-labelledby="tambahdataLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahdataLabel"><span style="color: #0F4D8A; font-size: 25px;" class="mb-2 me-1"></span>Bagikan
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="mb-3 form-group">
                                <label for="message" class="form-label fw-bold">Url</label>
                                <div class="shareLink">
                                </div>
                                @error('message')
                                <span class="invalid-feedback" role="alert" style="color: red;">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mt-3">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('script')
    <script>
        $(document).ready(function() {
            var likedByUser = @json($likedByUser);
            var formLike = $('#form-like');
            var formLiked = $('#form-liked');
            var btnLike = $('.btn-like');
            var btnUnlike = $('.btn-liked');
            var likeCount = $('#like');
            var likeData = parseInt(likeCount.data('like'));
            var isProcessing = false;

            if (likedByUser) {
                formLike.hide();
                formLiked.show();
            } else {
                formLike.show();
                formLiked.hide();
            }

            btnLike.on('click', function(event) {
                event.preventDefault();
                if (isProcessing) return;
                isProcessing = true;
                var csrfToken = formLike.find('input[name="_token"]').val();

                $.ajax({
                    url: '/like-news/{{ $news_id }}'
                    , type: 'POST'
                    , contentType: 'application/json'
                    , headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                    , success: function(data) {
                        formLike.hide();
                        formLiked.show();
                        likeData++;
                        likeCount.html(likeData);
                        likeCount.data('like', likeData);
                    }
                    , error: function(xhr) {
                        console.error('Error: ' + xhr.status);
                    }
                    , complete: function() {
                        isProcessing = false;
                    }
                });
            });

            btnUnlike.on('click', function(event) {
                event.preventDefault();
                if (isProcessing) return;
                isProcessing = true;
                var csrfToken = formLiked.find('input[name="_token"]').val();

                $.ajax({
                    url: '/unlike-news/{{ $news_id }}'
                    , type: 'DELETE'
                    , contentType: 'application/json'
                    , headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                    , success: function(data) {
                        formLike.show();
                        formLiked.hide();
                        likeData--;
                        likeCount.html(likeData);
                        likeCount.data('like', likeData);
                    }
                    , error: function(xhr) {
                        console.error('Error: ' + xhr.status);
                    }
                    , complete: function() {
                        isProcessing = false; // Re-enable the buttons
                    }
                });
            });
        });

    </script>

    <script>
        $('.btn-news-report').on('click', function() {
            var id = $(this).data('id');
            $('#form-news-report').attr('action', '/news-report/' + id);
            $('#modal-news-report').modal('show');
        });

        $('.btn-comment-report').on('click', function() {
            var id = $(this).data('id');
            $('#form-comment-report').attr('action', '/comment-report/' + id);
            $('#modal-comment-report').modal('show');
        });

        $('.btn-comment-delete').on('click', function() {
            var id = $(this).data('id');
            $('#form-delete-comment').attr('action', '/delete-comment/' + id);
            $('#modal-delete-comment').modal('show');
        });

        $('.btn-edit-comment').on('click', function() {
            var id = $(this).data('id');
            var description = $(this).data('description');
            $('#form-edit-' + id).attr('action', '/update-comment/' + id);
            $('#update-description-' + id).val(description);
            $('#edit-form-' + id).show();
        });

        $('.btn-cancel-edit').on('click', function() {
            var id = $(this).data('id');
            $('#edit-form-' + id).hide();
        });

        $('.btn-edit-reply').on('click', function() {
            var id = $(this).data('id');
            var description = $(this).data('description');
            $('#reply-edit-' + id).attr('action', '/update-comment/' + id);
            $('#update-reply-description-' + id).val(description);
            $('#edit-reply-' + id).show();
        });

        $('.btn-cancel-reply-edit').on('click', function() {
            var id = $(this).data('id');
            $('#edit-reply-' + id).hide();
        });

    </script>

    <script>
        function showReplyForm(commentId) {
            var replyForm = document.getElementById('reply-form-' + commentId);
            replyForm.style.display = replyForm.style.display === 'none' ? 'flex' : 'none';
        }

    </script>
    <script>
        function copyToClipboard() {
            const url = window.location.href;
            navigator.clipboard.writeText(url).then(function() {
                const tooltip = document.getElementById('copy-tooltip');
                tooltip.style.display = 'block';
                setTimeout(function() {
                    tooltip.style.display = 'none';
                }, 2000);
            }, function(err) {
                console.error('Failed to copy: ', err);
            });
        }

        function shareToWhatsApp() {
            var currentUrl = window.location.href;
            var name = document.querySelector('h1').innerText;


            var message = '*' + name + '*' + '\n\nKlik untuk baca:\n' + currentUrl;
            var whatsappUrl = 'whatsapp://send?text=' + encodeURIComponent(message);

            window.location.href = whatsappUrl;
        }

        function shareToTelegram() {
            var currentUrl = window.location.href;
            var name = document.querySelector('h1').innerText;

            var message = '*' + name + '*' + '\n\nKlik untuk baca:\n' + currentUrl;
            var telegramUrl = 'https://t.me/share/url?url=' + encodeURIComponent(currentUrl) + '&text=' +
                encodeURIComponent(message);

            var windowOptions =
                'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, width=600, height=400, top=' +
                (screen.height / 2 - 200) + ', left=' + (screen.width / 2 - 300);

            window.open(telegramUrl, '_blank', windowOptions);
        }

        function shareToFacebook() {
            var currentUrl = window.location.href;
            var name = document.querySelector('h1').innerText;

            var facebookUrl = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(currentUrl) + '&quote=' +
                encodeURIComponent(name);

            var windowOptions =
                'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=600, height=400, top=' +
                (screen.height / 2 - 200) + ', left=' + (screen.width / 2 - 300);

            window.open(facebookUrl, '_blank', windowOptions);
        }

        function shareToTwitter() {
            var currentUrl = window.location.href;
            var name = document.querySelector('h1').innerText;
            var message = '*' + name + '*' + '\n\nKlik untuk baca:\n' + currentUrl;
            var twitterUrl = 'https://twitter.com/intent/tweet?url=' + encodeURIComponent(currentUrl) + '&text=' +
                encodeURIComponent(message);
            var windowOptions =
                'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=600, height=400, top=' +
                (screen.height / 2 - 200) + ', left=' + (screen.width / 2 - 300);
            window.open(twitterUrl, '_blank', windowOptions);
        }
    </script>
    @endsection
