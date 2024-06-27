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
        <h2 class="breadcrumb-title">{{ $news->name }}</h2>
        <ul class="breadcrumb-menu list-style">
            <li><a href="/">Beranda</a></li>
            <li>{{ $news->name }}</li>
        </ul>
    </div>
</div>

<div class="sports-wrap ptb-100">
    <div class="container">
        <div class="row gx-55 gx-5">
            <div class="col-lg-8">
                @if ($news_tags->isNotEmpty())
                <div class="">
                    @forelse ($news_tags as $item)
                    <div class="news-card-four">
                        <div class="news-card-img">
                            <a href="{{ route('news.singlepost', ['news' => $item->slug]) }}"> <img
                                    src="{{asset('storage/' . $item->image)}}" alt="Image" width="100%"
                                    style="object-fit: cover" height="450" /></a>
                        </div>

                        <div class="news-card-info">
                            <h3><a href="{{ route('news.singlepost', ['news' => $item->slug]) }}" data-toggle="tooltip"
                                    data-placement="top"
                                    title="Apex Legends Season 11 Start Date, Time, & What To Expect" href="#">{!!
                                    Illuminate\Support\Str::limit(strip_tags($item->name), 300, '...') !!}
                                </a>
                            </h3>
                            <ul class="news-metainfo list-style">
                                <li><i class="fi fi-rr-calendar-minus"></i><a
                                        href="news-by-date.html">{{ \Carbon\Carbon::parse($item->date)->translatedFormat('d F Y') }}</a>
                                </li>
                                <li><i class="fi fi-rr-eye"></i><a
                                        href="news-by-dateus">{{ $item->news_views_count ? $item->news_views_count : '0' }}x
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
                @endif

                @if ($advertisement_mids)
                <div class="sidebar">
                    <img src="{{asset($advertisement_mids && $advertisement_mids->image != null ? 'storage/'.$advertisement_mids->image : "CONTOHIKLAN.png")}}" width="100%" height="181px" style="object-fit: cover" alt="">
                </div>
                @else
                <div class="bg_gray" style="width: 100%; height: 181px;">
                    <p class="text-center align-middle" style="line-height: 181px;">Advertisement</p>
                </div>
                @endif

                @if ($newsTags->isNotEmpty())
                <div class="mb-5">
                    <div class="d-flex justify-content-between mb-3 mt-3">
                        <h3>Terbaru</h3>
                        <a href="{{ route('all-tag-list.user', ['tag' => $news->slug]) }}">
                            <p>Lihat lainnya
                                <i><svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="m13.292 12l-4.6-4.6l.708-.708L14.708 12L9.4 17.308l-.708-.708z" />
                                    </svg></i>
                            </p>
                        </a>
                    </div>

                    @forelse ($newsTags as $data)
                    <div class="news-card-five">
                        <div class="news-card-img">
                            <a href="{{ route('news.singlepost', ['news' => $data->slug]) }}"><img
                                    src="{{asset('storage/' . $data->image)}}" alt="Image" class="img-all" /></a>
                            <a data-toggle="tooltip" data-placement="top" title="Sports" href="#"
                                class="news-cat">{{ $data->newsCategories[0]->category->name }}</a>
                        </div>
                        <div class="news-card-info">
                            <h3><a data-toggle="tooltip" data-placement="top" title="{{ $data->name }}"
                                    href="{{ route('news.singlepost', ['news' => $data->slug]) }}">{!!
                                    Illuminate\Support\Str::limit(strip_tags($data->name), 200, '...') !!}
                                </a>
                            </h3>
                            <p>{!! Illuminate\Support\Str::limit(strip_tags($data->description), 120, '...') !!}</p>
                            <ul class="news-metainfo list-style">
                                <li><i class="fi fi-rr-calendar-minus"></i><a
                                        href="javascript:void(0)">{{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y') }}</a>
                                </li>
                                <li><i class="fi fi-rr-eye"></i><a
                                        href="javascript:void(0)">{{ $data->news_views_count ? $data->news_views_count : '0' }}x
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
                @endif
                <x-paginator :paginator="$newsTags" />
            </div>

            <div class="col-lg-4">
                <div class="">
                    <div class="sidebar">
                        @if ($CategoryPopulars->isNotEmpty())
                        <div class="sidebar-widget" style="width: 450px">
                            <h3 class="sidebar-widget-title">Kategori Populer</h3>
                            <ul class="category-widget list-style">
                                @forelse ($CategoryPopulars as $category)
                                <li><a data-toggle="tooltip" data-placement="top" title="{{ $category->name }}"
                                        href="{{ route('categories.show.user', ['category' => $category->slug]) }}"><img
                                            src="{{ asset('assets/img/icons/arrow-right.svg') }}"
                                            alt="Image">{{ $category->name }}
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

                        @if ($trendings->isNotEmpty())
                        <div class="sidebar-widget" style="width: 450px">
                            <h3 class="sidebar-widget-title mt-4">
                                Berita Popular
                            </h3>
                            @forelse ($trendings as $trending)
                            <div class="news-card-three">
                                <div class="news-card-img" style="height: 100px; width: 100px">
                                    <img src="{{ asset('storage/' . $trending->image) }}" alt="Image"
                                        class="img-popular" />
                                </div>
                                <div class="news-card-info">
                                    <h3>
                                        <a href="{{ route('news.singlepost', ['news' => $trending->slug]) }}">
                                            {{ Illuminate\Support\Str::limit($trending->name, 45, '...') }}
                                        </a>
                                    </h3>

                                    <ul class="news-metainfo list-style d-flex">
                                        <li><i class="fi fi-rr-calendar-minus"></i><a href="news-by-date.html"
                                                style="font-size: 15px;">{{ \Carbon\Carbon::parse($trending->created_at)->translatedFormat('d F Y') }}</a></li>
                                        <li><i class="fi fi-rr-eye"></i><a href="news-by-dateus"
                                                style="font-size: 15px;">{{ $trending->news_views_count }}</a></li>
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
                    <div class="sidebar mt-3 mb-4" style="width: 450px">
                        <img src="{{asset($advertisement_rights && $advertisement_rights->image != null ? 'storage/'.$advertisement_rights->image : "CONTOHIKLAN.png")}}" width="100%" height="603px" style="object-fit: cover" alt="">
                    </div>
                    @else
                    <div class="sidebar mt-3 mb-4 bg_gray" style="width: 450px; height: 603px;">
                        <p class="text-center align-middle" style="line-height: 603px;">Advertisement</p>
                    </div>
                    @endif

                    @if ($popularTags->isNotEmpty())
                    <div class="sidebar-widget" style="width: 450px">
                        <h3 class="sidebar-widget-title">Tag Populer</h3>
                        <ul class="tag-list list-style">
                            @forelse ($popularTags as $popularTag)
                            <li><a
                                    href="{{route('news-tag-list.user', ['tag' => $popularTag->slug])}}">{{ $popularTag->name }}</a>
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
</div>
@endsection
