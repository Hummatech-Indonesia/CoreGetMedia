@extends('layouts.user.app')

@section('content')
<div class="container-fluid mt-5 mb-5">
    <div class="row">

        <div class="card shadow-sm position-relative overflow-hidden" style="background-color: #175A95;">
            <div class="card-body px-4 py-4">
                <div class="row justify-content-between">
                    <div class="col-8 text-white">
                        <h4 class="fw-semibold mb-3 mt-2 text-white">Pengisian Iklan</h4>
                        <p>Layanan pengiklanan di getmedia.id</p>
                    </div>
                    <div class="col-3">
                        <div class="text-center mb-n4">
                            <img src="{{asset('assets/img/bg-ajuan.svg')}}" width="250px" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
