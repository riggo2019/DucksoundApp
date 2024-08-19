<meta property="og:url" content="http://localhost/ducksound/public/index" />
<meta property="og:type" content="website" />
<meta property="og:title" content="{{ $song->song_name . ' - ' . $song->singer_name . ' - Ducksound' }}" />
<meta property="og:description" content="Ducksound - Nghe nhạc hay tải nhạc chất" />
<meta property="og:image" content="{{ $song->song_image ? asset('/images/song/' . $song->song_image) : asset('/image/admin/main-background-2.jpg') }}">