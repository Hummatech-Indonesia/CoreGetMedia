@extends('layouts.user.app')
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

        /* .hidden-content {
                        display: none;
                    } */
        .read-more {
            color: blue;
            cursor: pointer;
            display: inline-block;
            margin-top: 10px;
        }
    </style>
@endsection

@section('content')
    {{-- <div class="breadcrumb-wrap">
        <div class="container">
            <h2 class="breadcrumb-title">{{$news->name}}</h2>
            <ul class="breadcrumb-menu list-style">
                <li><a href="/">Home</a></li>
                <li><a href=""></a></li>
            </ul>
        </div>
    </div> --}}


    <div class="news-details-wrap ptb-100">
        <div class="container">
            <div class="row gx-55 gx-5">
                <div class="col-lg-8">
                    <article>
                        <div>
                            <h1>{{ $news->name }}</h1>
                            <p class="d-flex gap-1">Share : <a id="wa" class="logo" data-name="{{ $news->name }}"
                                    data-slug="{{ $news->slug }}">
                                    <svg height="19" width="19" version="1.1" id="Capa_1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        viewBox="0 0 58 58" xml:space="preserve" fill="#000000">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <g>
                                                <path style="fill:#2CB742;"
                                                    d="M0,58l4.988-14.963C2.457,38.78,1,33.812,1,28.5C1,12.76,13.76,0,29.5,0S58,12.76,58,28.5 S45.24,57,29.5,57c-4.789,0-9.299-1.187-13.26-3.273L0,58z">
                                                </path>
                                                <path style="fill:#FFFFFF;"
                                                    d="M47.683,37.985c-1.316-2.487-6.169-5.331-6.169-5.331c-1.098-0.626-2.423-0.696-3.049,0.42 c0,0-1.577,1.891-1.978,2.163c-1.832,1.241-3.529,1.193-5.242-0.52l-3.981-3.981l-3.981-3.981c-1.713-1.713-1.761-3.41-0.52-5.242 c0.272-0.401,2.163-1.978,2.163-1.978c1.116-0.627,1.046-1.951,0.42-3.049c0,0-2.844-4.853-5.331-6.169 c-1.058-0.56-2.357-0.364-3.203,0.482l-1.758,1.758c-5.577,5.577-2.831,11.873,2.746,17.45l5.097,5.097l5.097,5.097 c5.577,5.577,11.873,8.323,17.45,2.746l1.758-1.758C48.048,40.341,48.243,39.042,47.683,37.985z">
                                                </path>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                                <a id="fb">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                        viewBox="0 0 263 263">
                                        <path fill="#1877F2"
                                            d="M256 128C256 57.308 198.692 0 128 0C57.308 0 0 57.308 0 128c0 63.888 46.808 116.843 108 126.445V165H75.5v-37H108V99.8c0-32.08 19.11-49.8 48.348-49.8C170.352 50 185 52.5 185 52.5V84h-16.14C152.959 84 148 93.867 148 103.99V128h35.5l-5.675 37H148v89.445c61.192-9.602 108-62.556 108-126.445" />
                                        <path fill="#FFF"
                                            d="m177.825 165l5.675-37H148v-24.01C148 93.866 152.959 84 168.86 84H185V52.5S170.352 50 156.347 50C127.11 50 108 67.72 108 99.8V128H75.5v37H108v89.445A128.959 128.959 0 0 0 128 256a128.9 128.9 0 0 0 20-1.555V165z" />
                                    </svg>
                                </a>
                                <a id="tw" class="logo" style="margin-top: 7px;">
                                    <svg class="logo-dark" style="margin-top: 1px;" xmlns="http://www.w3.org/2000/svg"
                                        width="16" height="16" viewBox="0 0 14 14">
                                        <g fill="none">
                                            <g clip-path="url(#primeTwitter0)">
                                                <path fill="#ffffff"
                                                    d="M11.025.656h2.147L8.482 6.03L14 13.344H9.68L6.294 8.909l-3.87 4.435H.275l5.016-5.75L0 .657h4.43L7.486 4.71zm-.755 11.4h1.19L3.78 1.877H2.504z" />
                                            </g>
                                            <defs>
                                                <clipPath id="primeTwitter0">
                                                    <path fill="#fff" d="M0 0h14v14H0z" />
                                                </clipPath>
                                            </defs>
                                        </g>
                                    </svg>
                                    <svg class="logo-light" style="margin-top: 1px;" xmlns="http://www.w3.org/2000/svg"
                                        width="16" height="16" viewBox="0 0 14 14">
                                        <g fill="none">
                                            <g clip-path="url(#primeTwitter0)">
                                                <path fill="#000000"
                                                    d="M11.025.656h2.147L8.482 6.03L14 13.344H9.68L6.294 8.909l-3.87 4.435H.275l5.016-5.75L0 .657h4.43L7.486 4.71zm-.755 11.4h1.19L3.78 1.877H2.504z" />
                                            </g>
                                            <defs>
                                                <clipPath id="primeTwitter0">
                                                    <path fill="#fff" d="M0 0h14v14H0z" />
                                                </clipPath>
                                            </defs>
                                        </g>
                                    </svg>
                                </a>
                                <a id="tele">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                        viewBox="0 0 263 263">
                                        <defs>
                                            <linearGradient id="logosTelegram0" x1="50%" x2="50%" y1="0%"
                                                y2="100%">
                                                <stop offset="0%" stop-color="#2AABEE" />
                                                <stop offset="100%" stop-color="#229ED9" />
                                            </linearGradient>
                                        </defs>
                                        <path fill="url(#logosTelegram0)"
                                            d="M128 0C94.06 0 61.48 13.494 37.5 37.49A128.038 128.038 0 0 0 0 128c0 33.934 13.5 66.514 37.5 90.51C61.48 242.506 94.06 256 128 256s66.52-13.494 90.5-37.49c24-23.996 37.5-56.576 37.5-90.51c0-33.934-13.5-66.514-37.5-90.51C194.52 13.494 161.94 0 128 0" />
                                        <path fill="#FFF"
                                            d="M57.94 126.648c37.32-16.256 62.2-26.974 74.64-32.152c35.56-14.786 42.94-17.354 47.76-17.441c1.06-.017 3.42.245 4.96 1.49c1.28 1.05 1.64 2.47 1.82 3.467c.16.996.38 3.266.2 5.038c-1.92 20.24-10.26 69.356-14.5 92.026c-1.78 9.592-5.32 12.808-8.74 13.122c-7.44.684-13.08-4.912-20.28-9.63c-11.26-7.386-17.62-11.982-28.56-19.188c-12.64-8.328-4.44-12.906 2.76-20.386c1.88-1.958 34.64-31.748 35.26-34.45c.08-.338.16-1.598-.6-2.262c-.74-.666-1.84-.438-2.64-.258c-1.14.256-19.12 12.152-54 35.686c-5.1 3.508-9.72 5.218-13.88 5.128c-4.56-.098-13.36-2.584-19.9-4.708c-8-2.606-14.38-3.984-13.82-8.41c.28-2.304 3.46-4.662 9.52-7.072" />
                                    </svg>
                                </a>
                                <a id="copylink" tooltip="Salin Link" style="margin-top: 6px;">
                                    <span style="border-radius: 50%; background-color: #cccccc"
                                        class="d-flex justify-content-center p-1 copyLink" onclick="copyToClipboard()"
                                        id="copy">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                            viewBox="0 0 256 256">
                                            <path fill="#292929"
                                                d="M240 88.23a54.43 54.43 0 0 1-16 37L189.25 160a54.27 54.27 0 0 1-38.63 16h-.05A54.63 54.63 0 0 1 96 119.84a8 8 0 0 1 16 .45A38.62 38.62 0 0 0 150.58 160a38.4 38.4 0 0 0 27.31-11.31l34.75-34.75a38.63 38.63 0 0 0-54.63-54.63l-11 11A8 8 0 0 1 135.7 59l11-11a54.65 54.65 0 0 1 77.3 0a54.86 54.86 0 0 1 16 40.23m-131 97.43l-11 11A38.4 38.4 0 0 1 70.6 208a38.63 38.63 0 0 1-27.29-65.94L78 107.31a38.63 38.63 0 0 1 66 28.4a8 8 0 0 0 16 .45A54.86 54.86 0 0 0 144 96a54.65 54.65 0 0 0-77.27 0L32 130.75A54.62 54.62 0 0 0 70.56 224a54.28 54.28 0 0 0 38.64-16l11-11a8 8 0 0 0-11.2-11.34" />
                                        </svg>
                                    </span>
                                </a>
                            </p>
                        </div>
                        <div class="news-img">
                            <img src="{{ asset('storage/' . $news->image) }}" width="100%" height="470"
                                style="object-fit: cover" alt="Image">
                            <a href="{{ route('categories.show.user', ['category' => $news->slug]) }}"
                                class="news-cat">{{ $news->newsCategories[0]->category->name }}</a>
                        </div>
                        <div>
                            <ul class="news-metainfo list-style">
                                <div class="d-flex justify-content-between">
                                    <div class="col-lg-11 col-md-11">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-3 mb-3">
                                                <li class="author">
                                                    <span class="author-img">
                                                        <img src="{{ asset($news->user->photo ? 'storage/' . $news->user->photo : 'default.png') }}"
                                                            alt="Image" width="40px" height="30px"
                                                            style="border-radius: 50%; object-fit:cover;" />
                                                    </span>
                                                    <div>
                                                        <a style="display: inline;text-decoration:none"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="author - Karin"
                                                            href="#">{{ $news->user->name }}</a>
                                                        </span>
                                                    </div>
                                                </li>
                                            </div>

                                            <div class="col-md-12 col-sm-12 col-lg-9">
                                                <li><i class="fi fi-rr-calendar-minus"></i>
                                                    <span id="formattedDate"
                                                        class="font-date">{{ \Carbon\Carbon::parse($news->created_at)->translatedFormat('d F Y') }}</span>
                                                </li>
                                                <li>
                                                    <i class="fi fi-rr-eye" style="margin-top: 2px;"></i>
                                                    <span>{{ $news->news_views_count }}x dilihat</span>
                                                </li>
                                                <li>
                                                        <form id="form-like">
                                                            @csrf
                                                            <button type="submit"
                                                                style="background: transparent;border:transparent"
                                                                class="like">
                                                                <svg class="last mb-1" xmlns="http://www.w3.org/2000/svg"
                                                                width="18" height="18" viewBox="0 0 24 24">
                                                                <path fill="#E93314"
                                                                    d="M18 21H7V8l7-7l1.25 1.25q.175.175.288.475t.112.575v.35L14.55 8H21q.8 0 1.4.6T23 10v2q0 .175-.05.375t-.1.375l-3 7.05q-.225.5-.75.85T18 21m-9-2h9l3-7v-2h-9l1.35-5.5L9 8.85zM9 8.85V19zM7 8v2H4v9h3v2H2V8z" />
                                                                </svg>
                                                            </button>
                                                        </form>

                                                        <form id="form-liked" style="display: none;">
                                                            @csrf
                                                            <button type="submit"
                                                                style="background: transparent;border:transparent"
                                                                class="liked">
                                                                <svg class="last mb-1" xmlns="http://www.w3.org/2000/svg"
                                                                width="18" height="18" viewBox="0 0 24 24">
                                                                <path fill="red"
                                                                    d="M18 21H8V8l7-7l1.25 1.25q.175.175.288.475t.112.575v.35L15.55 8H21q.8 0 1.4.6T23 10v2q0 .175-.037.375t-.113.375l-3 7.05q-.225.5-.75.85T18 21M6 8v13H2V8z" />
                                                                </svg>
                                                            </button>
                                                        </form>

                                                    <span id="like" data-like="{{ $likes }}">{{ $likes }}</span>
                                                </li>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-1 col-sm-1 col-lg-1">
                                        <li>
                                            <a class="" href="#" role="button" id="dropdownMenuLink"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                                    viewBox="0 0 24 24">
                                                    <path fill="none" stroke="currentColor" stroke-linejoin="round"
                                                        stroke-width="3"
                                                        d="M12 12h.01v.01H12zm0-7h.01v.01H12zm0 14h.01v.01H12z" />
                                                </svg>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <li>
                                                    <button class="btn btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#share">
                                                        Bagikan
                                                    </button>
                                                </li>
                                                <li>
                                                    <button class="btn btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#tambahdataLabel">
                                                        Laporkan
                                                    </button>
                                                </li>
                                            </ul>

                                        </li>
                                    </div>
                                </div>
                                {{-- <li class="author">
                                    <span class="author-img">
                                        <img src="{{asset('assets/img/author/author-thumb-4.webp')}}" alt="Image">
                                    </span>
                                    <a href="author.html">James William</a>
                                </li>
                                <li><i class="fi fi-rr-calendar-minus"></i><a href="news-by-date.html">Mar 03, 2023</a></li>
                                <li><i class="fi fi-rr-clock-three"></i>15 Min Read</li> --}}
                            </ul>
                        </div>
                        <div class="news-para text-justify">

                            <p id="news-description">
                                {!! Illuminate\Support\Str::limit(strip_tags($news->description), 300, '...') !!}
                            </p>
                            <span id="read-more" class="read-more">Baca Selengkapnya</span>
                        </div>
                        <p> Tag :
                            @forelse ($tags as $tag)
                                <a data-toggle="tooltip" data-placement="top" title="{{ $tag->tags->name }}"
                                    href="{{ route('list-tag.user') }}"
                                    class="btn btn-rounded btn-outline-primary">{{ $tag->tags->name }}</a>
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
                                            <input type="email" name="email" id="email" required
                                                placeholder="Alamat Email*">
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
                    <div class="comment-item-wrap">
                        <div class="comment-item">

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
                                    <div class="comment-author-img">
                                        <img src="{{ asset('admin/dist/images/profile/user-6.jpg') }}" alt="Image">
                                    </div>
                                    <div class="comment-author-wrap">
                                        <div class="comment-author-info">
                                            <div class="row align-items-start">
                                                <div class="col-md-9 col-sm-12 col-12 order-md-1 order-sm-1 order-1">
                                                    <div class="comment-author-name">
                                                        @if ($comment->user != null)
                                                            <h5>{{ $comment->user->name }}</h5>
                                                        @else
                                                            <h5>Guest</h5>
                                                        @endif
                                                        <span class="comment-date">{{ $comment->created_at->diffInMinutes() }} Menit yang lalu</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-3 text-md-end order-md-1 order-sm-1 order-1">

                                                    <a class="" href="javascript:void(0)" role="button"
                                                        id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                                            viewBox="0 0 24 24">
                                                            <path fill="none" stroke="currentColor" stroke-linejoin="round"
                                                                stroke-width="3"
                                                                d="M12 12h.01v.01H12zm0-7h.01v.01H12zm0 14h.01v.01H12z" />
                                                        </svg>
                                                    </a>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                        <li>
                                                            <button class="btn btn-sm" data-bs-toggle="modal"
                                                                data-bs-target="#edit-replay">
                                                                Edit
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button class="btn btn-sm" data-bs-toggle="modal"
                                                                data-bs-target="#report">
                                                                Laporkan
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-12 order-md-3 order-sm-3 order-3">
                                                    <div class="comment-text">
                                                        <p>{{$comment->description}}</p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-md-12 col-sm-12 col-12 text-md-start order-md-3 order-sm-3 order-3">
                                                    <a href="avascript:void(0)" class="reply-btn"  onclick="showReplyForm({{ $comment->id }})">Balas</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="reply-form-{{ $comment->id }}" class="reply-form mt-3" style="display: none;">
                                        <form action="{{ route('reply.create', ['news' => $news->id, 'comment' => $comment->id]) }}" method="post">
                                            @method('post')
                                            @csrf
                                            <textarea name="description" class="form-control mb-2" cols="100" rows="2" placeholder="Balas Komentar"></textarea>
                                            <div>
                                                <button type="submit" class="btn-two w-100 btn" style="background-color: #0F4D8A;padding:10px !important">Kirim Balasan</button>
                                            </div>
                                        </form>
                                    </div>
                                @endif

                                @foreach ($groupedReplies[$comment->id] ?? [] as $index => $reply)
                                    <div class="comment-author-img">
                                        <img src="{{ asset('admin/dist/images/profile/user-6.jpg') }}" alt="Image" class="ms-4">
                                    </div>
                                    <div class="comment-author-wrap">
                                        <div class="comment-author-info">
                                            <div class="row align-items-start">
                                                <div class="col-md-9 col-sm-12 col-12 order-md-1 order-sm-1 order-1">
                                                    <div class="comment-author-name ms-4">
                                                        @if ($reply->user != null)
                                                            <h5>{{ $reply->user->name }}</h5>
                                                        @else
                                                            <h5>Guest</h5>
                                                        @endif
                                                        <span class="comment-date">{{ $reply->created_at->diffInMinutes() }} Menit yang lalu</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-3 text-md-end order-md-1 order-sm-1 order-1">

                                                    <a class="" href="javascript:void(0)" role="button"
                                                        id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                                            viewBox="0 0 24 24">
                                                            <path fill="none" stroke="currentColor" stroke-linejoin="round"
                                                                stroke-width="3"
                                                                d="M12 12h.01v.01H12zm0-7h.01v.01H12zm0 14h.01v.01H12z" />
                                                        </svg>
                                                    </a>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                        <li>
                                                            <button class="btn btn-sm" data-bs-toggle="modal"
                                                                data-bs-target="#edit-replay">
                                                                Edit
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button class="btn btn-sm" data-bs-toggle="modal"
                                                                data-bs-target="#report">
                                                                Laporkan
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-12 order-md-3 order-sm-3 order-3">
                                                    <div class="comment-text ms-4">
                                                        <p>{{$reply->description}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @empty
                            @endforelse
                        </div>

                        {{-- <div class="comment-item reply">
                            <div class="comment-author-img">
                                <img src="{{ asset('assets/img/author/author-thumb-4.webp') }}" alt="Image">
                            </div>
                            <div class="comment-author-wrap">
                                <div class="comment-author-info">
                                    <div class="row align-items-start">
                                        <div class="col-md-9 col-sm-12 col-12 order-md-1 order-sm-1 order-1">
                                            <div class="comment-author-name">
                                                <h5>Everly Leah </h5>
                                                <span class="comment-date">1 hari yang lalu</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-3 text-md-end order-md-1 order-sm-1 order-1">
                                            <a class="" href="javascript:void(0)" role="button"
                                                id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                                    viewBox="0 0 24 24">
                                                    <path fill="none" stroke="currentColor" stroke-linejoin="round"
                                                        stroke-width="3"
                                                        d="M12 12h.01v.01H12zm0-7h.01v.01H12zm0 14h.01v.01H12z" />
                                                </svg>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                                <li>
                                                    <button class="btn btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#edit-replay">
                                                        Edit
                                                    </button>
                                                </li>
                                                <li>
                                                    <button class="btn btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#report">
                                                        Laporkan
                                                    </button>
                                                </li>
                                            </ul>

                                        </div>
                                        <div class="col-md-12 col-sm-12 col-12 order-md-3 order-sm-3 order-3">
                                            <div class="comment-text">
                                                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
                                                    sed diam nonumy eirmod tempor invidunt ut labore et dolore
                                                    magna aliquyam.
                                                </p>
                                            </div>
                                        </div>
                                        <div
                                            class="col-md-12 col-sm-12 col-12 text-md-start order-md-3 order-sm-3 order-3">
                                            <a href="#cmt-form" class="reply-btn">Balas</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>

                </div>
                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="sidebar-widget">
                            <h3 class="sidebar-widget-title">Kategori Populer</h3>
                            <ul class="category-widget list-style">
                                @foreach ($CategoryPopulars as $category)
                                    @if ($category->news_categories_count > 0)
                                        <li><a data-toggle="tooltip" data-placement="top" title="{{ $category->name }}"
                                                href="{{ route('categories.show.user', ['category' => $category->slug]) }}"><img
                                                    src="{{ asset('assets/img/icons/arrow-right.svg') }}"
                                                    alt="Image">{{ $category->name }}
                                        <span>({{ $category->news_categories_count }})</span></a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="sidebar-widget bg-transparent shadow-smer">
                            <h3 class="sidebar-widget-title">Tag Populer</h3>
                            <ul class="tag-list list-style">
                                @forelse ($popularTags as $popularTag)
                                    <li><a href="{{ route('list-tag.user') }}">{{ $popularTag->name }}</a></li>
                                @empty
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <button type="button" id="backtotop" class="position-fixed text-center border-0 p-0">
        <i class="ri-arrow-up-line"></i>
    </button> --}}

    <div class="modal fade" id="newsletter-popup" tabindex="-1" aria-labelledby="newsletter-popup" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <button type="button" class="btn_close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fi fi-rr-cross"></i>
                </button>
                <div class="modal-body">
                    <div class="newsletter-bg bg-f"></div>
                    <div class="newsletter-content">
                        <img src="{{ asset('assets/img/newsletter-icon.webp') }}" alt="Image"
                            class="newsletter-icon" />
                        <h2>Join Our Newsletter & Read The New Posts First</h2>
                        <form action="#" class="newsletter-form">
                            <input type="email" placeholder="Email Address" />
                            <button type="button" class="btn-one">Subscribe<i class="flaticon-arrow-right"></i></button>
                        </form>
                        <div class="form-check checkbox">
                            <input class="form-check-input" type="checkbox" id="test_21" />
                            <label class="form-check-label" for="test_21"> I've read and accept <a
                                    href="{{ route('privacy-policy') }}">Privacy Policy</a> </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="quickview-modal" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="quickview-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <button type="button" class="btn_close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ri-close-line"></i>
                </button>
                <div class="modal-body">
                    <div class="video-popup">
                        <iframe width="885" height="498" {{-- src="https://www.youtube.com/embed/3FjT7etqxt8" --}}
                            title="How to Design an Elvis Movie Poster in Photoshop"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="share" tabindex="-1" aria-labelledby="tambahdataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahdataLabel"><span style="color: #0F4D8A; font-size: 25px;"
                            class="mb-2 me-1"></span>Bagikan
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
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const newsDescription = {!! json_encode($news->description) !!};
            const initialLimit = 600;
            const additionalLimit = 3000;
            let currentLimit = initialLimit;

            const descriptionElement = document.getElementById('news-description');
            const readMoreElement = document.getElementById('read-more');

            readMoreElement.addEventListener('click', function() {
                currentLimit += additionalLimit;
                if (currentLimit >= newsDescription.length) {
                    descriptionElement.innerHTML = newsDescription;
                    readMoreElement.style.display = 'none';
                } else {
                    descriptionElement.innerHTML = newsDescription.substring(0, currentLimit) + '...';
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

        var formLike = document.getElementById('form-like');
        var formLiked = document.getElementById('form-liked');
        var likeCount = document.getElementById('like');
        var likedByUser = {{ $likedByUser ? 'true' : 'false' }};
        var likeData = parseInt(likeCount.getAttribute('data-like'));

        if (likedByUser) {
            formLike.style.display = 'none';
            formLiked.style.display = 'inline-block';
        } else {
            formLike.style.display = 'inline-block';
            formLiked.style.display = 'none';
        }

        formLike.addEventListener('submit', function(event) {
            event.preventDefault();
            formLike.style.display = 'none';
            formLiked.style.display = 'inline-block';
            likeData++;
            likeCount.innerHTML = likeData;
            likeCount.setAttribute('data-like', likeData);
        });

        formLiked.addEventListener('submit', function(event) {
                event.preventDefault();
                formLike.style.display = 'inline-block';
                formLiked.style.display = 'none';
                likeData--;
                likeCount.innerHTML = likeData;
                likeCount.setAttribute('data-like', likeData);
            });
        });

        document.getElementById('form-like').addEventListener('submit', function(event) {
            event.preventDefault();
            var form = event.target;
            var csrfToken = form.querySelector('input[name="_token"]').value;

            fetch('/like-news/{{ $news_id }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                })
                .then(function(response) {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Error: ' + response.status);
                    }
                })
                .then(function(data) {})
                .catch(function(error) {
                    console.error(error);
                });
        });

        document.getElementById('form-liked').addEventListener('submit', function(event) {
            event.preventDefault();
            var form = event.target;
            var csrfToken = form.querySelector('input[name="_token"]').value;

            fetch('/unlike-news/{{ $news_id }}', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                })
                .then(function(response) {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Error: ' + response.status);
                    }
                })
                .then(function(data) {})
                .catch(function(error) {
                    console.error(error);
                });
        });
    </script>

    <script>
        function showReplyForm(commentId) {
            var replyForm = document.getElementById('reply-form-' + commentId);
            replyForm.style.display = replyForm.style.display === 'none' ? 'flex' : 'none';
        }
    </script>
@endsection
