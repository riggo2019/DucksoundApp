<div id="playlist-list-content" class="music-list playlist_song">
    <div class="header">
        <a href="{{ route('home.playlist') }}"><i class='bx bx-arrow-back'></i></a>
        <h5>{{ $playlist_name->playlist_name }}</h5>
        <div class="icon" onclick="playtheoPlaylist(0)">
            <i class='bx bxs-right-arrow'></i>
        </div>
    </div>

    <div class="items">
        @if (isset($playlist_list) && is_object($playlist_list))
            @foreach ($playlist_list as $playlist_item)
                <div class="item">
                    <a href="{{ route('home.song', ['id' => $playlist_item->id]) }}">
                        <div class="info">
                            <p>{{ ++$i }}</p>
                            <img src="{{ asset('images/song/' . $playlist_item->song_image) }}">
                            <div class="details">
                                <h5>{{ $playlist_item->song_name }}</h5>
                                <p>{{ $playlist_item->singer_name }}</p>
                            </div>
                        </div>
                    </a>
                    <div class="actions">
                        <div class="icon" onclick="playtheoPlaylist({{ $i - 1 }})">
                            <i class='bx bxs-right-arrow'></i>
                        </div>
                        <a href="#"
                            onclick="document.getElementById('playlist-remove-form-{{ $playlist_item->id }}').submit(); return false;">
                            <i class='bx bx-x' style="font-size: 40px;"></i>
                        </a>

                        <form id="playlist-remove-form-{{ $playlist_item->id }}" action="{{ route('home.removePlaylistsong') }}"
                            method="POST" style="display: none;">
                            @csrf
                            <input type="text" class="dn" name="song_id" value="{{ $playlist_item->id }}">
                            <input type="text" class="dn" name="playlist_id" value="{{ $playlist_item->playlist_id }}">
                        </form>

                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="footer">
        <a onclick="editPlaylistOn()">Đổi tên Playlist</a>
        <a href="{{ route('home.removePlaylist', ['id' => $playlist_name->id]) }}">Xóa Playlist</a>
    </div>
    <script id="playlistlistData" type="application/json">
        {!! json_encode($playlist_list) !!}
    </script>
</div>

<div id="editPlaylistform" class="dn">
    <form action="{{ route('home.editPlaylist', ['id' => $playlist_name->id]) }}" method="POST">
        @csrf
        <h3>Đổi tên playlist</h3>
        <input type="text" name="playlist_name" value="{{ $playlist_name->playlist_name }}">
        <div class="btn">
            <button type="submit">Đổi tên playlist</button>
            <button type="button" onclick="editPlaylistOff()">Đóng</button>
        </div>
    </form>
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
