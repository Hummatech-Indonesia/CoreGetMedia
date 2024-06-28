@extends('layouts.user.app')

@section('style')
    <style>
        .card-detail {
            box-shadow: 0 5px 2px rgba(0, 0, 0, 0.1);
            border: 1px solid #f4f4f4;
            padding: 2%;
            border-radius: 10px;
            /* width: 400px;
                                            height: 130px; */
        }

        .theme-dark .card-detail {
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
        }
        
        .theme-dark .card-detail .text-muted{
            color: #fff !important;
        }
        
        .theme-dark .input-theme {
            background-color: #0101;
        }

        .theme-dark .form-select {
            background-color: #000; /* Black background */
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            color: #fff; /* White text */
        }

        .theme-dark .form-select option {
            background-color: #000; /* Black background */
            color: #fff; /* White text */
        }

        .card-category {
            box-shadow: 0 5px 2px rgba(0, 0, 0, 0.1);
            border: 1px solid #f4f4f4;
            padding: 4%;
            border-radius: 10px;
        }

        @media only screen and (max-width: 768px) {
            .text-mobile {
                font-size: 10px;
            }
        }
    </style>
    <style>
        .vertical-line {
            border-left: 1px solid #dee2e6;
            height: 100%;
            position: absolute;
            left: 0%;
            transform: translateX(-50%);
        }

        .stat-container {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 20px;
        }
    </style>


@endsection

