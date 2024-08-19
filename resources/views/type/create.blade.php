<form action="{{ route('type.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            @if (session('success'))
                <h5 class="alert alert-success">
                    {{ session('success') }}
                </h5>
            @endif
            @if (session('error'))
                <h5 class="alert alert-danger">
                    {{ session('error') }}
                </h5>
            @endif
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <label for="type_name">Thêm thể loại</label>
                <input name="type_name" type="text" class="form-control" id="type_name"
                    placeholder="Nhập tên thể loại" value="">
                @if ($errors->has('type_name'))
                    <span class="text-danger">* {{ $errors->first('type_name') }}</span>
                @endif
                <div class="text-right p-t-15">
                    <button type="submit" class="mg-btn btn btn-primary">Thêm thể loại</button>
                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>
</form>
