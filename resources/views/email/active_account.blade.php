<p>Xin chào <b>{{ $user->name }}</b></p>
<p>Chào mừng bạn đến với mạng xã hội thú cưng, tài khoản của bạn vừa được tạo, xin vui lòng cập nhật và kích hoạt
    tài khoản <a href="{{ route('get.verify_account',['token' => $user->verification_token]) }}">tại đây</a>
</p>

<p>Cảm ơn,</p><br>
<p>{{ config('app.name') }}</p>
