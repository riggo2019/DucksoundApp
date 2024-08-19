<div id="home-content">
    @include('home.component.slider')
    @include('home.component.playlist')
    <script id="isSearching" type="application/json">
        {!! json_encode($isSearching) !!}
    </script>
</div>
<div id="playlist-content" class="dn">
    @include('home.songlist')
</div>
<div id="chart-content" class="dn">
    @include('home.chart')
</div>
<div id="explore-content"  class="dn">
    @include('home.explore')
</div>
