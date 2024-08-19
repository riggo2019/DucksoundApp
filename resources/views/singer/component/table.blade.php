@php
    use Illuminate\Support\Str;
@endphp
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên ca sĩ</th>
                            <th>Ảnh đại diện</th>
                            <th style="width: 50px">Sửa</th>
                            <th style="width: 50px">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($singers) && is_object($singers))
                            @foreach ($singers as $singer)
                                <tr>
                                    <td>
                                        {{ ++$i }}
                                    </td>
                                    <td>
                                        {{ $singer->singer_name }}
                                    </td>
                                    <td>
                                        @if ($singer->singer_image != null)
                                            <a href="{{ asset('images/singer/' . $singer->singer_image) }}"
                                                data-lightbox="roadtrip">
                                                <span class="avatar song_image m-0">
                                                    <img src="{{ asset('images/singer/' . $singer->singer_image) }}"
                                                        alt="Image">
                                                </span>
                                            </a>
                                        @else
                                            <a href="{{ asset('images/singer/default-avatar.jpg') }}"
                                                data-lightbox="roadtrip">
                                                <span class="avatar song_image m-0">
                                                    <img src="{{ asset('images/singer/default-avatar.jpg') }}"
                                                        alt="Default Image">
                                                </span>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <a onclick="openSingerEdit('{{ $singer->singer_name }}')"
                                            class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                    </td>
                                    <td>
                                        <form action="{{ route('singer.delete', ['id' => $singer->id]) }}"
                                            method="POST" onsubmit="return confirmDelete()">
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
            </div>

        </div>
        <div class="col-md-4 ">
            <form action="{{ route('singer.store') }}" method="post" id="addSingerForm" class="dn"
                enctype="multipart/form-data">
                @csrf
                <div class="header">Thêm ca sĩ</div>
                <div class="form-group">
                    <label for="typeName">Tên ca sĩ</label>
                    <input type="text" class="form-control" id="addSingerName" name="singer_name"
                        placeholder="Nhập tên ca sĩ">
                    <label for="singer_image">Ảnh bìa</label>
                    <input class="form-control" type="file" id="addSingerImage" name="singer_image">
                </div>
                <button type="submit" class="btn btn-primary mt-2">Thêm ca sĩ</button>
                <div class="btn btn-primary mt-2" onclick="closeSingerAdd()">Đóng</div>
            </form>
        </div>

        <div class="col-md-4">
            <form action="{{ route('singer.update', ['id' => $singer->id]) }}" method="post" id="editSingerForm"
                class="dn" enctype="multipart/form-data">
                @csrf
                <div class="header">Đổi tên ca sĩ</div>
                <div class="form-group">
                    <label for="typeName">Tên ca sĩ</label>
                    <input type="text" class="form-control" id="editSingerName" name="singer_name"
                        placeholder="Nhập tên ca sĩ">
                    <label for="singer_image">Ảnh bìa</label>
                    <input class="form-control" type="file" id="editSingerImage" name="singer_image">
                </div>
                <button type="submit" class="btn btn-primary mt-2">Sửa ca sĩ</button>
                <div class="btn btn-primary mt-2" onclick="closeSingerEdit()">Đóng</div>
            </form>
        </div>
    </div>
</div>
<script>
    function confirmDelete() {
        return confirm('Bạn có chắc muốn xóa ca sĩ');
    }
</script>
