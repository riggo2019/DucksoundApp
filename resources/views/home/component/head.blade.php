<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
@isset($songhead)
    @include($songhead)
@endisset

<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
{{-- <link rel="stylesheet" href={{ asset('/css/resource/bootstrap.min.css') }}> --}}
<link rel="stylesheet" href={{ asset('/css/home/index.css') }}>
<link rel="stylesheet" href={{ asset('/css/toast.css') }}>
<link rel="stylesheet" href={{ asset('/css/resource/fontawesome.min.css') }}>
<link rel="stylesheet" href={{ asset('/css/resource/all.min.css') }}>
{{-- <link rel="stylesheet" href={{ asset('/css/resource/boxicons.min.css') }}> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<title>Ducksound - Nghe nhạc hay tải nhạc chất</title>
