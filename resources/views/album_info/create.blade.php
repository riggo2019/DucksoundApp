@include('dashboard.component.breadcrumb', ['title' => $config['seo']['create']['title']])

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="col-sm-6">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th style="width: 250px">Tên bài hát</th>
                        <th>Ca sĩ</th>
                        <th style="width: 50px">Thêm vào Album</th>
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
                                    {{ $song->singer_name }}
                                </td>
                                <td>
                                    <a href="{{ route('album.addAlbumlist', ['song_id' => $song->id, 'album_id' => $album->id]) }}"
                                        class="btn btn-warning btn-sm"><i class="fa-solid fa-plus"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            {{ $songs->links('pagination::bootstrap-4') }}
        </div>
    </div>
    <form action="{{ route('song.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-sm-6">
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
                    <input name="singer_name" type="text" class="form-control" id="singer_name"
                        value="{{ $singer->singer_name }}" readonly tabindex="-1">
                    <input name="singer_id" type="hidden" class="form-control" id="singer_id"
                        value="{{ $singer->id }}">
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
        <div class="text-right">
            <button type="submit" class="mg-btn btn btn-primary">Thêm bài hát</button>
            <a href="{{ route('album.list', ['id' => $album->id]) }}" class="mg-btn btn btn-success mr50">Quay lại</a>
        </div>
    </form>
</div>
