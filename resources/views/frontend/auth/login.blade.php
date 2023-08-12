
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>Đăng nhập</title>
    <link rel="icon" href="images/fav.png" type="image/png" sizes="16x16">

    <link rel="stylesheet" href="{{ asset('theme_frontend/css/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme_frontend/css/weather-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('theme_frontend/css/weather-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme_frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('theme_frontend/css/color.css') }}">
    <link rel="stylesheet" href="{{ asset('theme_frontend/css/responsive.css') }}">

</head>
<body>
<div class="www-layout">
    <section>
        <div class="gap no-gap signin whitish medium-opacity">
            <div class="bg-image" style="background-image:url('/theme_frontend/images/resources/theme-bg.jpg')"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="big-ad">
                            <figure><img style="width: 100px; height: 40px" src="/theme_frontend/images/petto_logo.png" alt=""></figure>
                            <h1>Welcome to the Petto</h1>
                            <p>
                                Tham gia để kết nối với cộng đồng yêu thú cưng khắp mọi nơi.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="we-login-register">
                            <div class="form-title">
                                <i class="fa fa-key"></i>login
                                <span>sign in now and meet the awesome Friends around the world.</span>
                            </div>
                            <form class="we-form" method="post" autocomplete="off">
                                @csrf
                                <input name="email" required type="text" placeholder="Email" value="{{ old('email') }}">
                                @error('email')
                                    <small id="emailHelp" class="form-text text-danger">{{ $errors->first('email') }}</small>
                                @enderror
                                <input name="password" required type="password" placeholder="Password" value="{{ old('password') }}">
                                @error('password')
                                    <small id="emailHelp" class="form-text text-danger">{{ $errors->first('password') }}</small>
                                @enderror
                                <button type="submit" data-ripple="">Sign in</button>
                            </form>
                            <span><a href="{{ route('get.nhapMK') }}">Forgot password?</a></span>
                            <span>don't have an account? <a class="we-account underline" href="{{ route('get.register') }}" title="">Đăng ký</a></span>
                        </div>
                    </div>

                </div>
            </div>

            {{-- @if ($error)
                <div class="alert alert-success">
                    {{ $error }}
                </div>
            @endif --}}
            
        </div>
    </section>

</div>

<script src="{{ asset('theme_frontend/js/main.min.js') }}"></script>
<script src="{{ asset('theme_frontend/js/script.js') }}"></script>
</body>

</html>
