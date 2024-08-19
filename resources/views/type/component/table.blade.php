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
                            <th>Tên thể loại</th>
                            <th style="width: 50px">Sửa</th>
                            <th style="width: 50px">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($types) && is_object($types))
                            @foreach ($types as $type)
                                <tr>
                                    <td>
                                        {{ ++$i}}
                                    </td>
                                    <td>
                                        {{ $type->type_name }}
                                    </td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" onclick="openTypeEdit('{{ $type->type_name }}')"><i class="fa-solid fa-pen-to-square"></i></button>
                                    </td>
                                    <td>
                                        <form action="{{ route('type.delete', ['id' => $type->id]) }}" method="POST" onsubmit="return confirmDelete()">
                                            @csrf
                                            @method('DELETE')   
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
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
            <form action="{{ route('type.store') }}" method="post" id="addTypeForm" class="dn" enctype="multipart/form-data">
                @csrf
                <div class="header">Thêm thể loại</div>
                <div class="form-group">
                    <label for="typeName">Tên thể loại</label>
                    <input type="text" class="form-control" id="addTypeName" name="typeName" placeholder="Nhập tên thể loại">
                </div>
                <button type="submit" class="btn btn-primary mt-2">Thêm thể loại</button>
                <div class="btn btn-primary mt-2" onclick="closeTypeAdd()">Đóng</div>
            </form>
        </div>
        
        <div class="col-md-4">
            <form action="{{ route('type.update', ['id' => $type->id]) }}" method="post" id="editTypeForm" class="dn" enctype="multipart/form-data">
                @csrf
                <div class="header">Đổi tên thể loại</div>
                <div class="form-group">
                    <label for="typeName">Tên thể loại</label>
                    <input type="text" class="form-control"  id="editTypeName" name="typeName" placeholder="Nhập tên thể loại">
                </div>
                <button type="submit" class="btn btn-primary mt-2">Đổi tên thể loại</button>
                <div class="btn btn-primary mt-2" onclick="closeTypeEdit()">Đóng</div>
            </form>
        </div>
    </div>
</div>

<script>
    function confirmDelete() {
        return confirm('Bạn có chắc muốn xóa bài hát');
    }
</script>
