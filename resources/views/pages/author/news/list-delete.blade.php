@extends('layouts.author.app')

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <style>
        .news-card-a {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 2%;
            align-items: center;
            background-color: #fff;
        }

        .card-detail img {
            max-width: 100%;
            max-height: 100%;
            height: auto;
            border-radius: 1;
        }

        @media (max-width: 767px) {
            .card-detail img {
                width: 100%;
            }
        }
    </style>
@endsection

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Author | List Delete News</title>
</head>

@section('content')
    <div class="alert alert-warning d-flex align-items-center p-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 84 84" fill="none">
            <circle cx="42" cy="42" r="40" stroke="#FFAE1F " stroke-width="4" />
            <circle cx="42.1422" cy="59.5001" r="4.9" fill="#FFAE1F " />
            <path
                d="M36.7667 22.6095C36.6449 20.9852 37.93 19.6001 39.5589 19.6001L44.0975 19.6001C45.6988 19.6001 46.974 20.9406 46.894 22.5399L45.774 44.9399C45.6995 46.4301 44.4696 47.6001 42.9775 47.6001H41.2389C39.7737 47.6001 38.5563 46.4706 38.4467 45.0095L36.7667 22.6095Z"
                fill="#FFAE1F " />
        </svg>
        <div class="d-flex flex-column ms-3">
            <h5 class="text-warning" style="font-weight: 600;">Berita Dihapus</h5>
            <h6 class="text-warning" style="font-weight: bold; font-size:18px;">Berita yang dihapus akan hilang permanen
                secara otomatis setelah 30 hari</h6>
        </div>
    </div>
    <form class="d-flex gap-2">
        <div>
            <div class="position-relative d-flex">
                <div class="">
                    <input type="text" name="name" class="form-control search-chat py-2 ps-5" style="width: 200px"
                        id="search-name" placeholder="Search">
                    <i class="ti ti-search position-absolute top-50 translate-middle-y fs-6 text-dark ms-3"></i>
                </div>
            </div>
        </div>
    </form>

    <div class="tab-pane">
        <div class="card p-4 mt-4">
            <div class="row">
                <div class="col-lg-2">
                    <div class="mb-3">
                        <img src="" alt="" style="object-fit:cover;" width="100%" height="120">
                    </div>
                </div>
                <div class="col-md-12 col-lg-8">
                    <div class="">
                        <div class="order-md-1">
                            <h4>Judul</h4>
                            <p>Content</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-lg-2 mt-lg-0 ">
                    <div class="d-flex justify-content-end">
                        <div class="text-md-right mt-md-0">
                            <span class="badge fw-bold bg-light-warning fs-2 text-warning fs-5">Pending</span>
                        </div>
                    </div>

                    <div class="mt-3 d-flex justify-content-end">
                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 512 512">
                            <path
                                d="M368.005 272h-96v96h96v-96zm-32-208v32h-160V64h-48v32h-24.01c-22.002 0-40 17.998-40 40v272c0 22.002 17.998 40 40 40h304.01c22.002 0 40-17.998 40-40V136c0-22.002-17.998-40-40-40h-24V64h-48zm72 344h-304.01V196h304.01v212z"
                                fill="#0f4d89" />
                        </svg>
                        <p class="ms-2 fs-3">18-08-2024</p>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-sm m-1" style="background-color: #0F4D8A;">
                            <a href="${detail}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="23" viewBox="0 0 512 512">
                                    <path fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="32"
                                        d="M255.66 112c-77.94 0-157.89 45.11-220.83 135.33a16 16 0 0 0-.27 17.77C82.92 340.8 161.8 400 255.66 400c92.84 0 173.34-59.38 221.79-135.25a16.14 16.14 0 0 0 0-17.47C428.89 172.28 347.8 112 255.66 112" />
                                    <circle cx="256" cy="256" r="80" fill="none" stroke="#ffffff"
                                        stroke-miterlimit="10" stroke-width="32" />
                                </svg>
                            </a>
                        </button>

                        <a href="${edit}" class="btn btn-sm m-1" style="background-color: #FFD643;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="23" viewBox="0 0 512 512">
                                <path
                                    d="M64 368v80h80l235.727-235.729-79.999-79.998L64 368zm377.602-217.602c8.531-8.531 8.531-21.334 0-29.865l-50.135-50.135c-8.531-8.531-21.334-8.531-29.865 0l-39.468 39.469 79.999 79.998 39.469-39.467z"
                                    fill="#ffffff" />
                            </svg>
                        </a>
                        <button type="submit" class="btn btn-sm m-1 btn-delete" data-id=${data.id}
                            style="background-color: #C94F4F;"><svg xmlns="http://www.w3.org/2000/svg" width="18"
                                height="23" viewBox="0 0 512 512">
                                <path
                                    d="M128 405.429C128 428.846 147.198 448 170.667 448h170.667C364.802 448 384 428.846 384 405.429V160H128v245.429zM416 96h-80l-26.785-32H202.786L176 96H96v32h320V96z"
                                    fill="#ffffff" />
                            </svg></button>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
