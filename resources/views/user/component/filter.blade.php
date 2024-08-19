<form action="{{ route('user.index') }}" method="get" class="filter">

    <div class="perpage">
        @php
            $role = request('role') ?: old('role');
            $search_type = request('search_type') ?: old('search_type');
        @endphp
        <div class="action">
            <div class="col-sm-3">
                <select name="role" id="" class="form-control">
                    <option value="" {{ $role == '' ? 'selected' : '' }}>Chọn nhóm người dùng</option>
                    <option value="1" {{ $role == 1 ? 'selected' : '' }}>Người dùng chưa kích hoạt</option>
                    <option value="2" {{ $role == 2 ? 'selected' : '' }}>Người dùng</option>
                    <option value="3" {{ $role == 3 ? 'selected' : '' }}>Người dùng VIP</option>
                    <option value="4" {{ $role == 4 ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <div class="col-sm-6">
                <div class="col-sm-4">
                    <select name="search_type" id="" class="form-control">
                        <option value="0" {{ $search_type == 0 ? 'selected' : '' }}>Họ và tên</option>
                        <option value="1" {{ $search_type == 1 ? 'selected' : '' }}>Email</option>
                        <option value="2" {{ $search_type == 2 ? 'selected' : '' }}>Số điện thoại</option>
                    </select>
                </div>
                <div class="col-sm-8">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <input type="text" name="keyword" value=""
                                placeholder="Nhập từ khóa cần tìm kiếm..." class="form-control search">
                            <button class="btn btn-primary mb btn-sm h36" type="submit" name="search" value="search">
                                Tìm kiếm
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <a href="{{ route('user.create') }}" class="btn btn-success add-btn">
                    Thêm người dùng
                </a>
            </div>

        </div>
    </div>

</form>
