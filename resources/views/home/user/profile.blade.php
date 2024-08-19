<div id="profile-content">
    <form action="{{ route('user.update', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="header">
            <a href="{{ route('home.index') }}" title="Về trang chủ"><i class='bx bx-arrow-back'></i></a>
            <h5>Cập nhật thông tin tài khoản</h5>
            <a href="{{ route('home.playlist') }}"></a>
        </div>
        <div class="container">
            <div class="left">
                <div class="info">
                    <div class="title">Xin chào {{ $user->fullname }}</div>
                    <div class="description">
                        <p>Chào mừng {{ $user->fullname }} đến với trang cập nhật thông tin tài khoản của bạn</p>
                        <p>Nhập thông tin cập nhật tài khoản</p>
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
                <div class="submit">
                    <button type="submit">Cập nhật người dùng</button>
                </div>
            </div>
            <div class="right">
                <img src="{{ $user->image ? asset('images/user/' . $user->image) : asset('images/user/default-avatar.jpg') }}"
                    alt="">
                <div class="input">
                    <label for="fullname">Họ Tên</label>
                    <span class="text-danger">(*)</span>
                    <input name="fullname" type="text" class="form-control" id="fullname"
                        placeholder="Nhập họ và tên" value="{{ $user->fullname }}">
                </div>
                <div class="input">
                    <label for="Email">Email</label>
                    <span class="text-danger">(*)</span>
                    <input name="email" type="email" class="form-control" id="Email"
                        aria-describedby="emailHelp" placeholder="Nhập email" value="{{ $user->email }}">
                </div>
                <div class="input">
                    <label for="phone">Số điện thoại</label>
                    <input name="phone" type="number" class="form-control" id="phone"
                        placeholder="Nhập số điện thoại" value="{{ $user->phone }}">
                </div>
                <div class="input">
                    <label for="avatar">Ảnh đại diện</label>
                    <input class="form-control" type="file" id="avatar" name="avatar"
                        placeholder="{{ $user->image }}">
                </div>
            </div>
        </div>
    </form>
</div>
