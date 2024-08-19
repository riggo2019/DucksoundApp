@php
    use Illuminate\Support\Str;
@endphp
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>STT</th>
                <th style="width: 150px">Tên bài hát</th>
                <th style="width: 50px">Ảnh bìa</th>
                <th>Quốc gia</th>
                <th>Thể loại</th>
                <th>Ca sĩ</th>
                <th style="width: 300px">Lời bài hát</th>
                <th style="width: 200px">File âm thanh</th>
                <th style="width: 50px">Sửa</th>
                <th style="width: 50px">Xóa</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($songs) && is_object($songs))
                @foreach ($songs as $song)
                    <tr>
                        <td>
                            {{ ++$i }}
                        </td>
                        <td>
                            {{ $song->song_name }}
                        </td>
                        <td>
                            @if ($song->song_image != null)
                                <a href="{{ asset('images/song/' . $song->song_image) }}" data-lightbox="roadtrip">
                                    <span class="avatar song_image  m-0">
                                        <img src="{{ asset('images/song/' . $song->song_image) }}" alt="Image">
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
                            {{ $song->nation == 0 ? 'Việt Nam' : 'Quốc tế' }}
                        </td>
                        <td>
                            {{ $song->type_name }}
                        </td>
                        <td>
                            {{ $song->singer_name }}
                        </td>
                        <td>
                            <p>{{ Str::limit($song->lyrics, 100) }}{{ strlen($song->lyrics) > 100 ? '...' : '' }}</p>
                        </td>
                        <td>
                            {{ $song->song_file }}
                        </td>
                        <td>
                            <a href="{{ route('song.edit', ['id' => $song->id]) }}" class="btn btn-warning btn-sm"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                        </td>
                        <td>
                            <form action="{{ route('song.delete', ['id' => $song->id]) }}" method="POST"
                                onsubmit="return confirmDelete()">
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
    {{ $songs->links('pagination::bootstrap-4') }}
</div>
<script>
    function confirmDelete() {
        return confirm('Bạn có chắc muốn xóa bài hát');
    }
</script>
