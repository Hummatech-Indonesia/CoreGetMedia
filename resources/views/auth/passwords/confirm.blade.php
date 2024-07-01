<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="content-type" content="text/html;charset=UTF-8"><!-- /Added by HTTrack -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <title>Reset Pw | GetMedia.Id</title>
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 5">
    <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
    <meta name="csrf-token" content="y0lzh53YmoH0xFgY2vFjhD4S1TOiq6lE58zbW7ec">
    <link rel="canonical" href="https://1.envato.market/vuexy_admin">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://task.hummatech.com/assets/vendor/css/pages/page-auth.css">
    <link rel="stylesheet" type="text/css" href="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/vendor/css/rtl/core.css?id=9dd8321ea008145745a7d78e072a6e36" class="template-customizer-core-css"><link rel="stylesheet" type="text/css" href="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/vendor/css/rtl/theme-default.css?id=a4539ede8fbe0ee4ea3a81f2c89f07d9" class="template-customizer-theme-css">
</head>


<body style="background-color: #FFFFFF">

    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5J3LMKC" height="0" width="0"
        style="display: none; visibility: hidden"></iframe></noscript>
<div class="authentication-wrapper authentication-cover authentication-bg">
    <div class="authentication-inner row">
        <div class="d-none d-lg-flex col-lg-7 p-0">
            <div class="auth-cover-bg auth-cover-bg-color" style="background-color: #F7F7F7">
                <div class="mt-3 ms-3">
                    <a href="{{route('login')}}">
                        <img src="{{asset('assets/img/auth/get-back.svg')}}" width="190" alt="">
                    </a>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <img src="{{asset('assets/img/auth/bg-forget-password.svg')}}" width="520px" alt="auth-login-cover" class="img-fluid my-5 " data-app-dark-img="illustrations/auth-login-illustration-dark.html">
                </div>
            </div>
        </div>
        <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4" >
            <div class="w-px-400 mx-auto">
                <h3 class="mb-3">Lupa Kata Sandi Anda?</h3>
                <p class="mb-5">Silakan masukkan alamat email yang terkait dengan akun Anda dan Kami akan mengirimkan email berisi tautan untuk mengatur ulang kata sandi Anda.</p>

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert mt-3 alert-danger alert-dismissible fade show" role="alert">
                            {{ $error }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endforeach
                @endif

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="password" class=" form-label">{{ __('Password') }}</label>
                        <input id="password" type="password" class=" form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    </div>
                    <div class="mb-3">
                        <label for="password" class=" form-label">{{ __('Confirm Password') }}</label>
                        <input id="password" type="password" class=" form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    </div>

                    <button type="submit" class="btn d-grid w-100 waves-effect text-white waves-light" style="background-color: #175A95;">
                        Kirim
                    </button>
                    <a href="/login" class="btn btn-md col-md-11 w-100 mt-4" style="background-color: #d5e3ef; color: #438ac8;">
                        Kembali Ke Login
                    </a>
                <input type="hidden">
                    </form>

                <div class="text-center mt-4">
                        <p>Belum memiliki akun?<a style="color: #438ac8" href="{{route('register')}}"> Daftar Sekarang!</a></p>
                </div>


            </div>
        </div>
    </div>
</div>


<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/swiper.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/aos.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById('password');
        var togglePasswordIcon = document.getElementById('togglePasswordIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            togglePasswordIcon.innerHTML =
                '<svg xmlns="http://www.w3.org/2000/svg" width="250" height="250" viewBox="0 0 256 256"><path fill="#737373" d="M245.48 125.57c-.34-.78-8.66-19.23-27.24-37.81C201 70.54 171.38 50 128 50S55 70.54 37.76 87.76c-18.58 18.58-26.9 37-27.24 37.81a6 6 0 0 0 0 4.88c.34.77 8.66 19.22 27.24 37.8C55 185.47 84.62 206 128 206s73-20.53 90.24-37.75c18.58-18.58 26.9-37 27.24-37.8a6 6 0 0 0 0-4.88M128 194c-31.38 0-58.78-11.42-81.45-33.93A134.77 134.77 0 0 1 22.69 128a134.56 134.56 0 0 1 23.86-32.06C69.22 73.42 96.62 62 128 62s58.78 11.42 81.45 33.94A134.56 134.56 0 0 1 233.31 128C226.94 140.21 195 194 128 194m0-112a46 46 0 1 0 46 46a46.06 46.06 0 0 0-46-46m0 80a34 34 0 1 1 34-34a34 34 0 0 1-34 34"/></svg>';
        } else {
            passwordInput.type = 'password';
            togglePasswordIcon.innerHTML =
                '<svg xmlns="http://www.w3.org/2000/svg" width="250" height="250" viewBox="0 0 256 256"><path fill="#737373" d="M53.92 34.62a8 8 0 1 0-11.84 10.76l19.24 21.17C25 88.84 9.38 123.2 8.69 124.76a8 8 0 0 0 0 6.5c.35.79 8.82 19.57 27.65 38.4C61.43 194.74 93.12 208 128 208a127.11 127.11 0 0 0 52.07-10.83l22 24.21a8 8 0 1 0 11.84-10.76Zm47.33 75.84l41.67 45.85a32 32 0 0 1-41.67-45.85M128 192c-30.78 0-57.67-11.19-79.93-33.25A133.16 133.16 0 0 1 25 128c4.69-8.79 19.66-33.39 47.35-49.38l18 19.75a48 48 0 0 0 63.66 70l14.73 16.2A112 112 0 0 1 128 192m6-95.43a8 8 0 0 1 3-15.72a48.16 48.16 0 0 1 38.77 42.64a8 8 0 0 1-7.22 8.71a6.39 6.39 0 0 1-.75 0a8 8 0 0 1-8-7.26A32.09 32.09 0 0 0 134 96.57m113.28 34.69c-.42.94-10.55 23.37-33.36 43.8a8 8 0 1 1-10.67-11.92a132.77 132.77 0 0 0 27.8-35.14a133.15 133.15 0 0 0-23.12-30.77C185.67 75.19 158.78 64 128 64a118.37 118.37 0 0 0-19.36 1.57A8 8 0 1 1 106 49.79A134 134 0 0 1 128 48c34.88 0 66.57 13.26 91.66 38.35c18.83 18.83 27.3 37.62 27.65 38.41a8 8 0 0 1 0 6.5Z"/></svg>';
        }
    }

</body>

</html>
