<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th style="width: 250px">Tên Album</th>
                            <th>Ca sĩ</th>
                            <th>Ảnh bìa</th>
                            <th style="width: 100px">Đổi tên</th>
                            <th style="width: 50px">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($albums) && is_object($albums))
                            @foreach ($albums as $album)
                                <tr>
                                    <td>
                                        {{ ++$i }}
                                    </td>
                                    <td>
                                        <a href="{{ route('album.list', ['id' => $album->id]) }}">
                                            {{ $album->album_name }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $album->singer_name }}
                                    </td>
                                    <td>
                                        @if ($album->album_image != null)
                                            <a href="{{ asset('images/album/' . $album->album_image) }}"
                                                data-lightbox="roadtrip">
                                                <span class="avatar song_image m-0">
                                                    <img src="{{ asset('images/album/' . $album->album_image) }}"
                                                        alt="Image">
                                                </span>
                                            </a>
                                        @else
                                            <a href="{{ asset('images/album/none.jpg') }}" data-lightbox="roadtrip">
                                                <span class="avatar song_image m-0">
                                                    <img src="{{ asset('images/album/none.jpg') }}" alt="Default Image">
                                                </span>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-warning btn-sm"
                                            onclick="openAlbumEdit('{{ $album->album_name }}', '{{ $album->singer_name }}')">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('album.delete', ['id' => $album->id]) }}" method="POST" onsubmit="return confirmDelete()">
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
                {{ $albums->links('pagination::bootstrap-4') }}
            </div>
        </div>
        <div class="col-md-4 ">
            <form action="{{ route('album.store') }}" method="post" id="addAlbumForm" enctype="multipart/form-data"
                class="dn">
                @csrf
                <div class="header">Thêm album</div>
                <div class="form-group">
                    <label for="album_name">Tên album</label>
                    <input type="text" class="form-control" id="addAlbumName" name="album_name"
                        placeholder="Nhập tên album">
                    <div class="form-group m-t-20">
                        <label for="singer_id">Tên Ca sĩ</label>
                        <span class="text-danger">(*)</span>
                        <select name="singer_id" id="addAlbumName" class="form-control">
                            <option value="">[Chọn ca sĩ]</option>
                            @foreach ($singers as $singer)
                                <option value="{{ $singer->id }}">{{ $singer->singer_name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('singer_id'))
                            <span class="text-danger">* {{ $errors->first('singer_id') }}</span>
                        @endif
                    </div>
                    <label for="album_image">Ảnh bìa</label>
                    <input class="form-control" type="file" id="addAlbumImage" name="album_image">
                </div>
                <button type="submit" class="btn btn-primary mt-2">Thêm album</button>
                <div class="btn btn-primary mt-2" onclick="closeAlbumAdd()">Đóng</div>
            </form>
        </div>

        <div class="col-md-4">
            <form action="{{ route('album.update', ['id' => $album->id]) }}" method="post" id="editAlbumForm"
                class="dn" enctype="multipart/form-data">
                @csrf
                <div class="header">Đổi tên album</div>
                <div class="form-group">
                    <label for="typeName">Tên album</label>
                    <input type="text" class="form-control" id="editAlbumName" name="album_name"
                        placeholder="Nhập tên album">
                    <label for="album_singer">Tên ca sĩ</label>
                    <input type="text" class="form-control" id="editAlbumSinger" name="album_singer"
                        placeholder="Nhập tên ca sĩ">
                    <label for="album_image">Ảnh bìa</label>
                    <input class="form-control" type="file" id="editAlbumImage" name="album_image">
                </div>
                <button type="submit" class="btn btn-primary mt-2">Sửa album</button>
                <div class="btn btn-primary mt-2" onclick="closeAlbumEdit()">Đóng</div>
            </form>
        </div>
    </div>
</div>
<script>
    function confirmDelete() {
        return confirm('Bạn có chắc muốn xóa album');
    }
</script>
