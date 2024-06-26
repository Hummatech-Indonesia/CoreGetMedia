@extends('layouts.user.app')


@section('style')
<style>
    @media (min-width: 768px) {
        .icon-eye {
            margin-top: 12px;
        }
    }

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

<div class="sports-wrap ptb-100">
    <div class="container col-lg-12">
        <div class="row col-lg-12">
            <div class="col-lg-8">
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

                {{-- @if ($advertisement_mids)
                <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($advertisement_mids as $advertisement_mid)
                        <div class="carousel-item active" data-bs-interval="2000">
                            <img src="{{asset($advertisement_mid && $advertisement_mid->image != null ? 'storage/'.$advertisement_mid->image : "CONTOHIKLAN.png")}}" width="100%" height="181px" style="object-fit: cover" alt="" class="d-block w-100" alt="...">
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif --}}

                <div class="mb-5">
                    @php
                    $trending_id = $trendings->take(4)->where('news_views_count', '>', 0)->pluck('id');
                    $latest_news = $latests->whereNotIn('id', $trending_id)->paginate(5);
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
                            <p>{!! Illuminate\Support\Str::limit($new->description, $limit = 150, $end = '...') !!}</p>
                            <ul class="news-metainfo list-style">
                                <li><i class="fi fi-rr-calendar-minus"></i><a href="javascript:void(0)">{{ \Carbon\Carbon::parse($new->created_at)->translatedFormat('d F Y') }}</a>
                                </li>
                                <li><i class="fi fi-rr-eye"></i><a href="javascript:void(0)">{{ $new->news_views_count ? $new->news_views_count : '0' }}x
                                        dilihat</a></li>
                            </ul>
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
                <div>
                    <x-paginator :paginator="$latest_news" />
                </div>
            </div>

            <div class="col-lg-4">
                <div class="sidebar" style="width: 450px;">
                    @if($CategoryPopulars->isNotEmpty())
                        <div class="sidebar-widget" style="width: 450px">
                            <h3 class="sidebar-widget-title">Kategori Populer</h3>
                            <ul class="category-widget list-style">
                                @foreach ($CategoryPopulars as $category)
                                <li><a data-toggle="tooltip" data-placement="top" title="{{ $category->name }}" href="{{ route('categories.show.user', ['category' => $category->slug]) }}"><img src="{{ asset('assets/img/icons/arrow-right.svg') }}" alt="Image">{{ $category->name }}
                                        <span>({{ $category->news_categories_count }})</span></a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @php
                    $news_top_id = $newsTop->pluck('id');
                    $trending_news = $trendings->take(4)->whereNotin('id', $news_top_id);
                    @endphp

                    @if($trending_news->isNotEmpty())
                    <div class="sidebar-widget" style="width: 450px">
                        <h3 class="sidebar-widget-title">
                            Berita Populer
                        </h3>
                        @forelse ($trending_news as $trending)
                        @if ($trending->news_views_count > 0)
                        <div class="news-card-three">
                            <div class="news-card-img">
                                <img src="{{ asset('storage/' . $trending->image) }}" class="img-popular" alt="Image" />
                            </div>
                            <div class="news-card-info">
                                <h3><a href="{{ route('news.singlepost', ['news' => $trending->slug]) }}">{!!
                                        Illuminate\Support\Str::limit($trending->name, $limit = 45, $end = '...')
                                        !!}</a></h3>
                                <ul class="news-metainfo list-style d-flex">
                                    <li><i class="fi fi-rr-calendar-minus"></i><a href="javascript:void(0)" style="font-size: 14px;">{{ \Carbon\Carbon::parse($trending->date)->translatedFormat('d F Y') }}</a>
                                    </li>
                                    <li><i class="fi fi-rr-eye"></i><a href="javascript:void(0)" style="font-size: 14px;">{{ $trending->news_views_count ? $trending->news_views_count : '0' }}x
                                            dilihat</a></li>
                                </ul>
                            </div>
                        </div>
                        @endif
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
                </div>

                @if($popularTags->isNotEmpty())
                    <div class="sidebar-widget mt-5" style="width: 450px">
                        <h3 class="sidebar-widget-title">Tag Populer</h3>
                        <ul class="tag-list list-style">
                            @forelse ($popularTags as $popularTag)
                            <li><a href="{{route('news-tag-list.user', ['tag' => $popularTag->slug])}}">{{ $popularTag->name }}</a>
                            </li>
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
