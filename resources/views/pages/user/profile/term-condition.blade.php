@extends('layouts.user.sidebar')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <h2>Ketentuan & Persyaratan</h2>
        <a href="{{ route('author-registration') }}" class="btn btn-primary text-white">Kembali</a>
    </div>
    <div class="mt-5">
        <h4>Pengalaman</h4>
        <ul class="ps-4" style="list-style: disc">
            <li>Memiliki pengalaman magang atau bekerja di media massa.</li>
            <li>Memiliki portofolio tulisan berita yang baik.</li>
        </ul>
    </div>
    <div class="mt-5">
        <h4>Pendidikan dan Keterampilan</h4>
        <ul class="ps-4" style="list-style: disc">
            <li>Memiliki minimal pendidikan Diploma III jurnalistik atau komunikasi massa.</li>
            <li>Memiliki kemampuan menulis yang baik dan tata bahasa yang benar.</li>
            <li>Memiliki kemampuan riset dan investigasi yang baik.</li>
            <li>Memiliki kemampuan untuk bekerja secara cepat dan tepat waktu.</li>
            <li>Memiliki pengetahuan luas tentang berbagai isu terkini.</li>
            <li>Memiliki kemampuan untuk bekerja di bawah tekanan.</li>
        </ul>
    </div>
    <div class="mt-5">
        <h4>Keterampilan Lainnya</h4>
        <ul class="ps-4" style="list-style: disc">
            <li>Memiliki kemampuan interpersonal yang baik.</li>
            <li>Mampu bekerja dalam tim.</li>
            <li>Memiliki etos kerja yang tinggi.</li>
            <li>Memiliki komitmen dan dedikasi yang tinggi.</li>
        </ul>
    </div>
    <div class="mt-5">
        <h4>Proses Seleksi</h4>
        <ul class="ps-4" style="list-style: disc">
            <li>Lamaran kerja dapat diajukan melalui website atau email perusahaan media massa.</li>
            <li>Keputusan akhir mengenai penerimaan atau penolakan lamaran kerja akan diumumkan setelah proses seleksi selesai.</li>
        </ul>
    </div>
    <div class="mt-5">
        <h4>Tips</h4>
        <ul class="ps-4" style="list-style: disc">
            <li>Pastikan Anda memenuhi semua persyaratan yang diajukan oleh perusahaan media massa.</li>
            <li>Pastikan Anda memenuhi semua persyaratan yang diajukan oleh perusahaan media massa.</li>
            <li>Ikuti perkembangan berita terkini.</li>
            <li>Tunjukkan antusiasme dan passion Anda terhadap dunia jurnalistik.</li>
        </ul>
    </div>
    {{-- <div class="col-lg-12 mt-4">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch"
                id="flexSwitchCheckChecked">
            <label class="col-7 form-check-label" for="flexSwitchCheckChecked"
                style="color: #888888; font-size: larger;">Ya, saya sudah membaca, memahami dan
                setuju
                dengan
                ketentuan & persyaran untuk jadi penulis GetMedia</label>
        </div>
    </div> --}}
</div>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        feather.replace();
    </script>

    <script>
        const switchInput = document.querySelector('.form-check-input');
        const buttonKirim = document.querySelector('.button-kirim');
        switchInput.addEventListener('click', function () {
            if (switchInput.checked) {
                buttonKirim.style.backgroundColor = "#175A95"
            } else {
                buttonKirim.style.backgroundColor = "#d9d9d9"
            }
        })
    </script>
@endsection