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

<script src={{ asset('/js/admin.js') }}></script>
<script src={{ asset('template/js/jquery-3.1.1.min.js') }}></script>
<script src={{ asset('template/js/bootstrap.min.js') }}></script>
<script src={{ asset('template/js/plugins/metisMenu/jquery.metisMenu.js') }}></script>
<script src={{ asset('template/js/plugins/slimscroll/jquery.slimscroll.min.js') }}></script>
<script src={{ asset('library/library.js') }}></script>
<script src={{ asset('js/createtoupdate.js') }}></script>
<script src={{ asset('/template/js/inspinia.js') }}></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>





@if (isset($config['js']) && is_array($config['js']))
    @foreach ($config['js'] as $key => $val)
        {!! '<script src="' . $val . '"></script>' !!}
    @endforeach
@endif
