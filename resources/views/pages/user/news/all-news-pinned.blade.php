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

    .img-all{
        width: 400px;
        height: 250px;
        object-fit: cover;
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
    <div class="sports-wrap ptb-100">
        <div class="container">
            <div class="row gx-55 gx-5">
                <div class="col-lg-8">
                    <div class="row">

                        @forelse ($newsPin as $item)
                        <div class="col-md-6">
                            <div class="news-card-six">
                                <div class="news-card-img">
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="" class="img-all">
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
                                        <li>
                                            <button type="submit" style="background: transparent;border:transparent" class="like">
                                                <svg class="last mb-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                                    <path fill="#E93314" d="M18 21H7V8l7-7l1.25 1.25q.175.175.288.475t.112.575v.35L14.55 8H21q.8 0 1.4.6T23 10v2q0 .175-.05.375t-.1.375l-3 7.05q-.225.5-.75.85T18 21m-9-2h9l3-7v-2h-9l1.35-5.5L9 8.85zM9 8.85V19zM7 8v2H4v9h3v2H2V8z" />
                                                </svg>
                                            </button>
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
            <x-paginator :paginator="$newsPin"/>

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
