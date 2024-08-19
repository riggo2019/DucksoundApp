<div class="trending">
    <div class="left">
        <div class="info">
            <a href="{{ route('home.song', ['id' => $song_charts[0]->id]) }}">
                <h2>{{ $song_charts[0]->song_name }}</h2>
                <h4>{{ $song_charts[0]->singer_name }}</h4>
                <h5>Lượt nghe: {{ number_format($song_charts[0]->views) }}</h5>
            </a>
            <div class="buttons">
                <button onclick="playChart(0)">Nghe nhạc</button>
                @if (in_array($song_charts[0]->id, $favorite_list->pluck('id')->toArray()))
                    <i class='bx bxs-heart' style="color: #fd807b;"></i>
                @else
                    <a href="#"
                        onclick="
                                    document.getElementById('favorite-form-{{ $song_charts[0]->id }}').submit(); return false;
                                    ">
                        <i class='bx bxs-heart'></i>
                    </a>

                    <form id="favorite-form-{{ $song_charts[0]->id }}" action="{{ route('home.addFavorite') }}"
                        method="POST" style="display: none;">
                        @csrf
                        <input type="hidden" name="song_id" value="{{ $song_charts[0]->id }}">
                    </form>
                @endif
            </div>
        </div>
    </div>
    <img src="{{ asset('images/song/' . $song_charts[0]->song_image) }}">
</div>
