<div id="album-list-content" class="music-list">
    <div class="header">
        <a href="{{ route('home.album') }}"><i class='bx bx-arrow-back'></i></a>
        <h5>{{ $album->album_name }}</h5>
        <div class="icon" onclick="playtheoAlbum(0)">
            <i class='bx bxs-right-arrow'></i>
        </div>
    </div>

    <div class="items">
        @if (isset($album_list) && is_object($album_list))
            @foreach ($album_list as $album_item)
                <div class="item">
                    <a href="{{ route('home.song', ['id' => $album_item->id]) }}">
                        <div class="info">
                            <p>{{ ++$i }}</p>
                            <img src="{{ asset('images/song/' . $album_item->song_image) }}">
                            <div class="details">
                                <h5>{{ $album_item->song_name }}</h5>
                                <p>{{ $album_item->singer_name }}</p>
                            </div>
                        </div>
                    </a>
                    <div class="actions">
                        <div class="icon" onclick="playtheoAlbum({{ $i - 1 }})">
                            <i class='bx bxs-right-arrow'></i>
                        </div>
                        @if (in_array($album_item->id, $favorite_list->pluck('id')->toArray()))
                            <i class='bx bxs-heart' style="color: #fd807b;"></i>
                        @else
                            <a href="#"
                                onclick="document.getElementById('favorite-form-{{ $album_item->id }}').submit(); return false;">
                                <i class='bx bxs-heart'></i>
                            </a>

                            <form id="favorite-form-{{ $album_item->id }}" action="{{ route('home.addFavorite') }}"
                                method="POST" style="display: none;">
                                @csrf
                                <input type="hidden" name="song_id" value="{{ $album_item->id }}">
                            </form>
                        @endif
                        <i class='bx bx-plus' id="addPL-toggle-btn">
                            <div class="addPL_items dn" id="addPlaylist-container">
                                <div class="header">Thêm vào playlist</div>

                                @if (isset($playlist) && is_object($playlist))
                                    @foreach ($playlist as $playlist_item)
                                        <hr>
                                        <a
                                            onclick="                                            
                                            document.getElementById('playlist-add-form-{{ $i}}').submit();">
                                            <div class="addPL_item">
                                                {{ $playlist_item->playlist_name }}

                                                <form id="playlist-add-form-{{ $i }}"
                                                    action="{{ route('home.addPlaylistsong') }}" method="POST"
                                                    style="display: none;">
                                                    @csrf                                                  
                                                    
                                                    <input type="text"  name="song_id" value="{{ $album_item->id }}">
                                                    <input type="text" class="dn" name="playlist_id" value="{{ $playlist_item->id }}">
                                                </form>
                                            </div>
                                        </a>
                                    @endforeach
                                @endif
                                <hr>
                                <div class="addPL_item"><a href="{{ route('home.playlist') }}">Thêm playlist mới</a>
                                </div>
                            </div>
                        </i>
                    </div>
                </div>
            @endforeach
        @else
            <p>No songs found in this album.</p>
        @endif
    </div>
    <script id="albumlistData" type="application/json">
        {!! json_encode($album_list) !!}
    </script>
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
