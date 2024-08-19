@include('dashboard.component.breadcrumb', ['title' => $config['seo']['create']['title']])


<form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="col-sm-4">
            <div class="panel-title">Thông tin người dùng</div>
            <div class="panel-description">
                <p>Nhập thông tin người dùng mới</p>
                <p>Lưu ý, những trường được đánh dấu <span class="text-danger">(*)</span> là bắt buộc</p>
            </div>
            @if (session('success'))
                <h5 class="alert alert-success">
                    {{ session('success') }}
                </h5>
            @endif
            @if (session('error'))
                <h5 class="alert alert-danger">
                    {{ session('error') }}
                </h5>
            @endif
        </div>
        <div class="col-sm-8">
            <div class="col-sm-6">
                <div class="form-group mg-form">
                    <label for="fullname">Họ Tên</label>
                    <span class="text-danger">(*)</span>
                    <input name="fullname" type="text" class="form-control" id="fullname"
                        placeholder="Nhập họ và tên" value="{{ old('fullname') }}">
                    @if ($errors->has('fullname'))
                        <span class="text-danger">* {{ $errors->first('fullname') }}</span>
                    @endif
                </div>
                <div class="form-group mg-form">
                    <label for="Email">Email</label>
                    <span class="text-danger">(*)</span>
                    <input name="email" type="email" class="form-control" id="Email"
                        aria-describedby="emailHelp" placeholder="Nhập email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="text-danger">* {{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group mg-form">
                    <label for="phone">Số điện thoại</label>
                    <input name="phone" type="number" class="form-control" id="phone"
                        placeholder="Nhập số điện thoại" value="{{ old('phone') }}">
                    @if ($errors->has('phone'))
                        <span class="text-danger">* {{ $errors->first('phone') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group mg-form">
                    <label for="Password">Mật khẩu</label>
                    <span class="text-danger">(*)</span>
                    <input name="password" type="password" class="form-control" id="password"
                        placeholder="Nhập mật khẩu" value="{{ old('password') }}">
                    @if ($errors->has('password'))
                        <span class="text-danger">* {{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="form-group mg-form">
                    <label for="password_confirmation">Nhập lại mật khẩu</label>
                    <span class="text-danger">(*)</span>
                    <input name="password_confirmation" type="password" class="form-control" id="password_confirmation"
                        placeholder="Nhập lại mật khẩu" value="{{ old('password_confirmation') }}">
                    @if ($errors->has('password.confirmed'))
                        <span class="text-danger">* {{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="status_role">Trạng thái</label>
                    <span class="text-danger">(*)</span>
                    <select name="status_role" class="form-control status_role" id="status_role"
                        value="{{ old('status_role') }}">
                        <option>[Chọn trạng thái]</option>
                        <option value="1">Chưa kích hoạt</option>
                        <option value="2">Đã kích hoạt</option>
                        <option value="3">Tài khoản VIP</option>
                        <option value="4">Admin</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-12 form-group">
                <label for="avatar">Ảnh đại diện</label>
                <input class="form-control" type="file" id="avatar" name="avatar">
            </div>
        </div>
    </div>
    <div class="text-right">
        <button type="submit" class="mg-btn btn btn-primary">Thêm người dùng</button>
        <a href="{{ route('user.index') }}" class="mg-btn btn btn-success mr50">Quay lại</a>
    </div>
</form>
