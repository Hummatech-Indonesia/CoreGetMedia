@extends('layouts.user.app')


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

</style>
<style>
    .breadcrumb-menu li:after {
        color: #000;
    }

    .img-popular {
        width: 100px;
        height: 100px;
        object-fit: cover;
    }

    .img-all {
        width: 213px;
        height: 150px;
        object-fit: cover;
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
            align-items: center;
        }

        .news-card-img img {
            width: 100%;
            height: auto;
        }

        .news-card-info h3 {
            font-size: 1.2em;
            text-align: center;
        }

        .news-metainfo {
            justify-content: center;
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

        .advertisement {
            width: 100%;
            height: auto;
        }
    }

    @media (min-width: 1024px) {
        .iklan-top {
            height: 250px;
        }

        .iklan-top-img {
            width: 1350px;
        }

        .top-noiklan {
            width: 1350px;
        }
    }

</style>
@endsection

@section('content')
<div class="col-lg-12">
    <div class="breadcrumb-wrap">
        <h2 class="breadcrumb-title">{{ $category->name }}</h2>
        <ul class="breadcrumb-menu list-style">
            <li><a href="/">Beranda</a></li>
            <li>{{ $category->name }}</li>
        </ul>
    </div>
</div>


<div class="sports-wrap">

    <div class="container">
        @if ($advertisement_tops)
        <a href="{{ $advertisement_tops->url }}">
            <div class="mt-4 iklan-top" style="position: relative; width: 100%; height: 250px; overflow: hidden;">
                <img class="iklan-top-img" src="{{ asset($advertisement_tops && $advertisement_tops->image != null ? 'storage/'.$advertisement_tops->image : "CONTOHIKLAN.png") }}" width="100%" height="auto" alt="">
                <div style="width: 100%; background-color: rgba(0, 0, 0, 0.5); color: white; text-align: center; padding: 10px; box-sizing: border-box; position: relative; top: -50px;">
                    <a class="text-white" href="jascript:void(0)">Ingin baca berita tanpa iklan?</a> <a href="/subscribe" style="color: #7cadd8; text-decoration: underline;">Berlangganan</a>
                </div>
            </div>
        </a>
        @else
        <div class="container-fluid mt-5 mb-5 d-flex justify-content-center align-items-center bg_gray top-noiklan" style="height: 250px;">
            <p style="color: #22222278">Iklan</p>
        </div>
        @endif

        <div class="side-responsive gx-5 d-lg-flex flex-lg-row flex-sm-column flex-md-column">
            <div class="col-lg-8 me-5 col-md-12 col-sm-12">
                @forelse ($newsTop as $item)
                <div class="news-card-four" style="height: 550px;">
                    <div class="news-card-img">
                        <a href="javascript:void(0)"> <img src="{{asset('storage/' . $item->image)}}" alt="Image" width="100%" style="object-fit: cover" height="450" /></a>
                    </div>

                    <div class="news-card-info">
                        <h3><a data-toggle="tooltip" data-placement="top" title="{{ $item->name }}" href="{{ route('news.singlepost', ['news' => $item->slug]) }}">{!!
                                Illuminate\Support\Str::limit(strip_tags($item->name), 300, '...') !!}
                            </a>
                        </h3>
                        <ul class="news-metainfo list-style">
                            <li><i class="fi fi-rr-calendar-minus"></i><a href="javascript:void(0)">{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</a>
                            </li>
                            <li><i class="fi fi-rr-eye"></i><a href="javascript:void(0)">{{ $item->news_views_count ? $item->news_views_count : '0' }}x
                                    dilihat</a></li>
                        </ul>
                    </div>
                </div>
                @empty
                @endforelse



                <div class="mb-5">
                    @php
                    $trending_id = $trendings->take(4)->where('news_views_count', '>', 0)->pluck('id');
                    $latest_news = $latests->whereNotIn('id', $trending_id)->paginate(4);
                    @endphp

                    @if($latest_news->isNotEmpty())
                    <div class="d-flex justify-content-between mb-3 mt-3">
                        <h3>Terbaru</h3>
                        <a href="{{ route('all-category-list.user', ['category' => $category->slug])}}">
                            <p>Lihat lainnya
                                <i><svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="m13.292 12l-4.6-4.6l.708-.708L14.708 12L9.4 17.308l-.708-.708z" />
                                    </svg></i>
                            </p>
                        </a>
                    </div>
                    @endif

                    @forelse ($latest_news as $new)
                    <div class="news-card-five">
                        <div class="news-card-img">
                            <a href="javascript:void(0)"><img src="{{ asset('storage/' . $new->image) }}" alt="Image" class="img-all" /></a>
                            <a data-toggle="tooltip" data-placement="top" title="Sports" href="/{{ $new->newsCategories[0]->category->name }}" class="news-cat">{{ $new->newsCategories[0]->category->name }}</a>
                        </div>
                        <div class="news-card-info">
                            <h3><a data-toggle="tooltip" data-placement="top" title="{{ $new->name }}" href="{{ route('news.singlepost', ['news' => $new->slug]) }}">{!!
                                    Illuminate\Support\Str::limit($new->name, $limit = 170, $end = '...') !!}
                                </a>
                            </h3>
                            <p>{!! Str::limit(strip_tags($new->description), 130) !!}</p>
                            <span class="news-metainfo">
                                <div class=" d-flex gap-3" style="display: flex">
                                    <div class="d-inline">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                            <g fill="none" stroke="#e93314" stroke-linecap="round" stroke-width="1.5">
                                                <path stroke-linejoin="round" d="M17 4.625H7a4 4 0 0 0-4 4v8.75a4 4 0 0 0 4 4h10a4 4 0 0 0 4-4v-8.75a4 4 0 0 0-4-4m-14 5h18m-4-7v4m-10-4v4" />
                                                <path stroke-miterlimit="10" d="M9.5 14.989h5" />
                                            </g>
                                        </svg>
                                        <a href="javascript:void(0)">{{ \Carbon\Carbon::parse($new->created_at)->translatedFormat('d F Y') }}</a>
                                    </div>
                                    <div class="d-inline ms-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 256 256">
                                            <path fill="#e93314" d="M247.31 124.76c-.35-.79-8.82-19.58-27.65-38.41C194.57 61.26 162.88 48 128 48S61.43 61.26 36.34 86.35C17.51 105.18 9 124 8.69 124.76a8 8 0 0 0 0 6.5c.35.79 8.82 19.57 27.65 38.4C61.43 194.74 93.12 208 128 208s66.57-13.26 91.66-38.34c18.83-18.83 27.3-37.61 27.65-38.4a8 8 0 0 0 0-6.5M128 192c-30.78 0-57.67-11.19-79.93-33.25A133.5 133.5 0 0 1 25 128a133.3 133.3 0 0 1 23.07-30.75C70.33 75.19 97.22 64 128 64s57.67 11.19 79.93 33.25A133.5 133.5 0 0 1 231.05 128c-7.21 13.46-38.62 64-103.05 64m0-112a48 48 0 1 0 48 48a48.05 48.05 0 0 0-48-48m0 80a32 32 0 1 1 32-32a32 32 0 0 1-32 32" /></svg>
                                        <a href="javascript:void(0)">{{ $new->news_views_count ? $new->news_views_count : '0' }}x
                                            dilihat</a>
                                    </div>
                                </div>
                            </span>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="d-flex justify-content-center">
                            <div>
                                <img src="{{ asset('assets/img/no-data/empty.png') }}" width="250px" alt="">
                            </div>
                        </div>
                        <div class="text-center">
                            <h5>Tidak ada data</h5>
                        </div>
                    </div>
                    @endforelse
                </div>
                @if ($advertisement_mids)
                <a href="{{ $advertisement_mids->url }}">
                    <div>
                        <img src="{{asset($advertisement_mid && $advertisement_mid->image != null ? 'storage/'.$advertisement_mid->image : "CONTOHIKLAN.png")}}" width="100%" height="181px" style="object-fit: cover" alt="" alt="...">
                    </div>
                </a>
                @else
                <div class="bg_gray" style="width: 100%; height: 181px;">
                    <p class="text-center align-middle" style="line-height: 181px;">Iklan</p>
                </div>
                @endif
                <div>
                    <x-paginator :paginator="$latest_news" />
                </div>
            </div>

            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="sidebar">
                    @if($CategoryPopulars->isNotEmpty())
                    <div class="sidebar-widget">
                        <h3 class="sidebar-widget-title">Kategori Populer</h3>
                        <ul class="category-widget list-style">
                            @foreach ($CategoryPopulars as $category)
                            <li>
                                <a data-toggle="tooltip" data-placement="top" title="{{ $category->name }}" href="{{ route('categories.show.user', ['category' => $category->slug]) }}">
                                    <img src="{{ asset('assets/img/icons/arrow-right.svg') }}" alt="Image">
                                    {{ $category->name }}
                                    <span>({{ $category->news_categories_count }})</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @php
                    $news_top_id = $newsTop->pluck('id');
                    $trending_news = $trendings->take(4)->whereNotin('id', $news_top_id);
                    @endphp

                    @if($trending_news->isNotEmpty())
                    <div class="sidebar-widget">
                        <h3 class="sidebar-widget-title">Berita Populer</h3>
                        @forelse ($trending_news as $trending)
                        <div class="news-card-three">
                            <div class="news-card-img">
                                <img src="{{ asset('storage/' . $trending->image) }}" class="img-popular" alt="Image" />
                            </div>
                            <div class="news-card-info">
                                <h3>
                                    <a href="{{ route('news.singlepost', ['news' => $trending->slug]) }}">
                                        {!! Illuminate\Support\Str::limit($trending->name, 45, '...') !!}
                                    </a>
                                </h3>
                                <ul class="news-metainfo list-style d-flex">
                                    <li><i class="fi fi-rr-calendar-minus"></i><a href="javascript:void(0)" style="font-size: 14px;">{{ \Carbon\Carbon::parse($trending->date)->translatedFormat('d F Y') }}</a></li>
                                    <li><i class="fi fi-rr-eye"></i><a href="javascript:void(0)" style="font-size: 14px;">{{ $trending->news_views_count ? $trending->news_views_count : '0' }}x dilihat</a></li>
                                </ul>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="d-flex justify-content-center">
                                <div>
                                    <img src="{{ asset('assets/img/no-data/empty.png') }}" width="150px" alt="">
                                </div>
                            </div>
                            <div class="text-center">
                                <h5>Tidak ada data</h5>
                            </div>
                        </div>
                        @endforelse
                    </div>
                    @endif

                    @if ($advertisement_rights)
                    <a href="{{ $advertisement_rights->url }}">
                        <div class="sidebar mt-3 mb-4">
                            <img src="{{asset($advertisement_rights && $advertisement_rights->image != null ? 'storage/'.$advertisement_rights->image : 'CONTOHIKLAN.png')}}" class="advertisement" style="object-fit: cover" alt="">
                        </div>
                    </a>
                    @else
                    <div class="sidebar mt-3 mb-4 bg_gray" style="height: 603px;">
                        <p class="text-center align-middle" style="line-height: 603px;">Iklan</p>
                    </div>
                    @endif

                    @if($popularTags->isNotEmpty())
                    <div class="sidebar-widget">
                        <h3 class="sidebar-widget-title">Tag Populer</h3>
                        <ul class="tag-list list-style">
                            @forelse ($popularTags as $popularTag)
                            <li><a href="{{route('news-tag-list.user', ['tag' => $popularTag->slug])}}">{{ $popularTag->name }}</a></li>
                            @empty
                            <div class="col-12">
                                <div class="d-flex justify-content-center">
                                    <div>
                                        <img src="{{ asset('assets/img/no-data/empty.png') }}" width="150px" alt="">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <h5>Tidak ada data</h5>
                                </div>
                            </div>
                            @endforelse
                        </ul>
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
