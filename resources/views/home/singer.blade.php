<div id="singer-content">
    <form action="{{ route('home.singer') }}" method="get" class="filter" id="filter_singer">
        <div class="singer-items">
            @if (isset($singers) && is_object($singers))
                @foreach ($singers as $singer)
                    <div class="item" onclick="chooseSinger({{ $singer->id }})">
                        <img src="
                        {{ $singer->singer_image ? asset('images/singer/' . $singer->singer_image) : asset('images/singer/default-avatar.jpg') }}
                        " alt="">
                        <p>{{ $singer->singer_name }}</p>
                    </div>
                @endforeach
            @endif
            <input type="hidden" style="width: 10px;" value="" id="singer-choose" name="singer">
        </div>
    </form>
    <div class="music-list">
        <div class="header">
            <h4>{{ $list_singer ? $list_singer->first()->singer_name : 'Lựa chọn ca sĩ bạn muốn tìm' }}</h4>
            @isset($list_singer)
                <div class="icon" onclick="playtheoSinger({{ 0 }})">
                    <i class='bx bxs-right-arrow'></i>
                </div>
            @endisset
        </div>
        <div class="items">
            @if (isset($list_singer) && is_object($list_singer))
                @foreach ($list_singer as $singer_item)
                    <div class="item">
                        <a href="{{ route('home.song', ['id' => $singer_item->id]) }}">
                            <div class="info">
                                <p>{{ ++$i }}</p>
                                <img src="{{ asset('images/song/' . $singer_item->song_image) }}">
                                <div class="details">
                                    <h5>{{ $singer_item->song_name }}</h5>
                                    <p>{{ $singer_item->singer_name }}</p>
                                </div>
                            </div>
                        </a>
                        <div class="actions">
                            <div class="icon" onclick="playtheoSinger({{ $i-1  }})">
                                <i class='bx bxs-right-arrow'></i>
                            </div>
                            @if (in_array($singer_item->id, $favorite_list->pluck('id')->toArray()))
                                <i class='bx bxs-heart' style="color: #fd807b;"></i>
                            @else
                                <a href="#"
                                    onclick="document.getElementById('favorite-form-{{ $singer_item->id }}').submit(); return false;">
                                    <i class='bx bxs-heart'></i>
                                </a>

                                <form id="favorite-form-{{ $singer_item->id }}"
                                    action="{{ route('home.addFavorite') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    <input type="hidden" name="song_id" value="{{ $singer_item->id }}">
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
                                                document.getElementById('playlist-add-form-{{ $i }}').submit(); 
                                                return false;">
                                                <div class="addPL_item">
                                                    {{ $playlist_item->playlist_name }}
    
                                                    <form id="playlist-add-form-{{ $i }}"
                                                        action="{{ route('home.addPlaylistsong') }}" method="POST"
                                                        style="display: none;">
                                                        @csrf
    
                                                        <input type="text" name="playlist_id" id="addplaylist_id"
                                                            value="{{ $playlist_item->id }}">
    
                                                        <input type="text" name="song_id" value="{{ $singer_item->id }}">
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
            @endif
        </div>
    </div>
    <script id="singerlistData" type="application/json">
        {!! json_encode($list_singer) !!}
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