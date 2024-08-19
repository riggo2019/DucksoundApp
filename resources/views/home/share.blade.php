<div id="share-content">
    <div class="container mt-1 text-center">
        <h1 class="text-danger">Chia sẻ bài hát</h1>
        <hr>
        <h3>{{ $data['title'] }}</h3>
        <img src="{{ url($data['image']) }}" alt="" width="400" srcset="">
        <p>{{ Str::limit($data['description'], 100) }}{{ strlen($data['description']) > 100 ? '...' : '' }}</p>
        {!! $shareButtons !!}
    </div>
</div>
<div id="playlist-content" class="dn">
    @include('home.songlist')
</div>