@extends('layouts.user.app')

@section('style')
<style>
    .btn-border-transparent:hover {
        background-color: #175A95 !important;
        border-color: #175A95 !important;
        color: #fff !important;
    }
    .dark-theme .fitur{
        color: #000000
    }
</style>
@endsection

@section('content')
<div class="text-center mx-2">
    <h3 class="pt-5">Menu Berlangganan</h3>
    <h6 class="pt-3">Jangan lewatkan - berlangganan hari ini dan mulailah menikmati manfaat sebagai pembaca yang berharga.</h6>
</div>

<div class="container mt-5 mb-5">
    <div class="row mx-4">
        @forelse ($packages as $package)
            <div class="col-md-4 mb-3">
                <div class="card" style="background-image: url({{asset('assets/card-light.png')}}); background-size: cover; background-position: center;">
                    <div class="card-body mx-4">
                            <span class="badge" style="background-color: #EAF8FF; color: #175A95;">Basic</span>
                        </h4>
                        <div class="mt-3">
                            <span class="fw-semibold"
                                style="color: #175A95; font-size: 25px;">{{ $package->name }}</span>
                        </div>
                        <p class="card-text pt-2 text-muted">{{ $package->description }}</p>
                        <h4 class="text-center pt-4">
                            <sup style="font-size: 20px; color: #175A95">Rp</sup>
                            <sub style="font-size: 36px; color: #175A95">{{ number_format($package->price, 0, ',', '.') }}</sub>
                            <sub class="text-muted" style="font-size: 14px">/ 1 bulan</sub>
                        </h4>
                        <h3 class="pt-5 text-center">
                            <a href="{{ route('subscribe-transaction') }}" class="btn btn-outline-primary rounded-3 btn-border-transparent w-100"
                            style="border-color: #175A95; color: #175A95;">Beli Sekarang</a>
                        </h3>
                        <div class="pt-4">
                            @foreach ($package->packageFeatures as $fitur)
                            <p style="font-size: 18px" class="text-muted">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                    <path fill="#28a745" d="m10 13.6l5.9-5.9q.275-.275.7-.275t.7.275t.275.7t-.275.7l-6.6 6.6q-.3.3-.7.3t-.7-.3l-2.6-2.6q-.275-.275-.275-.7t.275-.7t.7-.275t.7.275z"/>
                                </svg>
                                {{ $fitur->name_feature }}
                            </p>
                            <hr>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @empty
        @endforelse
    </div>
</div>

@endsection
