<div id="changepass-content">
    <form action="{{ route('user.updatePass', ['id' => $user->id, 'i' => 1]) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="header">
            <a href="{{ route('home.index') }}" title="Về trang chủ"><i class='bx bx-arrow-back'></i></a>
            <h5>Đổi mật khẩu</h5>
            <a href="{{ route('home.playlist') }}"></a>
        </div>
        <div class="container">
            <div class="input">
                <input type="password" name="oldpassword" class="form-control" placeholder="Nhập mật khẩu cũ"
                    value="{{ old('oldpassword') }}">
                @if ($errors->has('password'))
                    <span class="text-danger ds-alert">* {{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="input">
                <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu mới"
                    value="{{ old('password') }}">
                @if ($errors->has('password'))
                    <span class="text-danger ds-alert">* {{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="input">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu"
                    value="{{ old('password_confirmation') }}" id="password_confirmation">
                @if ($errors->has('password.confirmed'))
                    <span class="text-danger ds-alert">* {{ $errors->first('password_confirmation') }}</span>
                @endif
            </div>
            <div class="submit">
                <button type="submit">Cập nhật người dùng</button>
            </div>
        </div>
    </form>
</div>
