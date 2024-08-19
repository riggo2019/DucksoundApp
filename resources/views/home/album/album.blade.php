<div id="album-content">
    <div class="header">
        <h4>Albums</h4>
    </div>
    <div class="album-items">
        @if (isset($albums) && is_object($albums))
            @foreach ($albums as $album)
            <a href="{{ route('home.album_info', ['id' => $album->id]) }}">
                <div class="item">
                    <img src="
                    {{ $album->album_image ? asset('images/album/' . $album->album_image) : asset('images/album/none.jpg') }}
                    " alt="">
                    <h3>{{ $album->album_name }}</h3>
                    <p>{{ $album->singer_name }}</p>                    
                </div>
            </a>
            @endforeach
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