<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('home.component.head')
</head>

<body class="">
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v20.0"
        nonce="cNqSkFuL"></script>
    <div id="toast" class="toast"></div>
    <div class="home_container">
        @include('home.component.sidebar')
        @include('home.component.header')
        <main>
            <div class="left-section">
                @include($template)
            </div>
            @isset($noPlayer)
            @else
                <div class="right-section" id="right-section">
                    @include('home.component.player')
                </div>
            @endisset
        </main>
    </div>
    <script id="favoritelistData" type="application/json">
        {!! json_encode($favorite_list) !!}
    </script>
    @isset($user)
        <script id="userroleData" type="application/json">
            {!! json_encode($user->status_role) !!}
        </script>
    @endisset
    @include('home.component.scripts')
</body>

</html>
