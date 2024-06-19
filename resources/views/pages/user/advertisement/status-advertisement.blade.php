@extends('layouts.user.sidebar')

@section('content')
    <div class="">
        <div class="d-flex justify-content-between">
            <ul class="nav nav-underline" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="active-tab" data-bs-toggle="tab" href="#active" role="tab" aria-controls="active" aria-expanded="true">
                        <span>Semua</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="link1-tab" data-bs-toggle="tab" href="#link1" role="tab" aria-controls="link1">
                        <span>Diterima</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="link2-tab" data-bs-toggle="tab" href="#link2" role="tab" aria-controls="link2">
                        <span>Pending</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="link3-tab" data-bs-toggle="tab" href="#link3" role="tab" aria-controls="link2">
                        <span>Ditolak</span>
                    </a>
                </li>
            </ul>

            <div>

            </div>
        </div>
        <div class="tab-content tabcontent-border p-3" id="myTabContent">
            <div role="tabpanel" class="tab-pane fade show active" id="active" aria-labelledby="active-tab">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-2">
                                    <div class="mb-2">
                                        <img src="{{ asset('assets/img/news/news-12.webp') }}" alt="" width="290px" height="180px" class="w-100" style="width: 100%; object-fit:cover;">
                                    </div>
                                </div>
                                <div class="row col-md-12 col-lg-6">
                                    <div class="row col-lg-6">
                                        <div class="col-lg-6 mb-3">
                                            <div class="fs-4 text-black">
                                                Jenis Iklan:
                                            </div>
                                            <div class="fs-4 mt-2">Gambar</div>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <div class="fs-4 text-black">
                                                Tanggal Awal:
                                            </div>
                                            <div class="fs-4 mt-2">01/02/23</div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="fs-4 text-black">
                                                Halaman:
                                            </div>
                                            <div class="fs-4 mt-2">Dashboard</div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="fs-4 text-black">
                                                Tanggal Akhir:
                                            </div>
                                            <div class="fs-4 mt-2">01/02/23</div>
                                        </div>
                                    </div>
                    
                                    <div class="col-lg-6">
                                        <div class="col-lg-12">
                                            <div class="fs-4 text-black">
                                                URL:
                                            </div>
                                            <div class="fs-4 mt-2">https/adjbj</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                    
                                    <div class="d-flex justify-content-end gap-2">
                    
                                        <div class="d-flex justify-content-end">
                                            <div class="text-md-right">
                                                <span class="badge bg-light-danger text-danger fs-4 px-3 py-2">
                                                    Belum Dibayar
                                                </span>
                                            </div>
                                        </div>
                    
                                        {{-- @if ($advertisement->status === "pending")
                                            <div class="d-flex justify-content-end">
                                                <div class="text-md-right">
                                                    <span class="badge bg-light-warning text-warning fs-4 px-3 py-2">
                                                        Pending
                                                    </span>
                                                </div>
                                            </div>
                                        @elseif ($advertisement->status === "reject")
                                            <div class="d-flex justify-content-end">
                                                <div class="text-md-right">
                                                    <span class="badge bg-light-danger text-danger fs-4 px-3 py-2">
                                                        Ditolak
                                                    </span>
                                                </div>
                                            </div>
                                        @else
                                            <div class="d-flex justify-content-end">
                                                <div class="text-md-right">
                                                    <span class="badge bg-light-success text-success fs-4 px-3 py-2">
                                                        Ditolak
                                                    </span>
                                                </div>
                                            </div>
                                        @endif --}}
                                    </div>
                    
                                    <div class="d-flex mt-5 justify-content-end">
                                        Apr 25, 2024
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <a href="#" class="btn btn-sm m-1 mt-5" style="background-color: #5D87FF;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="30" viewBox="0 0 512 512">
                                                <path fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M255.66 112c-77.94 0-157.89 45.11-220.83 135.33a16 16 0 0 0-.27 17.77C82.92 340.8 161.8 400 255.66 400c92.84 0 173.34-59.38 221.79-135.25a16.14 16.14 0 0 0 0-17.47C428.89 172.28 347.8 112 255.66 112"/><circle cx="256" cy="256" r="80" fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="32"/>
                                            </svg>
                                        </a>
                                        <button class="btn btn-sm m-1 mt-5" style="background-color: #FFD643;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24"><path fill="#ffffff" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h8.925l-2 2H5v14h14v-6.95l2-2V19q0 .825-.587 1.413T19 21zm4-6v-4.25l9.175-9.175q.3-.3.675-.45t.75-.15q.4 0 .763.15t.662.45L22.425 3q.275.3.425.663T23 4.4q0 .375-.137.738t-.438.662L13.25 15zM21.025 4.4l-1.4-1.4zM11 13h1.4l5.8-5.8l-.7-.7l-.725-.7L11 11.575zm6.5-6.5l-.725-.7zl.7.7z"/></svg>
                                        </button>
                    
                                        <form method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm m-1 mt-5" style="background-color: #C94F4F;"><svg xmlns="http://www.w3.org/2000/svg" width="23" height="30" viewBox="0 0 512 512"><path d="M128 405.429C128 428.846 147.198 448 170.667 448h170.667C364.802 448 384 428.846 384 405.429V160H128v245.429zM416 96h-80l-26.785-32H202.786L176 96H96v32h320V96z" fill="#ffffff"/></svg></button>
                                        </form>
                                    </div>
                                </div>
                    
                            </div>
                        </div>
    
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="link1" role="tabpanel" aria-labelledby="link1-tab">
                <p>
                    Food truck fixie locavore, accusamus mcsweeney's marfa
                    nulla single-origin coffee squid. Exercitation +1
                    labore velit, blog sartorial PBR leggings next level
                    wes anderson artisan four loko farm-to-table craft
                    beer twee. Qui photo booth letterpress, commodo enim
                    craft beer mlkshk aliquip jean shorts ullamco ad vinyl
                    cillum PBR. Homo nostrud organic, assumenda labore
                    aesthetic magna delectus mollit. Keytar helvetica VHS
                    salvia yr, vero magna velit sapiente labore stumptown.
                    Vegan fanny pack odio cillum wes anderson 8-bit,
                    sustainable jean shorts beard ut DIY ethical culpa
                    terry richardson biodiesel. Art party scenester
                    stumptown, tumblr butcher vero sint qui sapiente
                    accusamus tattooed echo park.
                </p>
            </div>
            <di<div class="tab-pane fade" id="link2" role="tabpanel" aria-labelledby="link2-tab">
                <p>
                    Etsy mixtape wayfarers, ethical wes anderson tofu
                    before they sold out mcsweeney's organic lomo retro
                    fanny pack lo-fi farm-to-table readymade. Messenger
                    bag gentrify pitchfork tattooed craft beer, iphone
                    skateboard locavore carles etsy salvia banksy hoodie
                    helvetica. DIY synth PBR banksy irony. Leggings
                    gentrify squid 8-bit cred pitchfork. Williamsburg banh
                    mi whatever gluten-free, carles pitchfork biodiesel
                    fixie etsy retro mlkshk vice blog. Scenester cred you
                    probably haven't heard of them, vinyl craft beer blog
                    stumptown. Pitchfork sustainable tofu synth chambray
                    yr.
                </p>
        </div>
    </div>
@endsection
