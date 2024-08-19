<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Đăng Nhập</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="{{ asset('template/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href={{ asset('/css/toast.css') }}>
    <link href="{{ asset('template/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('template/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
</head>

<body>
    <div id="toast" class="toast"></div>
    <div class="wrapper">
        <form action="{{ route('auth.login') }}" method="post" class="m-t" role="form"
            enctype="multipart/form-data">
            @csrf
            <h1><strong>Đăng Nhập</strong></h1>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="input-box">
                <input type="text" name="email" class="form-control" placeholder="Nhập email"
                    value="{{ old('email') }}">
                <i class='bx bxs-envelope' ></i>
                @if ($errors->has('email'))
                    <span class="text-danger ds-alert">* {{ $errors->first('email') }}</span>
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
            <div class="forgot">
                <a href="{{ route('auth.forgot') }}">Quên mật khẩu?</a>
            </div>
            <button type="submit" class="btn-auth">Đăng Nhập</button>
            <a href="{{ route('home.index') }}" class="btn-back">Về Trang Chủ</a>
            <div class="register-link">
                <p class="">Chưa có tài khoản? <a href="{{ route('auth.register') }}">Đăng ký ngay</a></p>
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
