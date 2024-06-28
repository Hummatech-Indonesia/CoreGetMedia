@extends('layouts.user.app')

@section('style')
<style>
    .border-primary {
        border-color: #0f4d8a !important;
        border-width: 5px !important;
    }

    .btn-primary {
        --bs-btn-color: #fff;
        --bs-btn-bg: #0f4d8a;
        --bs-btn-border-color: #0f4d8a;
        --bs-btn-hover-color: #fff;
        --bs-btn-hover-bg: #0b5ed7;
        --bs-btn-hover-border-color: #0a58ca;
        --bs-btn-focus-shadow-rgb: 49, 132, 253;
        --bs-btn-active-color: #fff;
        --bs-btn-a --ctive-bg: #0a58ca;
        --bs-btn-active-border-color: #0a53be;
        --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
        --bs-btn-disabled-color: #fff;
        --bs-btn-disabled-bg: #0f4d8a;
        --bs-btn-disabled-border-color: #0f4d8a;
    }

    .strip-right {
        border-right: 1px solid #0f4d8a;
        padding-right: 30px;
        height: 60%;
    }

    .strip-right h6,
    .strip-right p {
        margin-left: 1px;
    }

    .card-detail {
        border-radius: 8px;
        border: 1px solid #eee;
    }

    .card-author {
        position: absolute;
        /* margin-top: ;  */
    }

    .box {
        background-image: linear-gradient(180deg, #ffffff 50%, #aad7ff 300%);
        background-size: 100% 0%;
        background-repeat: no-repeat;
        background-position: bottom;
        transition: background-size 0.5s ease;
    }

    .box:hover {
        background-size: 100% 100%;
    }

    .theme-dark .box {
        background-color: #000000;
        background-image: linear-gradient(180deg, #000000 24%, #175A95 200%);
        background-size: 100% 0%;
        background-repeat: no-repeat;
        background-position: bottom;
        transition: background-size 0.5s ease;
    }

    .theme-dark .box:hover {
        background-size: 100% 100%;
    }

    .theme-dark .text-card {
        color: #fff !important;
    }

    .theme-dark .card-detail {
        border: 1px solid rgba(255, 255, 255, 0.2) !important;
    }

    .author-box {
        width: 1200px;
        padding: 30px 40px 0px 40px;
        border-radius: 20px;
    }

    .search-box-widget button {
        position: absolute;
        top: 10px;
        right: 10px;
        height: 40px;
        background-color: #175A95;
        border-radius: 5px;
        padding: 10px 10px 10px 10px;
        border: none;
        width: 40px;
    }

    .page-nav li a.active,
    .page-nav li a:hover {
        color: var(--whiteColor);
        opacity: 1;
        background-color: #175A95;
        border-color: transparent;
    }

    .breadcrumb-wrap {
        padding: 80px 0 74px;
        /* background-color: var(--bgColor); 223*/
        background-image: url("assets/img/list-author-bg.png");
    }

</style>

<style>
   .number-animate {
        display: inline-block;
        position: relative;
        overflow: hidden;
        vertical-align: bottom;
    }

    .number-animate span {
        display: inline-block;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        animation: count 1s linear forwards;
    }

    @keyframes count {
        from {
            opacity: 0;
            transform: translateY(-50%);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection

@section('content')
<div class="breadcrumb-wrap">
    <div class="container">
        <h2 class="breadcrumb-title text-white">Penulis</h2>
        <ul class="breadcrumb-menu list-style">
            <li><a class="text-white" href="/">Beranda</a></li>
            <li>Penulis</li>
        </ul>
    </div>
</div>

<div class="" style="margin-top: -3pc">
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="author-box d-flex justify-content-center shadow-sm">
                <form class="search-box-widget w-100">
                    <input type="text" name="name" class="form-control search-chat py-2" placeholder="Search" />
                    <button type="submit">
                        <i class="fi fi-rr-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid pb-75 mt-5">
    <div class="row">
        @forelse ($authors as $key => $author)
        <div class="col-md-12 col-lg-4 mb-4 col-12">
            <div class="card-detail p-4 card-hover shadow-sm">
                <div class="row">
                    <div class="col-lg-3">
                        @if ($author->user->image != null && Storage::disk('public')->exists($author->user->image))
                        <img src="{{ asset('storage/' . $author->user->image) }}" style="border-radius: 50%;" class="mb-3" style="object-fit: cover" width="90" height="90">
                        @else
                        <img src="{{ asset('default.png') }}" style="border-radius: 50%;" class="mb-3" style="object-fit: cover" width="90" height="90">
                        @endif
                        <div class="">
                            <a href="{{ route('author.detail', $author->user->slug) }}" class="btn btn-sm mt-3 mb-1 py-1 px-4 w-100 text-primary bg-light-primary" style="background-color: #CEE4F2; border-radius: 8px;">Detail</a>
                            @auth
                            @php
                            $already = App\Models\Follower::where('author_id', $author->id)->where('user_id', auth()->user()->id)->first()
                            @endphp
                            @endauth
                            @if (Auth::check() && $already)
                            <form action="{{ route('unfollow.author', $author->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-sm mt-1 py-1 px-4 w-100 text-white" style="background-color: #175A95; border-radius: 8px;">Batal Ikuti</button>
                            </form>
                            @else
                            <form action="{{ route('follow.author', $author->id) }}" method="POST">
                                @method('post')
                                @csrf
                                <button type="submit" class="btn btn-sm mt-1 py-1 px-4 w-100 text-white" style="background-color: #175A95; border-radius: 8px;">Ikuti</button>
                            </form>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div>
                            <p><b>{{ $author->user->name }}</b></p>
                        </div>
                        <div>
                            <p>{{ $author->description ? $author->description : "-" }}</p>
                        </div>
                        <div class="text-center px-3" style="margin-top: 10px;">
                            {{-- <div class="d-flex align-items-center justify-content-between" style="">
                                <div class="text-center px-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                        <path fill="#a0a0a0" d="M6 2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm0 2h7v5h5v11H6zm2 8v2h8v-2zm0 4v2h5v-2z" />
                                    </svg>
                                    <h5 class="mt-2 text-card" id="animation-number{{ $key }}" style="color: #434343;">{{ $author->user->newses()->count() }}</h5>
                                    <span class="mb-3 text-card" style="color: #888888; font-size:15px;">Berita</span>
                                </div>
                                <div class="text-center px-4 border-end border-start">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                        <path fill="#a0a0a0" d="M5.85 17.1q1.275-.975 2.85-1.537T12 15q1.725 0 3.3.563t2.85 1.537q.875-1.025 1.363-2.325T20 12q0-3.325-2.337-5.663T12 4Q8.675 4 6.337 6.338T4 12q0 1.475.488 2.775T5.85 17.1M12 13q-1.475 0-2.488-1.012T8.5 9.5q0-1.475 1.013-2.488T12 6q1.475 0 2.488 1.013T15.5 9.5q0 1.475-1.012 2.488T12 13m0 9q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22m0-2q1.325 0 2.5-.387t2.15-1.113q-.975-.725-2.15-1.112T12 17q-1.325 0-2.5.388T7.35 18.5q.975.725 2.15 1.113T12 20m0-9q.65 0 1.075-.425T13.5 9.5q0-.65-.425-1.075T12 8q-.65 0-1.075.425T10.5 9.5q0 .65.425 1.075T12 11m0 7.5" />
                                    </svg>
                                    <h5 class="mt-2 text-card" id="animation-follower{{ $key }}" style="color: #434343;">
                                        {{ $author->followers()->count() }}
                                    </h5>
                                    <span class="mb-3 text-card" style="color: #888888; font-size:15px;">Pengikut</span>
                                </div>
                                <div class="text-center px-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                        <path fill="#a0a0a0" d="M18 21H7V8l7-7l1.25 1.25q.175.175.288.475t.112.575v.35L14.55 8H21q.8 0 1.4.6T23 10v2q0 .175-.05.375t-.1.375l-3 7.05q-.225.5-.75.85T18 21m-9-2h9l3-7v-2h-9l1.35-5.5L9 8.85zM9 8.85V19zM7 8v2H4v9h3v2H2V8z" />
                                    </svg>
                                    @php
                                    $newses = App\Models\News::where('user_id', $author->user->id);
                                    $like = 0;
                                    foreach ($newses as $key => $news) {
                                    $like = App\Models\NewsLike::where('news_id', $news->id)->count();
                                    }
                                    @endphp
                                    <h5 class="mt-2 text-card" id="animation-like{{ $key }}" style="color: #434343;">{{ $like }}
                                    </h5>
                                    <span class="mb-3 text-card" style="color: #888888; font-size:15px;">Like</span>
                                </div>
                            </div> --}}
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="text-center px-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                        <path fill="#a0a0a0" d="M6 2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm0 2h7v5h5v11H6zm2 8v2h8v-2zm0 4v2h5v-2z" />
                                    </svg>
                                    <h5 class="mt-2 text-card" id="animation-number{{ $key }}" style="color: #434343;">0</h5>
                                    <span class="mb-3 text-card" style="color: #888888; font-size:15px;">Berita</span>
                                </div>
                                <div class="text-center px-4 border-end border-start">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                        <path fill="#a0a0a0" d="M5.85 17.1q1.275-.975 2.85-1.537T12 15q1.725 0 3.3.563t2.85 1.537q.875-1.025 1.363-2.325T20 12q0-3.325-2.337-5.663T12 4Q8.675 4 6.337 6.338T4 12q0 1.475.488 2.775T5.85 17.1M12 13q-1.475 0-2.488-1.012T8.5 9.5q0-1.475 1.013-2.488T12 6q1.475 0 2.488 1.013T15.5 9.5q0 1.475-1.012 2.488T12 13m0 9q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22m0-2q1.325 0 2.5-.387t2.15-1.113q-.975-.725-2.15-1.112T12 17q-1.325 0-2.5.388T7.35 18.5q.975.725 2.15 1.113T12 20m0-9q.65 0 1.075-.425T13.5 9.5q0-.65-.425-1.075T12 8q-.65 0-1.075.425T10.5 9.5q0 .65.425 1.075T12 11m0 7.5" />
                                    </svg>
                                    <h5 class="mt-2 text-card" id="animation-follower{{ $key }}" style="color: #434343;">
                                        0
                                    </h5>
                                    <span class="mb-3 text-card" style="color: #888888; font-size:15px;">Pengikut</span>
                                </div>
                                <div class="text-center px-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                        <path fill="#a0a0a0" d="M18 21H7V8l7-7l1.25 1.25q.175.175.288.475t.112.575v.35L14.55 8H21q.8 0 1.4.6T23 10v2q0 .175-.05.375t-.1.375l-3 7.05q-.225.5-.75.85T18 21m-9-2h9l3-7v-2h-9l1.35-5.5L9 8.85zM9 8.85V19zM7 8v2H4v9h3v2H2V8z" />
                                    </svg>
                                    @php
                                    $newses = App\Models\News::where('user_id', $author->user->id)->get();
                                    $like = 0;
                                    foreach ($newses as $key => $news) {
                                        $like += App\Models\NewsLike::where('news_id', $news->id)->count();
                                    }
                                    @endphp
                                     <h5 class="mt-2 text-card" id="animation-like{{ $key }}" style="color: #434343;">0
                                    </h5>
                                    <span class="mb-3 text-card" style="color: #888888; font-size:15px;">Like</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 col-md-12 text-center">
            <img src="{{ asset('assets/img/author/empty.png') }}" width="300px" alt="">
            <p>Belum ada penulis</p>
        </div>
        @endforelse

    </div>
</div>
@endsection

@section('script')
<script>
    // document.addEventListener("DOMContentLoaded", function() {
    //     function animateValue(id, start, end, duration) {
    //         const obj = document.getElementById(id);
    //         const range = end - start;
    //         let current = start;
    //         const increment = end > start ? 1 : -1;
    //         const stepTime = Math.abs(Math.floor(duration / range));
    //         const timer = setInterval(function() {
    //             current += increment;
    //             obj.innerHTML = current;
    //             if ((increment > 0 && current >= end) || (increment < 0 && current <= end)) {
    //                 clearInterval(timer);
    //                 obj.innerHTML = end;
    //             }
    //         }, stepTime);
    //     }

    //     const newsCount = parseInt("{{ $author->user->newses()->count() }}");
    //     const followerCount = parseInt("{{ $author->followers()->count() }}");
    //     const likeCount = parseInt("{{ $like }}");

    //     animateValue("animation-number{{ $key }}", 0, newsCount, 1000);
    //     animateValue("animation-follower{{ $key }}", 0, followerCount, 1000);
    //     animateValue("animation-like{{ $key }}", 0, likeCount, 1000);
    // });

    document.addEventListener("DOMContentLoaded", function() {
        function animateValue(id, start, end, duration) {
            const obj = document.getElementById(id);
            const range = end - start;
            let current = start;
            const increment = end > start ? 1 : -1;
            const stepTime = Math.abs(Math.floor(duration / range));
            const timer = setInterval(function() {
                current += increment;
                obj.innerHTML = current;
                if ((increment > 0 && current >= end) || (increment < 0 && current <= end)) {
                    clearInterval(timer);
                    obj.innerHTML = end;
                }
            }, stepTime);
        }

        @foreach($authors as $key => $author)
            animateValue("animation-number{{ $key }}", 0, {{ $author->user->newses()->count() }}, 1000);
            animateValue("animation-follower{{ $key }}", 0, {{ $author->followers()->count() }}, 1000);
            animateValue("animation-like{{ $key }}", 0, {{ $like }}, 1000);
        @endforeach
    });
</script>
@endsection
