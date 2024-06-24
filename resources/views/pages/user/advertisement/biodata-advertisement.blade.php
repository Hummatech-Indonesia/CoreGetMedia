@extends(auth()->user()->hasRole('author') ? 'layouts.author.app' : 'layouts.user.sidebar')

@section('content')
<div class="card bg-light-info shadow-sm position-relative overflow-hidden">
    <div class="card-body px-4 py-4">
        <div class="row align-items-center">
            <div class="col-lg-1 col-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" viewBox="0 0 56 56">
                    <path fill="#175A95" d="M28 51.906c13.055 0 23.906-10.828 23.906-23.906c0-13.055-10.875-23.906-23.93-23.906C14.899 4.094 4.095 14.945 4.095 28c0 13.078 10.828 23.906 23.906 23.906m0-3.984C16.937 47.922 8.1 39.062 8.1 28c0-11.04 8.813-19.922 19.876-19.922c11.039 0 19.921 8.883 19.945 19.922c.023 11.063-8.883 19.922-19.922 19.922m-.023-15.68c1.124 0 1.757-.633 1.78-1.851l.352-12.375c.024-1.196-.914-2.086-2.156-2.086c-1.266 0-2.156.867-2.133 2.062l.305 12.399c.023 1.195.68 1.851 1.852 1.851m0 7.617c1.335 0 2.53-1.078 2.53-2.437c0-1.383-1.171-2.438-2.53-2.438c-1.383 0-2.532 1.078-2.532 2.438c0 1.336 1.172 2.437 2.532 2.437" />
                </svg>
            </div>
            <div class="col-lg-7 col-8">
                <h4 class="fw-semibold mb-3 mb-lg-0" style="color: #175A95;">Pengajuan Berita</h4>
                <p class="mb-0" style="color: #175A95;">proses pengunggahan berita ada biaya yang dikenakan untuk memuat konten tersebut. Harap dipertimbangkan dan disiapkan sebelum melanjutkan</p>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-between mb-3">
    <div class="">
        <h4 class="">Biodata</h4>
    </div>
    

    <div class="">
        <a href="{{ route('upload-advertisement') }}" class="btn btn-md px-3 text-white" style="background-color: #175A95">
            Selanjutnya
        </a>
    </div>
</div>

<div class="card p-4 pb-5">
    <h5 class="mt-2 text-black">Pastikan biodata di isi dengan tepat</h5>

    <div class="row mt-4">
        <div class="col-md-12 col-lg-6 mb-5">
            <label class="form-label" for="nomor">Nama Lengkap</label>
            <input type="text" id="name" name="name" placeholder="nama" value="{{ auth()->user()->name }}" class="form-control @error('name') is-invalid @enderror" readonly>
            @error('name')
            <span class="invalid-feedback" role="alert" style="color: red;">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-12 col-lg-6 mb-5">
            <label class="form-label" for="nomor">Email</label>
            <input type="text" id="name" name="name" placeholder="email" value="{{ auth()->user()->email }}" class="form-control @error('name') is-invalid @enderror" readonly>
            @error('name')
            <span class="invalid-feedback" role="alert" style="color: red;">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-12 col-lg-6 mb-5">
            <label class="form-label" for="nomor">Nomor Telepon</label>
            <input type="text" id="name" name="name" placeholder="nomor telepon" value="{{ auth()->user()->phone_number }}" class="form-control @error('name') is-invalid @enderror" readonly>
            @error('name')
            <span class="invalid-feedback" role="alert" style="color: red;">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

</div>

@endsection