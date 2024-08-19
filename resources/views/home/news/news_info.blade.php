<div id="news_info-content">
    <div class="header">
        <a href="{{ route('home.news') }}"><i class='bx bx-arrow-back'></i></a>
        <div class="title">
            <h5>{{ $news->title }}</h5>
            <div class="info">
                <p>Ngày đăng: {{ \Carbon\Carbon::parse($news->created_at)->format('d-m-Y') }}</p>
                <p>Người đăng: Admin</p>
            </div>
        </div>
    </div>
    <div class="description">
        <div class="image">
            <img src="{{ $news->news_image ? asset('images/news/' . $news->news_image) : asset('images/news/default-image.jpg') }}"alt="">
        </div>
        <pre>{{ $news->description }}</ppre>
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