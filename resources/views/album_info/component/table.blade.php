
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>STT</th>
                <th style="width: 500px">Tên bài hát</th>
                <th>Lượt nghe</th>
                <th>Ảnh bìa</th>
                <th style="width: 150px">Xóa</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($album_infos) && is_object($album_infos))
                @foreach ($album_infos as $album_info)
                    <tr>
                        <td>
                            {{ ++$i }}
                        </td>
                        <td>
                            {{ $album_info->song_name }}
                        </td>
                        <td>
                            {{ $album_info->views }}
                        </td>
                        <td>
                            @if ($album_info->song_image != null)
                                <a href="{{ asset('images/song/' . $album_info->song_image) }}" data-lightbox="roadtrip">
                                    <span class="avatar song_image  m-0">
                                        <img src="{{ asset('images/song/' . $album_info->song_image) }}" alt="Image">
                                    </span>
                                </a>
                            @else
                                <a href="{{ asset('images/song/default-image.jpg') }}" data-lightbox="roadtrip">
                                    <span class="avatar song_image  m-0">
                                        <img src="{{ asset('images/song/default-image.jpg') }}" alt="Default Image">
                                    </span>
                                </a>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('album.remove', ['id' => $album_info->id]) }}" method="POST" onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i
                                        class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {{ $album_infos->links('pagination::bootstrap-4')}}
</div>
<script>
    function confirmDelete() {
        return confirm('Bạn có chắc muốn xóa bài hát');
    }
</script>
