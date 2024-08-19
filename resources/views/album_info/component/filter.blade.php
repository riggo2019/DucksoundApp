<form action="{{ route('album.list', ['id' => $album->id]) }}" method="get" class="filter">

    <div class="perpage">
        <div class="action">
            <div class="col-sm-10">
                <div class="input-group">
                    <span class="input-group-btn">
                        <input type="text" name="keyword" value="{{ request('keyword') ?: old('keyword') }}"
                            placeholder="Nhập từ khóa cần tìm kiếm..." class="form-control search">
                        <button class="btn btn-primary mb btn-sm h36" type="submit" name="search" value="search">
                            Tìm kiếm
                        </button>
                    </span>
                </div>
            </div>
            <div class="col-sm-1 m-0">
                <a href="{{ route('album.addSong', ['id' => $album->singer_id]) }}" class="btn btn-success add-btn">
                    Thêm bài hát vào album
                </a>
            </div>
            <div class="col-sm-1 m-0">
                <a href="{{ route('album.index') }}" class="btn btn-primary add-btn">Quay lại</a>
            </div>
        </div>
    </div>

</form>
