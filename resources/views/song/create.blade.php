@include('dashboard.component.breadcrumb', ['title' => $config['seo']['create']['title']])


<form action="{{ route('song.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="col-sm-4">
            <div class="panel-title">Thông tin bài hát</div>
            <div class="panel-description">
                <p>Nhập thông tin bài hát mới</p>
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
                    <label for="song_name">Tên bài hát</label>
                    <span class="text-danger">(*)</span>
                    <input name="song_name" type="text" class="form-control" id="song_name"
                        placeholder="Nhập tên bài hát" value="{{ old('song_name') }}">
                    @if ($errors->has('song_name'))
                        <span class="text-danger">* {{ $errors->first('song_name') }}</span>
                    @endif
                </div>
                <div class="form-group m-t-20">
                    <label for="type_id">Thể loại</label>
                    <span class="text-danger">(*)</span>
                    <select name="type_id" id="type_id" class="form-control">
                        <option value="">[Chọn thể loại]</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('type_id'))
                        <span class="text-danger">* {{ $errors->first('type_id') }}</span>
                    @endif
                </div>
                <div class="form-group m-t-20">
                    <label for="song_image">Ảnh bìa</label>
                    <input class="form-control" type="file" id="song_image" name="song_image">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group m-t-20">
                    <label for="nation">Quốc gia</label>
                    <span class="text-danger">(*)</span>
                    <select name="nation" class="form-control nation" id="nation" value="{{ old('nation') }}">
                        <option>[Chọn quốc gia]</option>
                        <option value="0">Việt Nam</option>
                        <option value="1">Quốc tế</option>
                    </select>
                    @if ($errors->has('nation'))
                        <span class="text-danger">* {{ $errors->first('nation') }}</span>
                    @endif
                </div>
                <div class="form-group m-t-20">
                    <label for="singer_id">Ca sĩ</label>
                    <span class="text-danger">(*)</span>
                    <select name="singer_id" id="singer_id" class="form-control">
                        <option value="">[Chọn ca sĩ]</option>
                        @foreach ($singers as $singer)
                            <option value="{{ $singer->id }}">{{ $singer->singer_name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('singer_id'))
                        <span class="text-danger">* {{ $errors->first('singer_id') }}</span>
                    @endif
                </div>
                <div class="form-group m-t-20">
                    <label for="song_file">File</label>
                    <span class="text-danger">(*)</span>
                    <input class="form-control" type="file" id="song_file" name="song_file">
                    @if ($errors->has('song_file'))
                        <span class="text-danger">* {{ $errors->first('song_file') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-sm-12">
                <label for="lyrics">Lời bài hát</label>
                <textarea id="lyrics" rows="5" name="lyrics" placeholder="Nhập lời bài hát"></textarea>
            </div>
        </div>
    </div>
    <div class="text-right">
        <button type="submit" class="mg-btn btn btn-primary">Thêm bài hát</button>
        <a href="{{ route('song.index') }}" class="mg-btn btn btn-success mr50">Quay lại</a>
    </div>
</form>
