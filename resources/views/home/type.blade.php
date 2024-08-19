<div id="type-content">
    <form action="{{ route('home.type') }}" method="get" class="filter" id="filter_type">
        <div class="type-items">
            @if (isset($types) && is_object($types))
                @foreach ($types as $type)
                    <div class="item" onclick="chooseType({{ $type->id }})">
                        <p>{{ $type->type_name }}</p>
                    </div>
                @endforeach
            @endif
            <input type="hidden" style="width: 10px;" value="" id="type-choose" name="type">
        </div>
    </form>
    <div class="music-list">
        <div class="header">
            <h4>{{ $list_type ? $list_type->first()->type_name : 'Lựa chọn thể loại bạn muốn tìm' }}</h4>
            @isset($list_type)
                <div class="icon" onclick="playtheoType(0)">
                    <i class='bx bxs-right-arrow'></i>
                </div>
            @endisset
        </div>
        <div class="items">
            <script type="text/javascript"></script>
            @if (isset($list_type) && is_object($list_type))
                @foreach ($list_type as $type_item)
                    <div class="item">
                        <a href="{{ route('home.song', ['id' => $type_item->id]) }}">
                            <div class="info">
                                <p>{{ ++$i }}</p>
                                <img src="{{ asset('images/song/' . $type_item->song_image) }}">
                                <div class="details">
                                    <h5>{{ $type_item->song_name }}</h5>
                                    <p>{{ $type_item->singer_name }}</p>
                                </div>
                            </div>
                        </a>
                        <div class="actions">
                            <div class="icon" onclick="playtheoType({{ $i - 1 }})">
                                <i class='bx bxs-right-arrow'></i>
                            </div>
                            @if (in_array($type_item->id, $favorite_list->pluck('id')->toArray()))
                                <i class='bx bxs-heart' style="color: #fd807b;"></i>
                            @else
                                <a href="#"
                                    onclick="document.getElementById('favorite-form-{{ $type_item->id }}').submit(); return false;">
                                    <i class='bx bxs-heart'></i>
                                </a>

                                <form id="favorite-form-{{ $type_item->id }}" action="{{ route('home.addFavorite') }}"
                                    method="POST" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="song_id" value="{{ $type_item->id }}">
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
                                                document.getElementById('addplaylist_id').value = {{ $playlist_item->id }};
                                                document.getElementById('playlist-add-form-{{ $type_item->id }}').submit(); 
                                                return false;">
                                                <div class="addPL_item">
                                                    {{ $playlist_item->playlist_name }}

                                                    <form id="playlist-add-form-{{ $type_item->id }}"
                                                        action="{{ route('home.addPlaylistsong') }}" method="POST"
                                                        style="display: none;">
                                                        @csrf

                                                        <input type="hidden" name="playlist_id" id="addplaylist_id"
                                                            value="">

                                                        <input type="hidden" name="song_id"
                                                            value="{{ $type_item->id }}">
                                                    </form>
                                                </div>
                                            </a>
                                        @endforeach
                                    @endif
                                    <hr>
                                    <div class="addPL_item"><a href="{{ route('home.playlist') }}">Thêm playlist
                                            mới</a>
                                    </div>
                                </div>
                            </i>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <script id="typelistData" type="application/json">
        {!! json_encode($list_type) !!}
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
