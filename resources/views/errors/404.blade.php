@extends('layouts.user.app')
@section('content')
<div class="container-fluid mt-5">
    <div class="col-sm-12 text-center">
        <img src="{{ asset('assets/img/error/404getMedia.png')}}" alt="404Error" style="width: 30%; height: auto;">
        <h3 class="h4 mt-4" style="color: #888888;">404 Not Found </h3>
        <h4 class="text-center mt-4">Maaf Kami Tidak Menemukan Halaman Yang Anda Cari</h4>
        <a href="/" type="button" class="btn mt-4 text-white"
            style="background-color: #DD1818; padding-inline: 25px; padding-block: 10px;">Kembali ke
            beranda</a>
    </div>
</div>

<div class="pt-2">
    <div class="my-5 text-center">
        <h2>Berita Direkomendasikan</h2>
        <div class="mx-auto" style="width: 200px; height: 5px; border-radius: 20px; background-color: #175A95;"></div>
    </div>
    <div class="container">
        <div class="row gx-55 gx-5">
            <div class="col-lg-12">
                <div class="row justify-content-center">
                    @forelse ($news_latest->take(10) as $news)
                        <div class="col-md-6">
                            <div class="news-card-five">
                                <div class="news-card-img">
                                    @if ($news->image != null && Storage::disk('public')->exists($news->image))
                                        <img src="{{ asset('storage/' . $news->image) }}" class="w-100" style="height: 120px; object-fit: cover;" alt="Image" />
                                    @else
                                        <img src="{{ asset('assets/blank-img.jpg') }}" class="w-100" style="height: 120px; object-fit: cover;" alt="Image" />
                                    @endif
                                    <a href="{{ route('categories.show.user', $news->newsCategories[0]->category->slug) }}" class="news-cat">{{ $news->newsCategories[0]->category->name }}</a>
                                </div>
                                <div class="news-card-info">
                                    <h3><a href="{{ route('news.singlepost', $news->slug) }}">{{ Illuminate\Support\Str::limit($news->name, 30, '...') }}</a>
                                    </h3>
                                    <p style="max-height: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: block; ">{!! Str::limit(strip_tags($news->description), 130) !!}</p>
                                    <ul class="news-metainfo list-style">
                                        <li><i class="fi fi-rr-calendar-minus"></i><a href="javascript:void(0)">{{ \Carbon\Carbon::parse($news->date)->locale('id_ID')->isoFormat('D MMMM Y') }}</a></li>
                                        <li><i class="fi fi-rr-eye"></i>{{ $news->newsViews()->count() }}x dilihat</li>
                                    </ul>
                                </div>
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
        </div>
    </div>
    @endsection
