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

    .img-all {
        width: 400px;
        height: 250px;
        object-fit: cover;
    }

</style>
@endsection

@section('content')
<div class="col-lg-12">
    <div class="breadcrumb-wrap">
        <h2 class="breadcrumb-title">Semua Berita - Terbaru</h2>
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
    <div class="sports-wrap ptb-100">
        <div class="container">
            <div class="row gx-55 gx-5">
                <div class="col-lg-8">
                    <div class="row">
                        @forelse ($news as $item)
                            <div class="col-md-6">
                                <div class="news-card-six">
                                    <div class="news-card-img">
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="" class="img-all">
                                        @foreach ($subCategories as $subCategory)
                                        <p class="tag">
                                            <a href="{{ route('categories.show.user', ['category' => $item->newsCategories[0]->category->slug]) }}" class="news-cat">{{ $item->newsCategories[0]->category->name }}</a>
                                        </p>
                                        @endforeach
                                    </div>
                                    <div class="news-card-info">

                                        <h3><a href="{{ route('news.singlepost', $item->slug) }}">{{$item->name}}</a>
                                        </h3>
                                        <ul class="news-metainfo list-style">
                                            <li><i class="fi fi-rr-calendar-minus"></i><a href="javascript:void(0)">{{ \Carbon\Carbon::parse($item->date)->translatedFormat('d F Y') }}</a>
                                            </li>
                                            <li><i class="fi fi-rr-eye"></i>{{$item->news_views_count}} x dilihat
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
                    <x-paginator :paginator="$news"/>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="sidebar-widget"style="width: 450px">
                            <h3 class="sidebar-widget-title">Kategori Populer</h3>
                            <ul class="category-widget list-style">
                                @foreach ($CategoryPopulars as $category)
                                <li><a data-toggle="tooltip" data-placement="top" title="{{ $category->name }}" href="{{ route('categories.show.user', ['category' => $category->slug]) }}"><img src="{{ asset('assets/img/icons/arrow-right.svg') }}" alt="Image">{{ $category->name }}
                                        <span>({{ $category->news_categories_count }})</span></a></li>
                                @endforeach
                            </ul>
                        </div>

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
