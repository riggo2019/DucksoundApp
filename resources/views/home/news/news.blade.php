<div id="news-content">
    <div class="header">
        <h5>Tin tức</h5>
    </div>
    <div class="items">
        @if (isset($news) && is_object($news))
            @foreach ($news as $news_item)
                <a href="{{ route('home.news_info', ['id' => $news_item->id]) }}">
                    <div class="item">
                        <div class="info">
                            <h2>{{ $news_item->title }}</h2>
                            <h4>{{ Str::limit($news_item->description, 200) }}{{ strlen($news_item->description) > 200 ? '...' : '' }}
                            </h4>
                        </div>
                        <img
                            src="{{ $news_item->news_image ? asset('images/news/' . $news_item->news_image) : asset('images/news/default-image.jpg') }}">
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
