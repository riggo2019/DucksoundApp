<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<title>Admin - Ducksound</title>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link href={{ asset('/template/css/bootstrap.min.css') }} rel="stylesheet">
<link href={{ asset('/template/font-awesome/css/font-awesome.css') }} rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<link href={{ asset('/template/css/animate.css') }} rel="stylesheet">
@if (isset($config['css']) && is_array($config['css']))
    @foreach ($config['css'] as $key => $val)
        {!! '<link href="' . $val . '" rel="stylesheet">' !!}
    @endforeach
@endif
<link rel="stylesheet" href={{ asset('/css/dashboardtoast.css') }}>
<link href={{ asset('/template/css/style.css') }} rel="stylesheet">
<link href={{ asset('/css/app.css') }} rel="stylesheet">
<link href={{ asset('/css/dashboard/root.css') }} rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>