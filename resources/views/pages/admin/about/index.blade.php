@extends('layouts.admin.app')

@section('style')
<link rel="stylesheet" href="{{ asset('admin/dist/libs/summernote/dist/summernote-lite.min.css') }}">

@endsection
@section('content')
<div class="card shadow-sm position-relative overflow-hidden" style="background-color: #175A95;">
    <div class="card-body px-4 py-4">
        <div class="row justify-content-between">
            <div class="col-8 text-white">
                <h4 class="fw-semibold mb-3 mt-2 text-white">Tentang Getmedia</h4>
                <p>Info dan Slogan yang akan tampil di footer</p>
            </div>
            <div class="col-3">
                <div class="text-center mb-n5">
                    <img src="{{ asset('assets/img/bg-ajuan.svg') }}" width="250px" alt="" class="img-fluid mb-n4">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h4><span class="me-2" style="color: #175A95; font-size: 20px">|</span>Kontak</h4>

        {{-- @if ($data)
            <form action="{{ route('contact.update.about', ['contact' => $data->id]) }}" method="POST" enctype="multipart/form-data">
            @method('put')
        @else
            <form action="{{ route('contact.create.about') }}" method="POST" enctype="multipart/form-data">
            @method('post')
        @endif
            @csrf --}}
            <form action="#" method="POST" enctype="multipart/form-data">
                @method('post')

            <div class="gambar-iklan mb-4 d-flex justify-content-start mt-4">
                <img id="preview" src="{{ asset('assets/img/logo/get-media-light.svg') }}" 
                {{-- @endif
                @if ($data)
                    class=""
                @else
                    class="hide"
                @endif
                style="object-fit: cover; border: transparent;"
                    width="290" height="140" alt="" --}}
                    >
            </div>

            <div class="row mt-5 mb-5">
                <div class="col-md-12 col-lg-6 mb-4">
                    <label class="form-label" for="nomor">Logo</label>
                    <input type="file" id="logo" name="logo" placeholder="" onchange="previewImage(event)"
                            class="form-control @error('logo') is-invalid @enderror">
                    @error('logo')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-12 col-lg-6 mb-4">
                    <label class="form-label" for="nomor">Slogan</label>
                    <input type="text" id="slogan" name="slogan" placeholder=""
                        {{-- @if ($data)
                            value="{{ $data->slogan }}"
                        @endif --}}
                        class="form-control @error('slogan') is-invalid @enderror"
                        >
                    @error('slogan')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-12 col-lg-6 mb-4">
                    <label class="form-label" for="nomor">Email</label>
                    <input type="text" id="email" name="email" placeholder=""
                        {{-- @if ($data)
                            value="{{ $data->email }}"
                        @endif --}}
                        class="form-control @error('email') is-invalid @enderror"
                        >
                    @error('email')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="col-md-12 col-lg-6 mb-4">
                    <label class="form-label" for="nomor">Nomor Telepon</label>
                    <input type="text" id="phoone_number" name="phone_number" placeholder=""
                        {{-- @if ($data)
                            value="{{ $data->phone_number }}"
                        @endif --}}
                        class="form-control @error('phone_number') is-invalid @enderror"
                        >
                    @error('phone_number')
                    <span class="invalid-feedback" role="alert" style="color: red;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md-12 col-lg-6 mb-4">
                    <label class="form-label" for="nomor">Alamat</label>
                    <input type="text" id="address" name="address" placeholder=""
                        {{-- @if ($data)
                            value="{{ $data->address }}"
                        @endif --}}
                        class="form-control @error('address') is-invalid @enderror">
                    @error('address')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <h4><span class="me-2" style="color: #175A95; font-size: 20px">|</span>Tentang GetMedia</h4>
            <div class="row mt-4 mb-5">
                <div class="col-lg-12 mb-4">
                    <label class="form-label" for="content">Isi Berita</label>
                        <textarea id="content" name="content" placeholder="content" value="{{ old('content') }}"
                            class="form  @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
                        @error('content')
                            <span class="invalid-feedback" role="alert" style="color: red;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
            </div>

            <h4><span class="me-2" style="color: #175A95; font-size: 20px">|</span>Social Media</h4>

            <div class="row mt-5">
                <div class="col-md-12 col-lg-6 mb-4">
                    <label class="form-label" for="nomor">Url Facebook</label>
                    <input type="text" id="url_facebook" name="url_facebook" placeholder=""
                        {{-- @if ($data)
                            value="{{ $data->url_facebook }}"
                        @endif --}}
                        class="form-control @error('url_facebook') is-invalid @enderror">
                    @error('url_facebook')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-12 col-lg-6 mb-4">
                    <label class="form-label" for="nomor">Url Twitter</label>
                    <input type="text" id="url_twitter" name="url_twitter" placeholder=""
                        {{-- @if ($data)
                            value="{{ $data->url_twitter }}"
                        @endif --}}
                        class="form-control @error('url_twitter') is-invalid @enderror">
                    @error('url_twitter')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-12 col-lg-6 mb-4">
                    <label class="form-label" for="nomor">Url Instagram</label>
                    <input type="text" id="url_instagram" name="url_instagram" placeholder=""
                        {{-- @if ($data)
                            value="{{ $data->url_instagram }}"
                        @endif --}}
                        class="form-control @error('url_instagram') is-invalid @enderror">
                    @error('url_instagram')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-12 col-lg-6 mb-4">
                    <label class="form-label" for="nomor">Url Linkedin</label>
                    <input type="text" id="url_linkedin" name="url_linkedin" placeholder=""
                        {{-- @if ($data)
                            value="{{ $data->url_linkedin }}"
                        @endif --}}
                        class="form-control @error('url_linkedin') is-invalid @enderror">
                    @error('url_linkedin')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4 mb-3">
                <button type="submit" class="btn btn-success">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')
<script src="{{ asset('admin/dist/libs/summernote/dist/summernote-lite.min.js') }}"></script>

    <script>
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

        $(document).ready(function() {
            $('#content').summernote({
                blockquoteBreakingLevel: 2,
                height: 250,
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
@endsection
