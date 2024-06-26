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

</style>
@endsection

@section('content')
<div class="col-lg-12">
    <div class="breadcrumb-wrap">
        <h2 class="breadcrumb-title">{{ $subCategory->name }} - Terbaru</h2>
        <ul class="breadcrumb-menu list-style">
            <li><a href="/">Beranda</a></li>
            <li>{{ $subCategory->name }}</li>
        </ul>
    </div>
</div>

<div class="sports-wrap ptb-100">
    <div class="container">
        <div class="row gx-55 gx-5">
            <div class="col-lg-8">
                <div class="mb-5">
                    @forelse ($news as $data)
                    <div class="news-card-five">
                        <div class="news-card-img">
                            <a href="javascript:void(0)">
                                <img src="{{asset('storage/' . $data->image)}}" alt="Image" style="width: 850px; height: 170px; object-fit: cover;" />
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="{{ $data->newsCategories[0]->category->name }}" href="{{ route('categories.show.user', ['category' => $data->slug]) }}" class="news-cat">{{ $data->newsCategories[0]->category->name }}</a>
                        </div>
                        <div class="news-card-info">
                            <h3><a data-toggle="tooltip" data-placement="top" title="Muga Nemo Aptent Quaerat Explicabo Urna Ni Like Ange" href="{{ route('news.singlepost', ['news' => $data->slug]) }}">{!!
                                    Illuminate\Support\Str::limit(strip_tags($data->name), 200, '...') !!}
                                </a>
                            </h3>
                            <p>{!! Illuminate\Support\Str::limit(strip_tags($data->description), 200, '...') !!}</p>
                            <ul class="news-metainfo list-style">
                                <li><i class="fi fi-rr-calendar-minus"></i><a href="javascript:void(0)">{{ $data->date }}</a></li>
                                <li><i class="fi fi-rr-eye"></i><a href="javascript:void(0)">{{ $data->news_views_count ? $data->news_views_count : '0' }}x
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
                <div class="mt-4 mb-4">
                    <img src="{{asset($advertisement_unders && $advertisement_unders->image != null ? 'storage/'.$advertisement_unders->image : "CONTOHIKLAN.png")}}" width="100%" height="225" style="object-fit: cover;" alt="">
                </div>
                @endif --}}

                <x-paginator :paginator="$news" />
            </div>

            <div class="col-lg-4">
                <div class="">
                    <div class="sidebar">
                        @if($popularCategory->isNotEmpty())
                        <div class="sidebar-widget" style="width: 450px">
                            <h3 class="sidebar-widget-title">Kategori Populer</h3>
                            <ul class="category-widget list-style">
                                @forelse ($popularCategory as $item)
                                <li>
                                    <a data-toggle="tooltip" data-placement="top" title="{{ $item->name }}" href="{{ route('categories.show.user', ['category' => $item->slug]) }}"><img src="{{ asset('assets/img/icons/arrow-right.svg') }}" alt="Image">{{ $item->name }}
                                        <span>( {{ $item->news_categories_count }} )</span>
                                    </a>
                                </li>
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
                            </ul>
                        </div>
                        @endif

                        {{-- @if ($advertisement_rights)
                        <div class="sidebar mt-3 mb-4" style="width: 450px">
                            <img src="{{asset($advertisement_rights && $advertisement_rights->image != null ? 'storage/'.$advertisement_rights->image : "CONTOHIKLAN.png")}}" width="100%" height="603px" style="object-fit: cover" alt="">
                        </div>
                        @endif --}}

                        @php
                        $subTop = $newsTop->pluck('id');
                        $trending_news = $newsPopulars->whereNotIn('id', $subTop);
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
                                    <h3>
                                        <a href="{{ route('news.singlepost', ['news' => $trending->slug]) }}">
                                            {{ Illuminate\Support\Str::limit($trending->name, 45, '...') }}
                                        </a>
                                    </h3>

                                    <ul class="news-metainfo list-style d-flex">
                                        <li><i class="fi fi-rr-calendar-minus"></i><a href="javascript:void(0)" style="font-size: 14px;">{{ \Carbon\Carbon::parse($trending->date)->translatedFormat('d F Y') }}</a>
                                        </li>
                                        <li><i class="fi fi-rr-eye"></i><a href="javscript:void(0)" style="font-size: 14px;">{{ $trending->news_views_count ? $trending->news_views_count : '0' }}x
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

                        @if($popularTags->isNotEmpty())
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
