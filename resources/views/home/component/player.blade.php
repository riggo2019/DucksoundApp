<div class="music-player">
    <div class="top-section">
        <div class="top-section">
            <div class="header">
                <h5>Đang phát</h5>
            </div>
            <audio controls id="player" src="{{ asset('storage/ads_file/' . $ads->ads_file) }}" class="dn"
                type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
            <audio controls id="adAudio" src="{{ asset('storage/song_file/quang-cao.mp3') }}" class="dn"
                type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
            <div class="song-info" id="Playerdescription">
                <img id="song_image" src="{{ asset('images/song/' . $song_charts[0]->song_image) }}">
                <div class="description">
                    <div class="">
                        <h3 id="song_name">{{ $song_charts[0]->song_name }}</h3>
                    </div>
                    <h5 id="singer_name">{{ $song_charts[0]->singer_name }}</h5>

                    <input id="views" value="Lượt nghe: {{ number_format($song_charts[0]->views) }}" readonly
                        tabindex="-1">
                </div>
                <div class="progress">
                    <span id="current_time"></span>
                    <input type="range" value="0" name="" class="active-line" id="progress"
                        step="0.01">
                    <span id="duration"></span>
                </div>
            </div>
            <div class="song-info dn" id="ADdescription">
                <img id="song_image" src="{{ asset('images/song/quang-cao.jpg') }}">
                <div class="description">
                    <div class="">
                        <h3 id="song_name">{{ $ads->ads_name }}</h3>
                    </div>
                    <h5 id="singer_name">
                        {{ Str::limit($ads->description, 100) }}{{ strlen($ads->description) > 100 ? '...' : '' }}</h5>
                </div>
                <hr style="
                    border: 1px solid #fff;
                    width: 320px;
                ">
            </div>
        </div>
    </div>
    <div class="player-actions" id="player-actions">
        <div class="buttons">
            <div>
                <div class="options-container dn" id="options-container">
                    <div class="items">
                        <div class="item" onclick="showLyrics()">Lời bài hát</div>
                        <hr>
                        @if ($user && $user->status_role != 2)
                            <div class="item"onclick="download()">Tải bài hát về máy</div>
                            <hr>
                        @endif
                        <div class="item" id="copyLinkPlayer">Sao chép link</div>
                        <hr>
                        <div class="item" onclick="shareFBBtn()">Chia sẻ lên Facebook</div>
                    </div>
                </div>
                <i class='bx bx-dots-horizontal-rounded' id="toggle-btn"></i>
            </div>
            <div id="loop_btn" onclick="loopSong()">
                <i class='bx bx-repeat'></i>
            </div>
            <div id="" onclick="prevSong()">
                <i class='bx bx-skip-previous'></i>
            </div>
            <div id="" onclick="playPause()">
                <i class='bx bx-play play-button' id="play"></i>
            </div>
            <div id="" onclick="nextSong()">
                <i class='bx bx-skip-next'></i>
            </div>
            <div id="shuffle_btn" onclick="shuffle()">
                <i class='bx bx-shuffle'></i>
            </div>
            {{-- nếu chưa có trong ds favourite thì thêm id="heart_btn" --}}
            <div id="favourite_btn" class="">
                <i class='bx bx-heart'></i>
            </div>
            <form id="favorite-form-player" action="{{ route('home.addFavorite') }}" method="POST"
                style="display: none;">
                @csrf
                <input id="favorite-form-player-input" type="hidden" name="song_id" value="">
            </form>

        </div>
        <div class="buttons">
            <div id="volume-control" class="volume-control">
                <i class='bx bx-volume-full' id="volumeIcon"></i>
                <input type="range" id="volumeSlider" class="volume-slider" min="0" max="1"
                    step="0.01" value="1">
            </div>
        </div>
    </div>
</div>
<div id="lyricsDialog" class="dialog-overlay">
    <div class="dialog-content">
        <span id="closeButton" class="close-button">&times;</span>
        <h2>Lyrics</h2>
        <pre id="lyricsContent">
            @if ($song_charts[0]->lyrics != null)
{{ $song_charts[0]->lyrics }}
@else
Bài hát này hiện chưa có lời
@endif
        </pre>
    </div>
    <form method="POST" enctype="multipart/form-data" action="{{ route('home.increViews') }}" id="increViews">
        @csrf
        <input type="hidden" id="song_idIV" name="songId2">
    </form>
    <form method="POST" enctype="multipart/form-data" action="{{ route('home.download') }}" id="downloadMp3">
        @csrf
        <input type="hidden" id="song_idDL" name="songId1">
    </form>
    <form method="GET" enctype="multipart/form-data" action="{{ route('home.song', ['id' => 'temp']) }}"
        id="shareFB">
        @csrf
        <input type="hidden" id="song_idFB" name="songId3">
    </form>
</div>

<script id="adsData" type="application/json">
    {!! json_encode($ads) !!}
</script>
