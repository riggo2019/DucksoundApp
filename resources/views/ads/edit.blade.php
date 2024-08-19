@include('dashboard.component.breadcrumb', ['title' => $config['seo']['edit']['title']])
<form action="{{ route('ads.update', ['id' => $ads->id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="col-sm-4">
            <div class="panel-title">Thông tin quảng cáo</div>
            <div class="panel-description">
                <p>Sửa thông tin quảng cáo</p>
                <p>Lưu ý, những trường được đánh dấu <span class="text-danger">(*)</span> là bắt buộc</p>
            </div>
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
        </div>
        <div class="col-sm-8">
            <div class="col-sm-6">
                <div class="form-group m-t-20">
                    <label for="ads_name">Tiêu đề</label>
                    <span class="text-danger">(*)</span>
                    <input name="ads_name" type="text" class="form-control" id="ads_name" placeholder="Nhập tiêu đề"
                        value="{{ $ads->ads_name }}">
                    @if ($errors->has('ads_name'))
                        <span class="text-danger">* {{ $errors->first('ads_name') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group m-t-20">
                    <label for="ads_file">File quảng cáo</label>
                    <input class="form-control" type="file" id="ads_file" name="ads_file">
                </div>
            </div>

            <div class="col-sm-12">
                <label for="description">Nội dung</label>
                <span class="text-danger">(*)</span>
                <textarea id="description" rows="5" name="description" placeholder="Nhập nội dung">{{ $ads->description }}</textarea>
            </div>
            <div class="col-sm-6">
                <div class="form-group m-t-20">
                    <label for="ads_image">Ảnh quảng cáo</label>
                    <input class="form-control" type="file" id="ads_image" name="ads_image">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group m-t-20">
                    <label for="owner_company">Công ty sở hữu</label>
                    <span class="text-danger">(*)</span>
                    <input name="owner_company" type="text" class="form-control" id="owner_company" placeholder="Nhập tiêu đề"
                        value="{{ $ads->owner_company }}">
                    @if ($errors->has('owner_company'))
                        <span class="text-danger">* {{ $errors->first('owner_company') }}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="text-right">
            <button type="submit" class="mg-btn btn btn-primary">Cập nhật quảng cáo</button>
            <a href="{{ route('ads.index') }}" class="mg-btn btn btn-success mr50">Quay lại</a>
        </div>
    </div>
</form>
