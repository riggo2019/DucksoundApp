<script>
    function showToast(message, type) {
        var toast = document.getElementById("toast");
        toast.className = "toast show " + type;
        toast.innerText = message;
        setTimeout(function() {
            toast.className = toast.className.replace("show", "");
        }, 3000);
    }

</script>
<script>
    @if (session('message'))
        showToast("{{ session('message') }}", "{{ session('type') }}");
        <?php
            Session::forget('message');
            Session::forget('type');
        ?>
    @endif
</script>
@if (isset($config['js']) && is_array($config['js']))
    @foreach ($config['js'] as $key => $val)
        {!! '<script src="' . $val . '"></script>' !!}
    @endforeach
@endif
<script src="{{ asset('/js/home/home.js') }}"></script>
<script src="{{ asset('/js/home/nav.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
