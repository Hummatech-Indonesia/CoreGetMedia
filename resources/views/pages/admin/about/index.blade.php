@extends('layouts.admin.app')

@section('title')
    About Get
@endsection

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

            <form action="{{ empty($data) ? route('about-getmedia.store') : route('about-getmedia.update', ['about' => $data->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(empty($data))
                    @method('POST')
                @else
                    @method('PUT')
                @endif
                <div class="gambar-iklan mt-4">
                    <label class="form-label" for="preview">Preview</label>
                    <div class="">
                        <img id="preview" src="{{ empty($data->image) ? asset('assets/img/getmedia-logo.png') : asset('storage/'. $data->image) }}" style="object-fit: cover;" width="240" height="160" alt="">
                    </div>
                </div>

            <div class="row mt-5 mb-5">
                <div class="col-md-12 col-lg-6 mb-4">
                    <label class="form-label" for="nomor">Logo</label>
                    <input type="file" id="image" name="image" placeholder="" onchange="previewImage(event)"
                            class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-12 col-lg-6 mb-4">
                    <label class="form-label" for="nomor">Slogan</label>
                    <input type="text" id="slogan" value="{{ empty($data) ? '' : $data->slogan }}" name="slogan" placeholder=""
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
                    <input type="text" id="email" value="{{ empty($data) ? '' : $data->email }}" name="email" placeholder=""
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
                    <input type="text" id="phone_number" value="{{ empty($data) ? '' : $data->phone_number }}" name="phone_number" placeholder=""
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
                    <input type="text" id="address" value="{{ empty($data) ? '' : $data->address }}" name="address" placeholder=""
                        class="form-control @error('address') is-invalid @enderror">
                    @error('address')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-12 col-lg-6 mb-4">
                    <label class="form-label" for="header">Header</label>
                    <input type="text" id="header" value="{{ empty($data) ? '' : $data->header }}" name="header" placeholder=""
                        class="form-control @error('header') is-invalid @enderror">
                    @error('header')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <h4><span class="me-2" style="color: #175A95; font-size: 20px">|</span>Tentang GetMedia</h4>
            <div class="row mt-4 mb-5">
                <div class="col-lg-12 mb-4">
                    <label class="form-label" for="description">Isi Berita</label>
                        <textarea id="content" name="description" placeholder="description" value="{{ empty($data) ? '' : $data->description }}"
                            class="form  @error('description') is-invalid @enderror">{{ empty($data) ? '' : $data->description }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert" style="color: red;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
            </div>

            <h4><span class="me-2" style="color: #175A95; font-size: 20px">|</span>Social Media</h4>

            <div class="row mt-5">
                <div class="col-md-12 col-lg-6 mb-4">
                    <label class="form-label" for="url_facebook">Url Facebook</label>
                    <input type="text" value="{{ empty($data) ? '' : $data->url_facebook }}" id="url_facebook" name="url_facebook" placeholder=""
                        class="form-control @error('url_facebook') is-invalid @enderror">
                    @error('url_facebook')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-12 col-lg-6 mb-4">
                    <label class="form-label" for="nomor">Url Twitter</label>
                    <input type="text" id="url_twitter" value="{{ empty($data) ? '' : $data->url_twitter }}" name="url_twitter" placeholder=""
                        class="form-control @error('url_twitter') is-invalid @enderror">
                    @error('url_twitter')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-12 col-lg-6 mb-4">
                    <label class="form-label" for="nomor">Url Instagram</label>
                    <input type="text" id="url_instagram" value="{{ empty($data) ? '' : $data->url_instagram }}" name="url_instagram" placeholder=""
                        class="form-control @error('url_instagram') is-invalid @enderror">
                    @error('url_instagram')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-12 col-lg-6 mb-4">
                    <label class="form-label" for="url_linkedin">Url Linkedin</label>
                    <input type="text" id="url_linkedin" value="{{ empty($data) ? '' : $data->url_linkedin }}" name="url_linkedin" placeholder=""
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
