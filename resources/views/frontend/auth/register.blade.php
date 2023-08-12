
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>Đăng ký</title>

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
        <div class="gap no-gap signin whitish medium-opacity register">
            <div class="bg-image" style="background-image:url('/theme_frontend/images/resources/theme-bg.jpg')"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="big-ad">
                            <figure><img src="" alt=""></figure>
                            <h1>Welcome to the Petto</h1>

                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="we-login-register">
                            <div class="form-title">
                                <i class="fa fa-key"></i>Sign Up
                                <span>Sign Up now and meet the awesome friends around the world.</span>
                            </div>


                            
                            <form class="we-form" method="POST">
                                @csrf
                                <input type="text" placeholder="Name" name="name" required value="{{ old('name') }}">
                                <div class="">
                                    @error('name')
                                        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('name') }}</small>
                                    @enderror
                                </div>
                                <input type="email" placeholder="Email" name="email" required value="{{ old('email') }}">
                                <div class="">
                                    @error('email')
                                        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('email') }}</small>
                                    @enderror
                                </div>
                                <input type="password" name="password" placeholder="Password" required value="{{ old('password') }}">
                                <div class="">
                                    @error('password')
                                        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('password') }}</small>
                                    @enderror
                                </div>
                                <input type="text" placeholder="0987..." name="phone" required value="{{ old('phone') }}">
                                <div class="">
                                    @error('phone')
                                        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('phone') }}</small>
                                    @enderror
                                </div>


                                {{-- <input type="text" placeholder="Name" name="name" required>
                                <input type="email" placeholder="Email" name="email" required>
                                <input type="password" name="password" placeholder="Password" required>
                                <input type="text" placeholder="0987..." name="phone" required> --}}
                                <button type="submit" data-ripple="">Đăng ký</button>
                            </form>
                            <span>already have an account? <a class="we-account underline" href="{{ route('get.login') }}" title="">Login</a></span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</div>

<script src="js/main.min.js"></script>
<script src="js/script.js"></script>
</body>

</html>
