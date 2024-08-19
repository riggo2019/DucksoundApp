@include('dashboard.component.breadcrumb', ['title' => $config['seo']['edit']['title']])
<form action="{{ route('song.update', ['id' => $song->id]) }}" method="post" enctype="multipart/form-data">
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
                <div class="form-group mg-form">
                    <label for="song_name">Tên bài hát</label>
                    <span class="text-danger">(*)</span>
                    <input name="song_name" type="text" class="form-control" id="song_name"
                        placeholder="Nhập tên bài hát" value="{{ $song->song_name }}">
                </div>
                <div class="form-group mg-form">
                    <label for="type_id">Thể loại</label>
                    <span class="text-danger">(*)</span>

                    <select name="type_id" id="type_id" class="form-control">
                        <option value="">[Chọn thể loại]</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}" {{ $song->type_id == $type->id ? 'selected' : '' }}>
                                {{ $type->type_name }}</option>
                        @endforeach
                    </select>

                </div>

                <div class="form-group">
                    <label for="song_file">File</label>
                    <span class="text-danger">(*)</span>
                    <input class="form-control" type="file" id="song_file" name="song_file" value="{{ $song->song_file }}">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="nation">Quốc gia</label>
                    <span class="text-danger">(*)</span>
                    <select name="nation" class="form-control nation" id="nation" value="{{ old('nation') }}">
                        <option>[Chọn quốc gia]</option>
                        <option value="0" {{ $song->nation == 0 ? 'selected' : '' }}>Việt Nam</option>
                        <option value="1" {{ $song->nation == 1 ? 'selected' : '' }}>Quốc tế</option>
                    </select>
                </div>
                <div class="form-group mg-form">
                    <label for="singer_id">Ca sĩ</label>
                    <span class="text-danger">(*)</span>
                    <select name="singer_id" id="singer_id" class="form-control">
                        <option value="">[Chọn thể loại]</option>
                        @foreach ($singers as $singer)
                            <option value="{{ $singer->id }}"
                                {{ $song->singer_id == $singer->id ? 'selected' : '' }}>{{ $singer->singer_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="song_image">Ảnh bìa</label>
                    <input class="form-control" type="file" id="song_image" name="song_image">
                </div>

            </div>
            <div class="col-sm-12">
                <div class="col-sm-8 p-0">
                    <label for="lyrics">Lời bài hát</label>
                    <textarea id="lyrics" rows="5" name="lyrics" placeholder="Nhập lời bài hát">{{ $song->lyrics }}</textarea>
                </div>
                <div class="col-sm-4 p-0">
                    <label for="avatar" class="m-l-10">Ảnh bìa</label>
                    <span id="avatar" class="avatar users-avatar"><img
                            src="{{ asset('images/song/' . $song->song_image) }}" alt="Avatar"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="text-right">
        <button type="submit" class="mg-btn btn btn-primary">Cập nhật bài hát</button>
        <a href="{{ route('song.index') }}" class="mg-btn btn btn-success mr50">Quay lại</a>
    </div>
</form>
