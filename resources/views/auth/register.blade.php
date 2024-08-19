<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Đăng Ký</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/.min.css' rel='stylesheet'>
    <link href="{{ asset('template/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href={{ asset('/css/toast.css') }}>
    <link href="{{ asset('template/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('template/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
</head>

<body>
    <div id="toast" class="toast"></div>
    <div class="wrapper">
        <form action="{{ route('auth.register') }}" method="post" class="m-t" role="form"
            enctype="multipart/form-data">
            @csrf
            <h1><strong>Đăng Ký</strong></h1>
            @if (session('error'))
                <div class="alert alert-danger">
                    {!! session('error') !!}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {!! session('success') !!}
                </div>
            @endif
            <div class="input-box">
                <input type="text" name="fullname" class="form-control" placeholder="Nhập họ và tên"
                    value="{{ old('fullname') }}">
                <i class='bx bxs-user'></i>
                @if ($errors->has('fullname'))
                    <span class="text-danger ds-alert">* {{ $errors->first('fullname') }}</span>
                @endif
            </div>
            <div class="input-box">
                <input type="text" name="email" class="form-control" placeholder="Nhập email"
                    value="{{ old('email') }}">
                <i class='bx bxs-envelope'></i>
                @if ($errors->has('email'))
                    <span class="text-danger ds-alert">* {{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="input-box">
                <input type="text" name="phone" class="form-control" placeholder="Nhập số điện thoại"
                    value="{{ old('phone') }}">
                <i class='bx bxs-phone'></i>
                @if ($errors->has('phone'))
                    <span class="text-danger ds-alert">* {{ $errors->first('phone') }}</span>
                @endif
            </div>
            <div class="input-box">
                <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu"
                    value="{{ old('password') }}">
                <i class='bx bxs-lock-alt'></i>
                @if ($errors->has('password'))
                    <span class="text-danger ds-alert">* {{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="input-box">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu"
                    value="{{ old('password_confirmation') }}" id="password_confirmation">
                <i class='bx bxs-lock-alt'></i>
                @if ($errors->has('password.confirmed'))
                    <span class="text-danger ds-alert">* {{ $errors->first('password_confirmation') }}</span>
                @endif
            </div>
            <button type="submit" class="btn-auth">Đăng Ký</button>
            <a href="{{ route('home.index') }}" class="btn-back">Về Trang Chủ</a>
            <div class="login-link">
                <p class="">Đã có tài khoản? <a href="{{ route('auth.admin') }}">Đăng nhập</a></p>
                
            </div>

        </form>
    </div>
    <script>
        function showToast(message, type) {
            var toast = document.getElementById("toast");
            toast.className = "toast show " + type;
            toast.innerText = message;
            setTimeout(function() {
                toast.className = toast.className.replace("show", "");
            }, 3000);
        }
    
    </script>
    <script>
        @if (session('message'))
            showToast("{{ session('message') }}", "{{ session('type') }}");
            <?php
                Session::forget('message');
                Session::forget('type');
            ?>
        @endif
    </script>
</body>

</html>