@section('content')
    <div class="breadcrumb-wrap" style="background-image: url({{ asset('detail-author.png') }});">
        <div class="container">
            <h2 class="breadcrumb-title text-light">Author</h2>
            <ul class="breadcrumb-menu list-style">
                <li><a href="/" class="text-light">Beranda</a></li>
                <li>Author</li>
            </ul>
        </div>
    </div>


    <div class="author-wrap">
        <div class="container">

        </div>
    </div>

    <div class="row">
        <div class="col-4">

        </div>
    </div>

    <div class="news-details-wrap ptb-100">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-4">
                    <div class="card-detail">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Data Penulis</h5>
                            <div class="container mt-4">
                                <div class="text-center">
                                    @if ($author->user->image != null && Storage::disk('public')->exists($author->user->image))
                                        <img src="{{ asset('storage/' . $author->user->image) }}"
                                            style="border-radius: 50%;" class="mb-3" style="object-fit: cover"
                                            width="150" height="150">
                                    @else
                                        <img src="{{ asset('default.png') }}" style="border-radius: 50%;" class="mb-3"
                                            style="object-fit: cover" width="150" height="150">
                                    @endif
                                    <h4 class="card-text">{{ $author->user->name }}</h4>
                                </div>
                            </div>
                            <div class="container mt-4">
                                @auth
                                    @php
                                        $already = App\Models\Follower::where('author_id', $author->id)
                                            ->where('user_id', auth()->user()->id)
                                            ->exists();
                                    @endphp
                                @endauth
                                <div class="d-flex justify-content-center">
                                    @if (Auth::check() && $already)
                                        <form action="{{ route('unfollow.author', $author->id) }}" method="POST"
                                            class="mr-2">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-primary"
                                                style="background-color: #175A95; border: none">Batal Ikuti</button>
                                        </form>
                                    @else
                                        <form action="{{ route('follow.author', $author->id) }}" method="POST"
                                            class="mr-2">
                                            @method('post')
                                            @csrf
                                            <button type="submit" class="btn btn-primary"
                                                style="background-color: #175A95; border: none">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M18 14v-3h-3V9h3V6h2v3h3v2h-3v3zm-9-2q-1.65 0-2.825-1.175T5 8t1.175-2.825T9 4t2.825 1.175T13 8t-1.175 2.825T9 12m-8 8v-2.8q0-.85.438-1.562T2.6 14.55q1.55-.775 3.15-1.162T9 13t3.25.388t3.15 1.162q.725.375 1.163 1.088T17 17.2V20z" />
                                                </svg>
                                                Ikuti</button>
                                        </form>
                                    @endif
                                    {{-- <button type="button" class="btn btn-light ms-2"
                                        style="background-color: #CEE4F2; color: #175A95">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M18 22q-1.25 0-2.125-.875T15 19q0-.175.025-.363t.075-.337l-7.05-4.1q-.425.375-.95.588T6 15q-1.25 0-2.125-.875T3 12t.875-2.125T6 9q.575 0 1.1.213t.95.587l7.05-4.1q-.05-.15-.075-.337T15 5q0-1.25.875-2.125T18 2t2.125.875T21 5t-.875 2.125T18 8q-.575 0-1.1-.212t-.95-.588L8.9 11.3q.05.15.075.338T9 12t-.025.363t-.075.337l7.05 4.1q.425-.375.95-.587T18 16q1.25 0 2.125.875T21 19t-.875 2.125T18 22" />
                                        </svg>
                                    </button> --}}
                                </div>

                                <div class="container mt-5">
                                    <div class="d-flex justify-content-between mt-4">
                                        <div class="stat-container">
                                            <div class="text-center">
                                                <h5>{{ $author->user->newses()->count() }}</h5>
                                                <p class="text-muted">Berita</p>
                                            </div>
                                        </div>
                                        <div class="stat-container">
                                            <div class="vertical-line"></div>
                                            <div class="text-center">
                                                <h5>{{ $author->followers()->count() }}</h5>
                                                <p class="text-muted">Pengikut</p>
                                            </div>
                                        </div>
                                        <div class="stat-container">
                                            <div class="vertical-line"></div>
                                            <div class="text-center">
                                                <h5>{{ $follows }}</h5>
                                                <p class="text-muted">Mengikuti</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <p class="text-muted mt-3"> {{ $author->description }}</p>

                            </div>
                        </div>
                    </div>

                    <div class=" card-detail mt-4">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Penulis Lainnya</h5>
                            @forelse ($allauthor as $author)
                                <div class="d-flex">
                                    @if ($author->user->image != null && Storage::disk('public')->exists($author->user->image))
                                        <img src="{{ asset('storage/' . $author->user->image) }}"
                                            style="border-radius: 50%;" class="mb-3" style="object-fit: cover"
                                            width="50" height="50">
                                    @else
                                        <img src="{{ asset('default.png') }}" style="border-radius: 50%;" class="mb-3"
                                            style="object-fit: cover" width="50" height="50">
                                    @endif

                                    <div class="ms-3">
                                        <a href="{{ route('author.detail', $author->user->slug) }}"><h6>{{ $author->user->name }}</h6></a>
                                        <p class="text-muted">Penulis</p>
                                    </div>
                                </div>

                            @empty
                                <div class="col-12 col-md-12 text-center">
                                    <img src="{{ asset('assets/img/author/empty.png') }}" width="200px" alt="">
                                    <p>Belum ada data</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    @if ($advertisement_rights)
                        <div class="sidebar mt-4 mb-4" style="width: 400px">
                            <img src="{{ asset($advertisement_rights && $advertisement_rights->image != null ? 'storage/' . $advertisement_rights->image : 'CONTOHIKLAN.png') }}"
                                width="100%" height="302px" style="object-fit: cover" alt="">
                        </div>
                    @else
                    <div class="sidebar mt-4 mb-4 bg_gray" style="width: 400px; height: 302px;">
                        <p class="text-center align-middle" style="line-height: 500px;">Iklan</p>
                    </div>
                    @endif

                </div>

                <div class="col-lg-8">
                    <div class="section-title-two mb-40">
                        <h2>Berita Ditulis</h2>
                    </div>

                    <div>
                        <form class="d-flex gap-2 mb-3">
                            <div>
                                <div class="input-group">
                                    <input type="text" name="name" class="form-control search-chat py-2 px-4 ps-5"
                                        placeholder="Search">

                                    <svg class="position-absolute top-50 translate-middle-y ms-3"
                                        xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="m19.6 21l-6.3-6.3q-.75.6-1.725.95T9.5 16q-2.725 0-4.612-1.888T3 9.5q0-2.725 1.888-4.612T9.5 3q2.725 0 4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l6.3 6.3zM9.5 14q1.875 0 3.188-1.312T14 9.5q0-1.875-1.312-3.187T9.5 5Q7.625 5 6.313 6.313T5 9.5q0 1.875 1.313 3.188T9.5 14" />
                                    </svg>
                                    {{-- <button type="submit" class="btn btn-outline-primary px-4">Cari</button> --}}
                                </div>
                            </div>

                            <div class="input-group input-theme" style="width: 250px">
                                <select class="form-select" name="filter">
                                    <option value="terbaru">Terbaru</option>
                                    <option value="terlama">Terlama</option>
                                    <option value="">Tampilkan Semua</option>
                                </select>
                                {{-- <button type="submit" class="btn btn-outline-primary">
                                    Pilih
                                </button> --}}
                            </div>
                        </form>


                    </div>

                    <div class="popular-news-wrap">

                        @forelse ($newses as $news)
                            <div class="news-card-five">
                                <div class="news-card-img">
                                    <img src="{{ asset('storage/' . $news->image) }}" class="" width="100%"
                                        height="150px" style="object-fit: cover" alt="Image">

                                </div>
                                <div class="news-card-info">
                                    <h3>
                                        <a data-toggle="tooltip" data-placement="top" title="{{ $news->name }}"
                                            href="{{ route('news.singlepost', $news->slug) }}">{{ $news->name }}</a>
                                    </h3>
                                    <p>
                                        {!! Str::limit($news->description, 60, '...') !!}
                                    </p>

                                    <span class="news-metainfo">
                                        <div class=" d-flex gap-3" style="display: flex">
                                            <div class="d-inline">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="none" stroke="#e93314" stroke-linecap="round" stroke-width="1.5"><path stroke-linejoin="round" d="M17 4.625H7a4 4 0 0 0-4 4v8.75a4 4 0 0 0 4 4h10a4 4 0 0 0 4-4v-8.75a4 4 0 0 0-4-4m-14 5h18m-4-7v4m-10-4v4"/><path stroke-miterlimit="10" d="M9.5 14.989h5"/></g></svg>
                                                <a href="javascript:void(0)">{{ \Carbon\Carbon::parse($news->date)->translatedFormat('d F Y') }}</a>
                                            </div>
                                            <div class="d-inline ms-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 256 256"><path fill="#e93314" d="M247.31 124.76c-.35-.79-8.82-19.58-27.65-38.41C194.57 61.26 162.88 48 128 48S61.43 61.26 36.34 86.35C17.51 105.18 9 124 8.69 124.76a8 8 0 0 0 0 6.5c.35.79 8.82 19.57 27.65 38.4C61.43 194.74 93.12 208 128 208s66.57-13.26 91.66-38.34c18.83-18.83 27.3-37.61 27.65-38.4a8 8 0 0 0 0-6.5M128 192c-30.78 0-57.67-11.19-79.93-33.25A133.5 133.5 0 0 1 25 128a133.3 133.3 0 0 1 23.07-30.75C70.33 75.19 97.22 64 128 64s57.67 11.19 79.93 33.25A133.5 133.5 0 0 1 231.05 128c-7.21 13.46-38.62 64-103.05 64m0-112a48 48 0 1 0 48 48a48.05 48.05 0 0 0-48-48m0 80a32 32 0 1 1 32-32a32 32 0 0 1-32 32"/></svg>
                                                <a href="javascript:void(0)">{{ $news->newsViews()->count() }}x
                                                    dilihat</a>
                                            </div>
                                        </div>
                                    </span>

                                </div>
                            </div>
                        @empty
                            <div class="col-12 col-md-12 text-center">
                                <img src="{{ asset('assets/img/author/empty.png') }}" width="300px" alt="">
                                <p>Penulis ini belum menuliskan berita</p>
                            </div>
                        @endforelse

                    </div>
                    <x-paginator :paginator="$newses" />
                </div>
            </div>
        </div>
    </div>

@endsection

{{-- @section('script')
    <script>
         const notLoginElements = document.querySelectorAll('.not-login');

        notLoginElements.forEach(function(element) {
            element.addEventListener('click', function() {
                Swal.fire({
                    title: 'Error!!',
                    icon: 'error',
                    text: 'Anda Belum Login Silahkan Login Terlebih Dahulu'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '{{ route('login') }}';
}
});
});
});
</script>
@endsection --}}
