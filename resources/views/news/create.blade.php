@include('dashboard.component.breadcrumb', ['title' => $config['seo']['create']['title']])


<form action="{{ route('news.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="col-sm-4">
            <div class="panel-title">Thông tin tin tức</div>
            <div class="panel-description">
                <p>Nhập thông tin tin tức mới</p>
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
                    <label for="title">Tiêu đề</label>
                    <span class="text-danger">(*)</span>
                    <input name="title" type="text" class="form-control" id="title" placeholder="Nhập tiêu đề"
                        value="{{ old('title') }}">
                    @if ($errors->has('title'))
                        <span class="text-danger">* {{ $errors->first('title') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group m-t-20">
                    <label for="news_image">Ảnh bìa</label>
                    <input class="form-control" type="file" id="news_image" name="news_image">
                </div>
            </div>

            <div class="col-sm-12">
                <label for="description">Nội dung</label>
                <span class="text-danger">(*)</span>
                <textarea id="description" rows="5" name="description" placeholder="Nhập nội dung"></textarea>
            </div>

        </div>
    </div>
    <div class="text-right">
        <button type="submit" class="mg-btn btn btn-primary">Thêm tin tức</button>
        <a href="{{ route('news.index') }}" class="mg-btn btn btn-success mr50">Quay lại</a>
    </div>
</form>
