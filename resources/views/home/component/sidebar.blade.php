<aside class="sidebar" style="left: 0px;">
    <div class="logo">
        <a href="{{ route('home.index') }}">
            <i class="bx bx-pulse icon"></i>
            <label for="">DUCKSOUND</label>
        </a>
    </div>
    <div class="menu">
        <ul>
            <li id="exploreSB" onclick="exploreOpen()">
                <a href="#">
                    <i class='bx bxs-bolt-circle'></i>
                    <label for="">Khám phá</label>
                </a>
            </li>
            <li id="chartSB" onclick="chartOpen()">
                <a href="#">
                    <i class='bx bxs-bar-chart-alt-2'></i>
                    <label for="">Bảng xếp hạng</label>
                </a>
            </li>
        </ul>
    </div>
    <hr>
    <div class="menu">
        <ul>
            <li id="typeSB"{{ $config['active'] == 'type' ? 'class=active' : null }}>
                <a href="{{ route('home.type') }}">
                    <i class="bx bxs-volume-full"></i>
                    <label for="">Thể loại</label>
                </a>
            </li>
            <li id="albumSB"{{ $config['active'] == 'album' ? 'class=active' : null }}>
                <a href="{{ route('home.album') }}">
                    <i class="bx bxs-album"></i>
                    <label for="">Albums</label>
                </a>
            </li>
            <li id="singerSB"{{ $config['active'] == 'singer' ? 'class=active' : null }}>
                <a href="{{ route('home.singer') }}">
                    <i class="bx bxs-microphone"></i>
                    <label for="">Ca sĩ</label>
                </a>
            </li>
        </ul>
    </div>
    <hr>
    <div class="menu">
        <ul>
            <li id="listSB"{{ $config['active'] == 'playlist' ? 'class=active' : null }}>
                <a
                    href="{{ route('home.playlist') }}">
                    <i class='bx bxs-playlist'></i>
                    <label for="">Danh sách phát</label>
                </a>
            </li>
            <li id="favoriteSB" {{ $config['active'] == 'favorite' ? 'class=active' : null }}>
                <a
                    href="{{ route('home.favorite') }}">
                    <i class="bx bxs-heart"></i>
                    <label for="">Yêu thích</label>
                </a>
            </li>
        </ul>
    </div>
    <hr>
    <div class="menu">
        <ul>
            <li id="newsSB"{{ $config['active'] == 'news' ? 'class=active' : null }}>
                <a href="{{ route('home.news') }}">
                    <i class='bx bx-news'></i>
                    <label for="">Tin tức</label>
                </a>
            </li>
        </ul>
    </div>
</aside>
