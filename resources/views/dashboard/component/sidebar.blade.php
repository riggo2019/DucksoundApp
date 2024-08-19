<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="m-b-20 db-logo">
                <a href="{{ route('home.index') }}">
                    <i class="bx bx-pulse icon" style="font-size: 20px;"></i>
                    <span class="nav-label">DUCKSOUND</span>
                </a>
            </li>
            <li {{ $config['seo']['index']['title'] == 'Quản lí người dùng' ? 'class=active' : null }}>
                <a href="{{ route('user.index') }}">
                    <i class="fa-solid fa-user"></i>
                    <span class="nav-label">Quản lí người dùng</span>
                </a>
            </li>
            <li {{ $config['seo']['index']['title'] == 'Quản lí bài hát' ? 'class=active' : null }}>
                <a href="{{ route('song.index') }}">
                    <i class="fa-solid fa-music"></i>
                    <span class="nav-label">Quản lí bài hát</span>
                </a>
            </li>
            <li {{ $config['seo']['index']['title'] == 'Quản lí thể loại' ? 'class=active' : null }}>
                <a href="{{ route('type.index') }}">
                    <i class="fa-solid fa-list"></i>
                    <span class="nav-label">Quản lí thể loại</span>
                </a>
            </li>
            <li {{ $config['seo']['index']['title'] == 'Quản lí ca sĩ' ? 'class=active' : null }}>
                <a href="{{ route('singer.index') }}">
                    <i class="fa-solid fa-microphone"></i>
                    <span class="nav-label">Quản lí ca sĩ</span>
                </a>
            </li>
            <li {{ $config['seo']['index']['title'] == 'Quản lí tin tức' ? 'class=active' : null }}>
                <a href="{{ route('news.index') }}">
                    <i class="fa-solid fa-newspaper"></i>
                    <span class="nav-label">Quản lí tin tức</span>
                </a>
            </li>
            <li {{ $config['seo']['index']['title'] == 'Quản lí album' ? 'class=active' : null }}>
                <a href="{{ route('album.index') }}">
                    <i class="fa-solid fa-compact-disc"></i>
                    <span class="nav-label">Quản lí album</span>
                </a>
            </li>
            <li {{ $config['seo']['index']['title'] == 'Quản lí quảng cáo' ? 'class=active' : null }}>
                <a href="{{ route('ads.index') }}">
                    <i class="fa-brands fa-adversal"></i>
                    <span class="nav-label">Quản lí quảng cáo</span>
                </a>
            </li>
            <li {{ $config['seo']['index']['title'] == 'Quản lí tài khoản' ? 'class=active' : null }}>
                <a href="{{ route('auth.logout') }}">
                    <i class="fa fa-sign-out"></i>
                    <span class="nav-label">Đăng xuất</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
