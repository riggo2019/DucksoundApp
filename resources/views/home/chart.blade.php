<div class="music-list chart">
    <div class="header">
        <h5>Bảng xếp hạng</h5>
        <div class="icon" onclick="playChart(0)">
            <i class='bx bxs-right-arrow'></i>
        </div>
    </div>

    <div class="items">
        @if (isset($song_charts) && is_object($song_charts))
            @foreach ($song_charts as $song_chart)
                <div class="item">
                    <a href="{{ route('home.song', ['id' => $song_chart->id]) }}">
                        <div class="info">
                            <p>{{ ++$i }}</p>
                            <img src="{{ asset('images/song/' . $song_chart->song_image) }}">
                            <div class="details">
                                <h5>{{ $song_chart->song_name }}</h5>
                                <p>{{ $song_chart->singer_name }}</p>
                            </div>
                        </div>
                    </a>

                    <div class="actions">
                        <h6>{{ number_format($song_chart->views) }} lượt nghe</h6>
                        <div class="icon" onclick="playChart({{ $i - 1 }})">

                            <i class='bx bxs-right-arrow'></i>
                        </div>
                        @if (in_array($song_chart->id, $favorite_list->pluck('id')->toArray()))
                            <i class='bx bxs-heart' style="color: #fd807b;"></i>
                        @else
                            <a href="#"
                                onclick="
                                    document.getElementById('favorite-form-{{ $song_chart->id }}').submit(); return false;
                                    ">
                                <i class='bx bxs-heart'></i>
                            </a>

                            <form id="favorite-form-{{ $song_chart->id }}" action="{{ route('home.addFavorite') }}"
                                method="POST" style="display: none;">
                                @csrf
                                <input type="hidden" name="song_id" value="{{ $song_chart->id }}">
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
                                            document.getElementById('playlist-add-form-{{ $i }}').submit();">
                                            <div class="addPL_item">
                                                {{ $playlist_item->playlist_name }}

                                                <form id="playlist-add-form-{{ $i }}"
                                                    action="{{ route('home.addPlaylistsong') }}" method="POST"
                                                    style="display: none;">
                                                    @csrf

                                                    <input type="text" name="song_id" value="{{ $song_chart->id }}">
                                                    <input type="text" class="dn" name="playlist_id"
                                                        value="{{ $playlist_item->id }}">
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

<script id="chartData" type="application/json">
    {!! json_encode($song_charts) !!}
</script>
