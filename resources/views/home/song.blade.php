<div id="song-content">
    <div class="left">
        <div class="info">
            <h2>{{ $song->song_name }}</h2>
            <h4>{{ $song->singer_name }}</h4>
            <h5>Lượt nghe: {{ number_format($song->views) }}</h5>
            <div class="buttons">
                @if (in_array($song->id, $favorite_list->pluck('id')->toArray()))
                    <i class='bx bxs-heart' style="color: #fd807b;"></i>
                @else
                    <a href="#"
                        onclick="
                                    document.getElementById('favorite-form-{{ $song->id }}').submit(); return false;
                                    ">
                        <i class='bx bxs-heart'></i>
                    </a>

                    <form id="favorite-form-{{ $song->id }}" action="{{ route('home.addFavorite') }}" method="POST"
                        style="display: none;">
                        @csrf
                        <input type="hidden" name="song_id" value="{{ $song->id }}">
                    </form>
                @endif
                <button onclick="playSongs({{ $song->id }})">Nghe nhạc</button>
                {!! $shareButtons !!}
                <button onclick="copyLink({{ $song->id }})">Sao chép link</button>
            </div>
        </div>
    </div>
    <img src="{{ asset('images/song/' . $song->song_image) }}">
</div>

<div id="chart-content" class="dn">
    @include('home.chart')
</div>
<div id="explore-content" class="dn">
    @include('home.explore')
</div>
