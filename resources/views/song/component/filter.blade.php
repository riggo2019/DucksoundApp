<form action="{{ route('song.index') }}" method="get" class="filter">

    <div class="perpage">
        @php
            $type = request('type') ?: old('type');
            $search_type = request('search_type') ?: old('search_type');
        @endphp
        <div class="action">
            <div class="col-sm-3">
                <select name="type" id="" class="form-control">
                    <option value=''>Chọn thể loại</option>
                    <option value="1" {{ $type == 1 ? 'selected' : '' }}>Pop</option>
                    <option value="2" {{ $type == 2 ? 'selected' : '' }}>Rap</option>
                    <option value="3" {{ $type == 3 ? 'selected' : '' }}>R&B</option>
                    <option value="4" {{ $type == 4 ? 'selected' : '' }}>Lofi</option>
                    <option value="5" {{ $type == 5 ? 'selected' : '' }}>Nhạc không lời</option>
                </select>
            </div>
            <div class="col-sm-6">
                <div class="col-sm-4">
                    <select name="search_type" id="" class="form-control">
                        <option value="0" {{ $search_type == 0 ? 'selected' : '' }}>Tên bài hát</option>
                        <option value="1" {{ $search_type == 1 ? 'selected' : '' }}>Ca sĩ</option>
                    </select>
                </div>
                <div class="col-sm-8">
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
            </div>
            <div class="col-sm-3">
                <a href="{{ route('song.create') }}" class="btn btn-success add-btn">
                    Thêm bài hát mới
                </a>
            </div>

        </div>
    </div>

</form>
