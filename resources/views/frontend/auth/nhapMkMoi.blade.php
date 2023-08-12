<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>Đổi Mật Khẩu</title>
    <link rel="icon" href="images/fav.png" type="image/png" sizes="16x16">

    <link rel="stylesheet" href="{{ asset('theme_frontend/css/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme_frontend/css/weather-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('theme_frontend/css/weather-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme_frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('theme_frontend/css/color.css') }}">
    <link rel="stylesheet" href="{{ asset('theme_frontend/css/responsive.css') }}">

</head>

<body>
    <div style="margin-top: 60px" class="container">
        <div class="row">
            <div class="col-6 mx-auto">
                {{-- <form>
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                      <input type="email" id="form2Example1" class="form-control" />
                      <label class="form-label" for="form2Example1">Email address</label>
                    </div>
                  
                    <!-- Password input -->
                    <div class="form-outline mb-4">
                      <input type="password" id="form2Example2" class="form-control" />
                      <label class="form-label" for="form2Example2">Password</label>
                    </div>
                    <!-- Submit button -->
                    <button type="button" class="btn btn-primary btn-block mb-4">Sign in</button>                    
                </form> --}}


                <form method="post" autocomplete="off">
                    @csrf
                    <div class="form-outline mb-4">
                        <label class="form-label">Email</label>
                        <input class="form-control" type="email" placeholder="********" name="email" value="{{ old('email') }}">
                        @error('email')
                        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('email') }}</small>
                        @enderror
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label">Mật khẩu mới</label>
                        <input class="form-control" type="password" placeholder="********" name="password" value="{{ old('password') }}">
                        @error('password')
                        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('password') }}</small>
                        @enderror
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label">Xác nhận mật khẩu</label>
                        <input class="form-control" type="password"  placeholder="********" name="password_confirmation" value="{{ old('password_confirmation') }}">
                        @error('password_confirmation')
                        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('password_confirmation') }}</small>
                        @enderror
                    </div>
                    <div>
                        <button class="btn btn-primary btn-block mb-4" type="submit" data-ripple="">Lưu thông tin</button>
                    </div>
                </form>
                



            </div>
        </div>
    </div>
</body>
</html>

{{-- <form class="we-form" method="post" autocomplete="off">
    @csrf
    <div style="margin-bottom: 10px">
        <label>Email</label>
        <input type="email" placeholder="********" name="email" value="{{ old('email') }}">
        @error('email')
        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('email') }}</small>
        @enderror
    </div>
    <div style="margin-bottom: 10px">
        <label>Mật khẩu mới</label>
        <input type="password" placeholder="********" name="password" value="{{ old('password') }}">
        @error('password')
        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('password') }}</small>
        @enderror
    </div>
    <div style="margin-bottom: 10px">
        <label>Xác nhận mật khẩu</label>
        <input type="password"  placeholder="********" name="password_confirmation" value="{{ old('password_confirmation') }}">
        @error('password_confirmation')
        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('password_confirmation') }}</small>
        @enderror
    </div>
    <div>
        <button type="submit" data-ripple="">Lưu thông tin</button>
    </div>
</form> --}}
