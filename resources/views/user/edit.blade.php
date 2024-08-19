@if ($user->id == Auth::user()->id)
    @include('dashboard.component.breadcrumb', ['title' => 'Cập nhật thông tin cá nhân'])
@else
    @include('dashboard.component.breadcrumb', ['title' => $config['seo']['edit']['title']])
@endif

<form action="{{ route('user.update', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="col-sm-4">
            <div class="panel-title">Thông tin người dùng</div>
            <div class="panel-description">
                <p>Nhập thông tin cập nhật người dùng</p>
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
                        placeholder="Nhập họ và tên" value="{{ $user->fullname }}">
                </div>
                <div class="form-group mg-form">
                    <label for="Email">Email</label>
                    <span class="text-danger">(*)</span>
                    <input name="email" type="email" class="form-control" id="Email"
                        aria-describedby="emailHelp" placeholder="Nhập email" value="{{ $user->email }}">
                </div>
                <div class="form-group mg-form">
                    <label for="phone">Số điện thoại</label>
                    <input name="phone" type="number" class="form-control" id="phone"
                        placeholder="Nhập số điện thoại" value="{{ $user->phone }}">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group mg-form">
                    <label for="Password">Mật khẩu</label>
                    <span class="text-danger">(*)</span>
                    <input name="password" type="password" class="form-control" id="Password"
                        placeholder="Nhập mật khẩu" value="{{ old('email') }}">
                </div>
                <div class="form-group mg-form">
                    <label for="Repassword">Nhập lại mật khẩu</label>
                    <span class="text-danger">(*)</span>
                    <input name="repassword" type="password" class="form-control" id="Repassword"
                        placeholder="Nhập lại mật khẩu" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="status_role">Trạng thái</label>
                    <span class="text-danger">(*)</span>
                    <select name="status_role" class="form-control status_role" id="status_role"
                        value="{{ $user->status_role }}">
                        <option>[Chọn trạng thái]</option>
                        <option value="1" {{ $user->status_role == 1 ? 'selected' : '' }}>Chưa kích hoạt</option>
                        <option value="2" {{ $user->status_role == 2 ? 'selected' : '' }}>Đã kích hoạt</option>
                        <option value="3" {{ $user->status_role == 3 ? 'selected' : '' }}>Tài khoản VIP</option>
                        <option value="4" {{ $user->status_role == 4 ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
            </div>

            <div class="col-sm-12 form-group">
                <div class="col-sm-10 p-0">
                    <label for="avatar">Ảnh đại diện</label>
                    <div class="update_image">
                        <input class="form-control" type="file" id="avatar" name="avatar"
                            placeholder="{{ $user->image }}">
                    </div>
                </div>
                <div class="col-sm-2 p-0">
                    <span class="avatar users-avatar"><img src="{{ asset('images/user/' . $user->image) }}"
                            alt="Avatar"></span>
                </div>

            </div>
        </div>
    </div>
    <div class="text-right">
        <button type="submit" class="mg-btn btn btn-primary">Cập nhật người dùng</button>
        <a href="{{ route('user.index') }}" class="mg-btn btn btn-success mr50">Quay lại</a>
    </div>
</form>
