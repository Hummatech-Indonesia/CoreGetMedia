@extends('layouts.user.sidebar')

@section('style')
    <style>
        @media (max-width: 768px) {
            .text-mobile {
                font-size: 9px;
            }
            .text-mobile-header {
                font-size: 12px;
            }
            .img-mobile-payment{
                width: 50px;
            }
            .mobile-status{
                text-align: end;
            }
        }
    </style>
@endsection

@section('content')
<div class="">
    <h4><b>Riwayat Penarikan</b></h4>
    <div class="d-flex mt-4 mb-3 justify-content-between flex-wrap">

        <div class="d-flex mb-2">
            <h5 class="me-2">Total Jumlah Penarikan :</h5>
            <div class="d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="me-1 mb-2" width="21" height="21" viewBox="0 0 24 24">
                    <g fill="none">
                        <path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/>
                        <path fill="#222222" d="M12 3c2.314 0 4.456.408 6.058 1.109c.799.35 1.509.792 2.032 1.334c.485.5.845 1.128.902 1.856L21 7.5v10c0 .814-.381 1.51-.91 2.057c-.523.542-1.233.984-2.032 1.334C16.456 21.591 14.314 22 12 22c-2.314 0-4.456-.408-6.058-1.109c-.799-.35-1.509-.792-2.032-1.334c-.485-.5-.845-1.128-.902-1.856L3 17.5v-10c0-.814.381-1.51.91-2.057c.523-.542 1.233-.984 2.032-1.334C7.544 3.409 9.686 3 12 3m7 12.407a8.13 8.13 0 0 1-.942.484C16.456 16.591 14.314 17 12 17c-2.314 0-4.456-.408-6.058-1.109A8.122 8.122 0 0 1 5 15.407V17.5c0 .152.066.376.348.667c.286.296.748.608 1.396.892C8.038 19.625 9.895 20 12 20c2.105 0 3.962-.375 5.256-.941c.648-.284 1.11-.596 1.396-.892c.282-.29.348-.515.348-.667zm0-5a8.13 8.13 0 0 1-.942.484C16.456 11.591 14.314 12 12 12c-2.314 0-4.456-.408-6.058-1.109A8.122 8.122 0 0 1 5 10.407V12.5c0 .152.066.376.348.667c.286.296.748.608 1.396.892C8.038 14.625 9.895 15 12 15c2.105 0 3.962-.375 5.256-.941c.648-.284 1.11-.596 1.396-.892c.282-.29.348-.515.348-.667zM12 5c-2.105 0-3.962.375-5.256.941c-.648.284-1.11.596-1.396.892c-.282.29-.348.515-.348.667c0 .152.066.376.348.667c.286.296.748.608 1.396.892C8.038 9.625 9.895 10 12 10c2.105 0 3.962-.375 5.256-.941c.648-.284 1.11-.596 1.396-.892c.282-.29.348-.515.348-.667c0-.152-.066-.376-.348-.667c-.286-.296-.748-.608-1.396-.892C15.962 5.375 14.105 5 12 5"/></g></svg>
                <h5>10.000</h5>
            </div>
        </div>

        <div class="">
            <a href="{{route('user.tukar.coin')}}" class="btn btn-md text-white" style="background-color: #FCD52F;">
                Tarik Saldo Sekarang
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                    <path fill="#ffffff" d="M12.6 12L8.7 8.1q-.275-.275-.275-.7t.275-.7t.7-.275t.7.275l4.6 4.6q.15.15.213.325t.062.375t-.062.375t-.213.325l-4.6 4.6q-.275.275-.7.275t-.7-.275t-.275-.7t.275-.7z"/>
                </svg>
            </a>
        </div>
    </div>


    <div class="card p-4">
        <div class="d-flex justify-content-between flex-column flex-md-row text-mobile">
            <div class="d-flex">
                <div>
                    <h5 class="text-mobile-header">Penarikan Saldo</h5>
                    <div class="mt-3">
                        <p>tanggal : 01/01/2022</p>
                    </div>
                </div>

                <div class="ms-4 ms-md-5 me-4 me-md-5" style="border-left: 1px solid #888888"></div>

                <div>
                    <p>Nominal: 50 Koin / Rp.500</p>
                    <div class="d-flex align-items-center">
                        <span>Metode Penarikan :</span>
                        <img src="{{asset('assets/img/wallet-dana.svg')}}" class="ms-2 img-mobile-payment" width="60px" alt="">
                    </div>
                </div>
            </div>
            <div class="text-end mt-3 mt-md-0">
                <h5 class="mb-0 text-mobile-header">Berhasil</h5>
            </div>
        </div>
    </div>


</div>
@endsection
