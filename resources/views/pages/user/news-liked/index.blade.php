@extends(auth()->user()->hasRole('author') ? 'layouts.author.app' : 'layouts.user.sidebar')

@section('content')

<div class="card shadow-sm position-relative overflow-hidden"  style="background-color: #175A95;">
    <div class="card-body px-4 py-4">
      <div class="row justify-content-between">
        <div class="col-8 text-white">
          <h4 class="fw-semibold mb-3 mt-2 text-white">Berita Disukai</h4>
            <p>Teruskan membaca berita, Perluas pegetahuan</p>
        </div>
        <div class="col-3">
          <div class="text-center mb-n4">
            <img src="{{asset('assets/img/news-bg.svg')}}" width="200px" alt="" class="img-fluid">
          </div>
        </div>
      </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="d-flex gap-2 mb-5">
            {{-- <select class="form-select" id="opsi-latest" style="width: 200px">
                <option value="">Tampilkan semua</option>
                <option value="terbaru">Terbaru</option>
                <option value="terlama">Terlama</option>
            </select> --}}
            <form action="">
            <div class="input-group" style="width: 250px">
                <select class="form-select" name="filter">
                    <option value="terbaru">Terbaru</option>
                    <option value="terlama">Terlama</option>
                    <option value="">Tampilkan Semua</option>
                </select>
                <button type="submit" class="btn btn-outline-primary">
                    Pilih
                </button>
            </div>
            </form>
        </div>

        <div class="row">
            @forelse ($newsLike as $newsLike)

                <div class="col-md-12 col-lg-6 mb-3">
                    <div class="mb-2">
                        <div class="row g-2">
                            <div class="col-lg-4 col-md-4">
                                <img src="{{ asset('storage/' . $newsLike->image) }}" class="img-responsive" height="150" style="width: 100%; object-fit:cover;" alt="">
                            </div>
                            <div class="col-md-8 col-md-8">
                                <div class="card-body p-2">
                                    <h3 class="card-text">
                                        {{ Str::limit($newsLike->name, 50) }}
                                    </h3>
                                    <p>{!! Str::limit(strip_tags($newsLike->description), 150) !!}</p>
                                    <div class="d-flex gap-3 align-items-center ms-0 mt-4">
                                        <p class="card-text m-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path fill="#dd1818" d="M5 22q-.825 0-1.412-.587T3 20V6q0-.825.588-1.412T5 4h1V2h2v2h8V2h2v2h1q.825 0 1.413.588T21 6v14q0 .825-.587 1.413T19 22zm0-2h14V10H5zM5 8h14V6H5zm0 0V6z"/></svg>
                                            <small class="fs-3 ms-1">
                                                {{ \Carbon\Carbon::parse($newsLike->date)->locale('id_ID')->isoFormat('D MMMM Y') }}
                                            </small>
                                        </p>
                                        <p class="card-text"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                                <path fill="#DD1818" d="M12 9a3 3 0 0 1 3 3a3 3 0 0 1-3 3a3 3 0 0 1-3-3a3 3 0 0 1 3-3m0-4.5c5 0 9.27 3.11 11 7.5c-1.73 4.39-6 7.5-11 7.5S2.73 16.39 1 12c1.73-4.39 6-7.5 11-7.5M3.18 12a9.821 9.821 0 0 0 17.64 0a9.821 9.821 0 0 0-17.64 0" />
                                            </svg><small class="mt-1 ms-1 fs-3">{{ $newsLike->news_views_count }}</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center">
                    <img src="{{ asset('assets/Empty-cuate.png') }}" alt="" class="w-25">
                    <p>Tidak ada data</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
