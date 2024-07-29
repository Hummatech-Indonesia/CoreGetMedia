@extends('layouts.user.app')

@section('title')
    All Tag
@endsection

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

    @media (min-width: 1024px) {
        .iklan-top {
            height: 250px;
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
        <h2 class="breadcrumb-title">{{ $news->name }} - Terbaru</h2>
        <ul class="breadcrumb-menu list-style">
            <li><a href="/">Beranda</a></li>
            <li>{{ $news->name }}</li>
        </ul>
    </div>
</div>

<div class="sports-wrap">
    <div class="container">
        {{-- @if ($advertisement_tops)
        <a href="{{ $advertisement_tops->url }}">
            <div class="mt-4 iklan-top" style="position: relative; width: 100%; height: 200px; overflow: hidden;">
                <img class="iklan-top-img" src="{{ asset($advertisement_tops && $advertisement_tops->image != null ? 'storage/'.$advertisement_tops->image : "CONTOHIKLAN.png") }}" width="100%" height="auto" alt="">
                <div style="width: 100%; background-color: rgba(0, 0, 0, 0.5); color: white; text-align: center; padding: 10px; box-sizing: border-box; position: relative; top: -50px;">
                    <a class="text-white" href="jascript:void(0)">Ingin baca berita tanpa iklan?</a> <a href="/subscribe" style="color: #7cadd8; text-decoration: underline;">Berlangganan</a>
                </div>
            </div>
        </a>
        @else
        <div class="container-fluid mt-5 mb-5 d-flex justify-content-center align-items-center bg_gray top-noiklan" style="height: 200px;">
            <p style="color: #22222278">Iklan</p>
        </div>
        @endif --}}
        <div class="row gx-55 gx-5 mt-5 mb-5">
            <div class="col-lg-8">
                <div>
                    @forelse ($newsTags as $item)
                    <div class="news-card-five">
                        <div class="news-card-img">
                            <a href="#"><img src="{{asset('storage/' . $item->image)}}" alt="Image" style="width: 850px; height: 170px; object-fit: cover;" /></a>
                            <a data-toggle="tooltip" data-placement="top" title="{{ $item->newsCategories[0]->category->name }}" href="#" class="news-cat">{{ $item->newsCategories[0]->category->name }}</a>
                        </div>
                        <div class="news-card-info">
                            <h3>
                                <a data-toggle="tooltip" data-placement="top" title="Muga Nemo Aptent Quaerat Explicabo Urna Ni Like Ange" href="{{ route('news.singlepost', ['news' => $item->slug]) }}">
                                    {!! Illuminate\Support\Str::limit(strip_tags($item->name), 200, '...') !!}
                                </a>
                            </h3>

                            <p>{!! Illuminate\Support\Str::limit(strip_tags($item->name), 200, '...') !!}</p>
                            <ul class="news-metainfo list-style">
                                <li><i class="fi fi-rr-calendar-minus"></i><a href="javascript:void(0)">{{ \Carbon\Carbon::parse($item->date)->translatedFormat('d F Y') }}</a>
                                </li>
                                <li><i class="fi fi-rr-eye"></i><a href="javascript:void(0)">{{ $item->news_views_count ? $item->news_views_count : '0' }}x
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

                {{-- @if ($advertisement_unders)
                <a href="{{ $advertisement_unders->url }}">
                    <div class="mt-4 mb-4">
                        <img src="{{asset($advertisement_unders && $advertisement_unders->image != null ? 'storage/'.$advertisement_unders->image : "CONTOHIKLAN.png")}}" width="100%" height="225" style="object-fit: cover;" alt="">
                    </div>
                </a>
                @else
                <div class="bg_gray" style="width: 100%; height: 181px;">
                    <p class="text-center align-middle" style="line-height: 181px;">Iklan</p>
                </div>
                @endif --}}

                <x-paginator :paginator="$newsTags" />

                {{-- <div class="text-center item-center d-flex justify-content-center"
                    style="background-color:#F6F6F6; width:100%;height:200px;">
                    <h5 class="mt-5">Iklan</h5>
                </div> --}}

            </div>

            <div class="col-lg-4">
                <div class="">
                    <div class="sidebar">
                        @if ($CategoryPopulars->isNotEmpty())
                        <div class="sidebar-widget" style="width: 450px">
                            <h3 class="sidebar-widget-title">Kategori Populer</h3>
                            <ul class="category-widget list-style">
                                @forelse ($CategoryPopulars as $category)
                                <li><a data-toggle="tooltip" data-placement="top" title="{{ $category->name }}" href="{{ route('categories.show.user', ['category' => $category->slug]) }}"><img src="{{ asset('assets/img/icons/arrow-right.svg') }}" alt="Image">{{ $category->name }}
                                        <span>({{ $category->news_categories_count }})</span></a></li>
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

                        {{-- @if ($advertisement_rights)
                        <a href="{{ $advertisement_rights->url }}">
                            <div class="sidebar mt-3 mb-4" style="width: 450px">
                                <img src="{{asset($advertisement_rights && $advertisement_rights->image != null ? 'storage/'.$advertisement_rights->image : "CONTOHIKLAN.png")}}" width="100%" height="603px" style="object-fit: cover" alt="">
                            </div>
                        </a>
                        @else
                        <div class="sidebar mt-3 mb-4 bg_gray" style="width: 450px; height: 603px;">
                            <p class="text-center align-middle" style="line-height: 603px;">Iklan</p>
                        </div>
                        @endif --}}

                        @if ($trendings->isNotEmpty())
                        <div class="sidebar-widget" style="width: 450px">
                            <h3 class="sidebar-widget-title">
                                Berita Popular
                            </h3>
                            @forelse ($trendings as $trending)
                            <div class="news-card-three">
                                <div class="news-card-img" style="height: 100px; width: 100px">
                                    <img src="{{ asset('storage/' . $trending->image) }}" alt="Image" class="img-popular" />
                                </div>
                                <div class="news-card-info">
                                    <h3>
                                        <a href="{{ route('news.singlepost', ['news' => $trending->slug]) }}">
                                            {{ Illuminate\Support\Str::limit($trending->name, 45, '...') }}
                                        </a>
                                    </h3>

                                    <ul class="news-metainfo list-style d-flex">
                                        <li><i class="fi fi-rr-calendar-minus"></i><a href="news-by-date.html" style="font-size: 15px;">15 Apr 2023</a></li>
                                        <li><i class="fi fi-rr-eye"></i><a href="news-by-dateus" style="font-size: 15px;">10</a></li>
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

                        @if ($popularTags->isNotEmpty())
                        <div class="sidebar-widget" style="width: 450px">
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
</div>
@endsection
