@extends('layouts.admin.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center pb-2">
                        <div class="me-3 pe-1">
                            <img src="{{ asset('admin/dist/images/profile/user-1.jpg') }}" alt=""
                                class="shadow-warning rounded-circle" width="110" height="110">
                        </div>
                        <div>
                            <h3 class="fw-semibold mt-3">Ardian Supriadi</h3>
                            <p>lorem oancone o nicygiu IVisu ub oiiuhcc oajicomec uhceb lorem oancone o nicygiu IVisu ub
                                oiiuhcc oajicomec uhceb aiuhec...
                                lorem oancone o nicygiu IVisu ub oiiuhcc oajicomec uhceb lorem oancone o nicygiu IVisu ub
                                oiiuhcc oajicomec uhceb aiuhec...</p>
                        </div>
                    </div>
                    <hr>

                    <div class="text-start" style="margin-top: 10px;">
                        <div class="d-flex align-items-center">
                            <div class="text-center px-3">
                                <h5 class="mt-2 text-card" id="animation-number0" style="color: #434343;">938</h5>
                                <span class="mb-3 text-card" style="color: #888888; font-size:15px;">Berita</span>
                            </div>
                            <div class="text-center px-4 border-end border-start">
                                <h5 class="mt-2 text-card" id="animation-number0" style="color: #434343;">3.586</h5>
                                <span class="mb-3 text-card" style="color: #888888; font-size:15px;">Pengikut</span>
                            </div>
                            <div class="text-center px-3 border-end">
                                <h5 class="mt-2 text-card" id="animation-number0" style="color: #434343;">2.659</h5>
                                <span class="mb-3 text-card" style="color: #888888; font-size:15px;">Mengikuti</span>
                            </div>
                            <div class="text-center px-3">
                                <h5 class="mt-2 text-card" id="animation-number0" style="color: #434343;">3.212</h5>
                                <span class="mb-3 text-card" style="color: #888888; font-size:15px;">Like</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h5><b>Berita yang ditulis:</b></h5>

    <div class="row">
        @foreach (range(1, 6) as $item)
            <div class="col-lg-4 pt-3">
                <div class="card">
                    <div style="position: relative; width: 100%; padding-top: 51.8%; overflow: hidden;">
                        <img src="{{ asset('admin/dist/images/crypto/c2.jpg') }}" class="card-img-top" alt=""
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                        <span class="mb-1 badge bg-warning p-2"
                            style="position: absolute; top: 15px; left: 15px;">Pendidikan</span>
                    </div>


                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ asset('admin/dist/images/profile/user-1.jpg') }}" class="rounded-circle"
                                width="33" height="33" alt="">
                            <h6 class="fw-semibold mb-0 ms-2" style="font-size: 16px">Betty Adams</h6>
                        </div>

                        <h4 class="mb-3"><b>Lorem ipsum dolor sit amet</b></h4>
                        <div class="d-flex no-block align-items-center mb-3">
                            <span class="d-flex align-items-center fw-semibold" style="color: #175A95">
                                <i class="ti ti-calendar me-1 fs-5"></i>
                                20 May 2023
                            </span>
                            <div class="ms-4">
                                <span class="d-flex align-items-center fw-semibold" style="color: #175A95">
                                    <i class="ti ti-calendar me-1 fs-5"></i>
                                    20 May 2023
                                </span>
                            </div>
                        </div>
                        <p class="mb-3 mt-2 text-muted">Apollo 11 was the spaceflight that landed the first humans,
                            Americans Neil Armstrong and Buzz Aldrin, on the Moon on July 20, 1969, at 20:18 UTC. Armstrong
                            became the first to step onto the....</p>

                        <button class="btn w-100" type="submit"
                            style="background-color: #175A95; color: white; border: none;">
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
