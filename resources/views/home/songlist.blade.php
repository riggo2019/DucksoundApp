<div class="music-list">
    <div class="header">
        <h5>Danh sách phát</h5>
        <div class="icon" onclick="playDefault(0)" >
            <i class='bx bxs-right-arrow'></i>
        </div>
    </div>

    <div class="items">
        @if (isset($song_list) && is_object($song_list))
            @foreach ($song_list as $song_item)
                <div class="item">
                    <a href="{{ route('home.song', ['id' => $song_item->id]) }}">
                    <div class="info">
                        <p>{{ ++$i }}</p>
                        <img src="{{ asset('images/song/' . $song_item->song_image) }}">
                        <div class="details">
                            <h5>{{ $song_item->song_name }}</h5>
                            <p>{{ $song_item->singer_name }}</p>
                        </div>
                    </div>
                    </a>
                    <div class="actions">
                        <div class="icon" onclick="playDefault({{ $i-1 }})" >
                            <i class='bx bxs-right-arrow'></i>
                        </div>
                        <i class='bx bxs-heart'></i>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

</div>

<script id="songsData" type="application/json">
    {!! json_encode($song_list) !!}
</script>

