<div class="profile">
    @php
        use Carbon\Carbon;

        $now = Carbon::now();
        $expiresAt = Carbon::parse($user->upgrade_expires_at);
        $daysRemaining = ceil($now->diffInDays($expiresAt));
    @endphp
    
    @if ($user->status_role == 4)
        <a href="{{ route('user.index') }}" title="Nhấn để về trang quản trị viên">
            <div class="role admin">
                <h4>ADMIN</h4>
            </div>
        </a>
    @elseif($user->status_role == 2)
        <a href="{{ route('home.upgrade') }}">
            <div class="role upgrade">
                Nâng cấp tài khoản
            </div>
        </a>
    @else
        <div class="role vip" title="Thời gian VIP còn lại {{ $daysRemaining }} ngày">
            <h4>Tài khoản VIP</h4>
        </div>
    @endif

    <div>
        <i class='bx bxs-cog' id="toggle-profile"></i>
    </div>
    <div class="user">
        <div class="left">
            <img
                src="{{ $user->image ? asset('images/user/' . $user->image) : asset('images/user/default-avatar.jpg') }}">
        </div>
        <div class="right">
            <h5>{{ $user->fullname }}</h5>
        </div>
        <div class="profile-container dn" id="profile-container">
            <div class="items">
                <div class="item"><a href="{{ route('home.profile') }}">Chỉnh sửa thông tin</a></div>
                <hr>
                <div class="item"><a href="{{ route('home.changepass') }}">Đổi mật khẩu</a></div>
                <hr>
                @if ($user && $user->status_role == 2)
                    <div class="item"><a href="{{ route('home.upgrade') }}">Nâng cấp tài khoản</a></div>
                    <hr>
                @endif
                <div class="item"><a href="{{ route('auth.logout') }}">Đăng xuất</a></div>
            </div>
        </div>
    </div>
</div>
