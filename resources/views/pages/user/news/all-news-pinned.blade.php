@extends('layouts.user.app')

@section('style')
<style>
    .news-card-post {
        box-shadow: 0 5px 2px rgba(0, 0, 0, 0.1);
        border: 1px solid #f4f4f4;
        padding: 2%;
        border-radius: 10px;
    }

    .card-category {
        box-shadow: 0 5px 2px rgba(0, 0, 0, 0.1);
        border: 1px solid #f4f4f4;
        padding: 4%;
        border-radius: 10px;
    }

    .breadcrumb-menu li:after {
        color: #000;
    }

    .img-all {
        width: 400px;
        height: 250px;
        object-fit: cover;
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
        <h2 class="breadcrumb-title">Semua Berita Pin - Terbaru</h2>
        <ul class="breadcrumb-menu list-style">
            <li><a href="/">Beranda</a></li>
            <li>Semua Berita</li>
        </ul>
    </div>
</div>


<div class="">
    <div class="modal fade searchModal" id="searchModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <input type="text" class="form-control" placeholder="Search here....">
                    <button type="submit"><i class="fi fi-rr-search"></i></button>
                </form>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ri-close-line"></i></button>
            </div>
        </div>
    </div>
</div>

<div class="">
    <div class="sports-wrap">
        <div class="container">
            @if ($advertisement_tops)
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
            @endif
            <div class="row gx-55 gx-5">
                <div class="col-lg-8">
                    <div class="row">

                        @forelse ($newsPin as $item)
                        <div class="col-md-6">
                            <div class="news-card-six">
                                <div class="news-card-img">
                                    <img src="{{ asset($item->image ? 'storage/' . $item->image : 'assets/blank-img.jpg') }}" alt="" class="img-all">
                                    <a href="{{ route('categories.show.user', ['category' => $item->newsCategories[0]->category->slug]) }}" class="news-cat">{{ $item->newsCategories[0]->category->name }}</a>
                                </div>
                                <div class="news-card-info">

                                    <h3><a data-toggle="tooltip" data-placement="top" title="{{ $item->name }}" href="{{ route('news.singlepost', ['news' => $item->slug]) }}">{!! Illuminate\Support\Str::limit($item->name, $limit = 200, $end = '...') !!}</a>
                                    </h3>
                                    <ul class="news-metainfo list-style">
                                        <li><i class="fi fi-rr-calendar-minus"></i><a href="javascript:void(0)">{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</a>
                                        </li>
                                        <li><i class="fi fi-rr-eye"></i>
                                            {{ $item->news_views_count }}x dilihat
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        @empty
                        <div class="d-flex justify-content-center">
                            <div>
                                <img src="{{ asset('assets/img/no-data.svg') }}" alt="">
                            </div>
                        </div>
                        <div class="text-center">
                            <h4>Tidak ada data</h4>
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
                    <x-paginator :paginator="$newsPin" />

                </div>

                <div class="col-lg-4">
                    <div class="sidebar">
                        @if ($CategoryPopulars->isNotEmpty())
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

                        <div class="sidebar-widget" style="width: 450px">
                            <h3 class="sidebar-widget-title">Tag Populer</h3>
                            <ul class="tag-list list-style">
                                @forelse ($popularTags as $popularTag)
                                <li><a href="{{ route('news-tag-list.user', ['tag' => $popularTag->slug]) }}">{{ $popularTag->name }}</a></li>
                                @empty
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
