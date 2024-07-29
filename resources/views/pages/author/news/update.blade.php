@extends('layouts.author.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/dist/libs/summernote/dist/summernote-lite.min.css') }}">
    <style>
        .note-editable ul {
            list-style: disc !important;
            list-style-position: inside !important;
        }

        .note-editable ol {
            list-style: decimal !important;
            list-style-position: inside !important;
        }

        @media (max-width: 768px) {
            .bg-mobile {
                width: 150px;
            }
        }
    </style>
@endsection

<head>
    <title>
        Author | Update News
    </title>
</head>

@section('content')
    <div class="card shadow-sm position-relative overflow-hidden" style="background-color: #175A95;">
        <div class="card-body px-4 py-4">
            <div class="row justify-content-between">
                <div class="col-8 text-white">
                    <h4 class="fw-semibold mb-3 mt-2 text-white">Pengisian Berita</h4>
                    <p>Tuliskan beritamu di getmedia</p>
                </div>
                <div class="col-3">
                    <div class="text-center mb-n4">
                        <img src="{{ asset('assets/img/bg-ajuan.svg') }}" width="250px" alt="" class="bg-mobile">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="alert d-flex align-items-center bg-light-primary p-4 border-primary border-1">
        <svg class="ms-4" xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 84 84" fill="none">
            <circle cx="42" cy="42" r="40" stroke="#175A95 " stroke-width="4" />
            <circle cx="42.1422" cy="59.5001" r="4.9" fill="#175A95 " />
            <path
                d="M36.7667 22.6095C36.6449 20.9852 37.93 19.6001 39.5589 19.6001L44.0975 19.6001C45.6988 19.6001 46.974 20.9406 46.894 22.5399L45.774 44.9399C45.6995 46.4301 44.4696 47.6001 42.9775 47.6001H41.2389C39.7737 47.6001 38.5563 46.4706 38.4467 45.0095L36.7667 22.6095Z"
                fill="#175A95 " />
        </svg>
        <div class="d-flex flex-column ms-5">
            <h5 style="font-weight: 700; color: #175A95">Ketentuan dan Persyaratan</h5>
            <h6 style="font-weight: 500; font-size:16px; margin-top:3px; color: #175A95">Pastikan anda membaca dibawah ini ketentuan & Persyaratan dibawah ini sebelum mengunggah artikel</h6>
            <h6 style="font-weight: 500; font-size:16px; margin-top:10px; color: #175A95">Baca selengkapnya dibawah ini:</h6>
            <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                class="btn btn-sm text-white d-flex justify-content-start"
                style="margin-top: 10px; width: 163px;background-color: #175A95;">
                Ketentuan & Persyaratan
            </button>
        </div>
    </div>

    {{-- <div class="ms-1">
        <h5>Baca ketentuan dan persyaratan sembelum mengunggah berita</h5>
    </div> --}}

    <form id="myForm" action="{{ route('update.news', ['id' => $news->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="ms-1 mt-5 d-flex justify-content-between">
            <h5>Isi form dibawah ini untuk mengunggah berita</h5>
        </div>

        <div class="row">
            <div class="col-12 col-md-6 col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <h3 for="" class="form-label">Thumbnail</h3>
                        @php
                            $fileExtension = pathinfo($news->image, PATHINFO_EXTENSION);
                            $videoExtensions = ['mp4', 'avi', 'mov'];
                            $imageExtensions = ['png', 'jpg', 'jpeg', 'gif', 'webp'];
                        @endphp
                        <div class="gambar-iklan mb-4 d-flex justify-content-center">
                            @if (in_array($fileExtension, $videoExtensions))
                                <video id="preview" src="{{ asset('storage/'. $news->image) }}" style="object-fit: cover; border: transparent;" width="350" height="200" controls></video>
                            @elseif(in_array($fileExtension, $imageExtensions))
                                <img id="preview" src="{{ asset('storage/'.$news->image) }}" style="object-fit: cover; border: transparent;" width="350" height="200" alt="">
                            @endif
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <label for="image-upload" class="btn btn-primary">
                                Unggah
                            </label>
                            <input type="file" name="image" id="image-upload" class="hide" value="{{ $news->image }}"
                                onchange="previewImage(event)">
                        </div>
                        <div class="d-flex justify-content-center">
                            <p class="text-muted mt-3">File dengan format Jpg atau Png </p>
                        </div>

                        @error('photo')
                            <span class="invalid-feedback" role="alert" style="color: red;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h3 class="mb-3">Detail Lainya</h3>
                        <div class="col-lg-12 mb-4">
                            <label class="form-label" for="password_confirmation">Kategori</label>
                            <select id="category_id"
                                class="select2 form-control category @error('category') is-invalid @enderror"
                                name="category[]" multiple aria-label="Default select example">
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $newsCategory->contains('category_id', $category->id) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                            </select>
                            @error('category')
                                <span class="invalid-feedback" role="alert" style="color: red">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-12 mb-4">
                            <div class="mt-2" style="max-width: 100%;">
                                <label class="form-label" for="password_confirmation">Sub Kategori</label>
                                <select id="sub_category_id"
                                    class="form-control sub-category select2 @error('sub_category') is-invalid @enderror"
                                    name="sub_category[]" multiple="true" aria-label="Default select example">

                                    @if ($subcategories != null)
                                        <option >pilih sub kategori</option>
                                        @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}" {{ $newsSubcategory->contains('sub_category_id', $subcategory->id) ? 'selected' : '' }}>
                                            {{ $subcategory->name }}
                                        </option>
                                        @endforeach
                                    @endif

                                </select>
                                @error('sub_category')
                                    <span class="invalid-feedback" role="alert" style="color: red">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12 mb-4">
                            <label class="form-label" for="password_confirmation">Tanggal Upload</label>
                            <input type="datetime-local" id="upload_date" name="date" placeholder="date"
                                value="{{ \Carbon\Carbon::parse($news->date)->format('Y-m-d\TH:i') }}"
                                class="form-control @error('upload_date') is-invalid @enderror">
                            @error('upload_date')
                                <span class="invalid-feedback" role="alert" style="color: red">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label class="form-label" for="password_confirmation">Tags</label>
                            <select class="form-control @error('tag') is-invalid @enderror select2 tags" name="tag[]"
                                multiple="multiple">
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->name }}" {{ $newsTags->pluck('tags_id')->contains($tag->id) ? 'selected' : '' }}>
                                    {{ $tag->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tag')
                                <span class="invalid-feedback" role="alert" style="color: red;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <h3 class="mb-3">Isi Berita</h3>
                        <div>
                            <div class="col-lg-12 mb-4">
                                <label class="form-label" for="nomor">Judul Berita</label>
                                <input type="text" id="name" name="name" placeholder="name"
                                    value="{{ $news->name }}" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <span class="invalid-feedback" role="alert" style="color: red;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-12 mb-4" style="height: auto;">
                                <label class="form-label" for="content">Isi Berita</label>
                                <textarea id="content" name="description" placeholder="content" value="{{ $news->description }}"
                                    class="form  @error('content') is-invalid @enderror">{{ $news->description }}</textarea>
                                @error('content')
                                    <span class="invalid-feedback" role="alert" style="color: red;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <a href="{{ auth()->user()->roles->pluck('name')[0] == "admin" ? route('news-list.admin') : route('news.list.author') }}" class="btn btn-danger m-2">
                Batal
            </a>
            <button type="submit" class="btn btn-primary m-2" id="submitButton1">
                Update
            </button>
            @if ($news->deleted_at != null)
                <button type="submit" class="btn btn-success m-2" id="submitButton2">
                    Upload
                </button>
            @endif
        </div>
        </div>
    </form>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="staticBackdropLabel">Ketentuan & Persyaratan</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card shadow-none border p-3">
                        <p>Ketentuan dan Persyaratan Sebelum Menulis Berita</p>
                        <ol>
                            <li>Keaslian dan Orisinalitas
                                <ul class="ms-4" style="list-style-type:disc">
                                    <li>Berita harus asli dan bukan hasil plagiasi</li>
                                    <li>Berita harus ditulis dengan gaya bahasa yang profesional dan mudah dipahami.</li>
                                    <li>Berita harus bebas dari unsur SARA, fitnah, dan konten negatif lainnya.</li>
                                </ul>
                            </li>
                            <li>Keakuratan dan Kebenaran
                                <ul class="ms-4" style="list-style-type:disc">
                                    <li>Berita harus akurat dan berdasarkan fakta yang dapat diverifikasi.</li>
                                    <li>Sumber informasi harus jelas dan kredibel.</li>
                                    <li>Berita harus faktual dan tidak memihak.</li>
                                </ul>
                            </li>
                            <li>Keseimbangan
                                <ul class="ms-4" style="list-style-type:disc">
                                    <li>Berita harus menyajikan informasi secara seimbang dan tidak memihak.</li>
                                    <li>Berita harus memberikan ruang kepada semua pihak yang terkait untuk menyampaikan
                                        pendapatnya.</li>
                                </ul>
                            </li>
                            <li>Objektivitas
                                <ul class="ms-4" style="list-style-type:disc">
                                    <li>Berita harus ditulis secara objektif dan tidak memihak.</li>
                                    <li>Penulis berita harus menghindari opini dan prasangka pribadi.</li>
                                </ul>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        style="background-color: #C94F4F;">Kembali</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('admin/dist/libs/summernote/dist/summernote-lite.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            var quote = $('<blockquote class="quote">hello<footer>world</footer></blockquote>')[0];

            $('#content').summernote({
                blockquoteBreakingLevel: 2,
                height: 520,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph', 'height']],
                    ['table', ['table']],
                    ['link', ['link']],
                    ['picture', ['picture']],
                    ['video', ['video']],
                    ['codeview', ['codeview']],
                    ['help', ['help']],
                    ['insert', ['ul', 'blockquote']] // Include Blockquote button in 'insert' dropdown
                ],

                fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Impact',
                    'Lucida Grande', 'Tahoma', 'Times New Roman', 'Verdana'
                ],
                fontNamesIgnoreCheck: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica',
                    'Impact', 'Lucida Grande', 'Tahoma', 'Times New Roman', 'Verdana'
                ]

            });
        });
    </script>

    <script>
        $('.category').change(function() {
            // getSubCategory($(this).val())
            var selectedCategories = $(this).val();
            getSubCategory(selectedCategories);
        })

        function getSubCategory(ids) {
            $.ajax({
                url: "get-sub-category",
                method: "GET",
                data: {
                    category_ids: ids
                },
                dataType: "JSON",
                beforeSend: function() {
                    $('.sub-category').html('')
                },
                success: function(response) {
                    $.each(response.data, function(index, data) {
                        $('.sub-category').append('<option value="' + data.id + '">' + data.name +
                            '</option>');
                    });
                }
            })
        }
    </script>

    <script>
    var today = new Date();
    var year = today.getFullYear();
    var month = ('0' + (today.getMonth() + 1)).slice(-2);
    var day = ('0' + today.getDate()).slice(-2);
    var hours = ('0' + today.getHours()).slice(-2);
    var minutes = ('0' + today.getMinutes()).slice(-2);

    var formattedDate = year + '-' + month + '-' + day + 'T' + hours + ':' + minutes;
    document.getElementById('upload_date').value = formattedDate;

    $(".tags").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    })

    function previewImage(event) {
        var input = event.target;
        var previewImg = document.getElementById('preview');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewImg.classList.remove('hide');
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            previewImg.src = '';
            previewImg.classList.add('hide');
        }
    }
    </script>

    <script>
        var form = document.getElementById('myForm');
        var submitButton1 = document.getElementById('submitButton1');
        var submitButton2 = document.getElementById('submitButton2');

        submitButton1.addEventListener('click', function() {
            form.action = "{{ route('update.news', ['id' => $news->id]) }}";
            form.method = "post";

            // Set the hidden _method input to 'put'
            var methodInput = document.createElement('input');
            methodInput.setAttribute('type', 'hidden');
            methodInput.setAttribute('name', '_method');
            methodInput.setAttribute('value', 'put');
            form.appendChild(methodInput);
        });

        submitButton2.addEventListener('click', function() {
            form.action = "{{ route('publish.news', ['id' => $news->id]) }}";
            form.method = "post";

            // Remove the hidden _method input if it exists
            var existingMethodInput = document.querySelector('input[name="_method"]');
            if (existingMethodInput) {
                form.removeChild(existingMethodInput);
            }
        });
    </script>
@endsection
