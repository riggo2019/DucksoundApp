<div id="favorite-content" class="music-list">
    <div class="header">
        <h5>Danh sách nhạc yêu thích</h5>
        <div class="icon" onclick="playtheoFavorite(0)">
            <i class='bx bxs-right-arrow'></i>
        </div>
    </div>

    <div class="items">
        @if (isset($favorite_list) && is_object($favorite_list))
            @foreach ($favorite_list as $favorite_item)
                <div class="item">
                    <a href="{{ route('home.song', ['id' => $favorite_item->id]) }}">
                        <div class="info">
                            <p>{{ ++$i }}</p>
                            <img src="{{ asset('images/song/' . $favorite_item->song_image) }}">
                            <div class="details">
                                <h5>{{ $favorite_item->song_name }}</h5>
                                <p>{{ $favorite_item->singer_name }}</p>
                            </div>
                        </div>
                    </a>
                    <div class="actions">
                        <div class="icon" onclick="playtheoFavorite({{ $i - 1 }})">
                            <i class='bx bxs-right-arrow'></i>
                        </div>

                        <a href="#"
                            onclick="document.getElementById('favorite-form-{{ $favorite_item->id }}').submit(); return false;">
                            <i class='bx bx-x' style="font-size: 40px;"></i>
                        </a>

                        <form id="favorite-form-{{ $favorite_item->id }}" action="{{ route('home.removeFavorite') }}"
                            method="POST" style="display: none;">
                            @csrf
                            <input type="hidden" name="song_id" value="{{ $favorite_item->id }}">
                        </form>

                    </div>
                </div>
            @endforeach
        @else
            <p>No songs found in this favorite.</p>
        @endif
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
