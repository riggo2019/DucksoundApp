<form action="{{ route('singer.store') }}" method="post" enctype="multipart/form-data">
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
            <div class="col-sm-12">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <label for="singer_name">Thêm ca sĩ</label>
                    <input name="singer_name" type="text" class="form-control" id="singer_name"
                        placeholder="Nhập tên ca sĩ" value="">
                    @if ($errors->has('singer_name'))
                        <span class="text-danger">* {{ $errors->first('singer_name') }}</span>
                    @endif
                    <div class="form-group m-t-20">
                        <label for="singer_image">Ảnh bìa</label>
                        <input class="form-control" type="file" id="singer_image" name="singer_image">
                    </div>
                    <div class="text-right p-t-15">
                        <button singer="submit" class="mg-btn btn btn-primary">Thêm ca sĩ</button>
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </div>
    </div>
</form>
