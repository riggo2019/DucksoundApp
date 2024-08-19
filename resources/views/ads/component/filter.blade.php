<form action="{{ route('ads.index') }}" method="get" class="filter">

    <div class="perpage">
        <div class="action">
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
            <div class="col-sm-3">
                <a href="{{ route('ads.create') }}" class="btn btn-success add-btn">
                    Thêm quảng cáo mới
                </a>
            </div>

        </div>
    </div>

</form>
