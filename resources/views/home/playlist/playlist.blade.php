<div id="list-content">
    <div class="header">
        <h4>Playlist</h4>
    </div>
    <div class="list-items">
        <div class="item add-playlist" onclick="addPlaylistOn()">
            <i class='bx bx-plus-circle'></i>
            <h3>Tạo playlist mới</h3>
        </div>
        @if (isset($playlist_list) && is_object($playlist_list))
            @foreach ($playlist_list as $playlist_item)
                <a href="{{ route('home.playlist_info', ['id' => $playlist_item->id]) }}">
                    <div class="item">
                        <img src="{{ asset('images/playlist/none.jpg') }}" alt="">
                        <h3>{{ Str::limit($playlist_item->playlist_name, 18) }}{{ strlen($playlist_item->playlist_name) > 18 ? '...' : '' }}</h3>
                        <p>{{ $playlist_item->fullname }}</p>
                    </div>
                </a>
            @endforeach
        @endif
    </div>
    <div id="addPlaylistform" class="dn">
        <form action="{{ route('home.addPlaylist') }}" method="POST">
            @csrf
            <h3>Nhập tên playlist</h3>
            <input type="text" name="playlist_name" value="" placeholder="Nhập tên playlist">
            <div class="btn">
                <button type="submit">Thêm playlist mới</button>
                <button type="button" onclick="addPlaylistOff()">Đóng</button>
            </div>
        </form>
    </div>
</div>

<div id="playlist-content" class="dn">
    @include('home.songlist')
</div>
<div id="chart-content" class="dn">
    @include('home.chart')
</div>
<div id="explore-content" class="dn">
    @include('home.explore')
</div>
