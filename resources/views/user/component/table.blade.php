<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>STT</th>
                <th style="width: 50px">Avatar</th>
                <th>Họ và tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Trạng thái</th>
                <th>Sửa thông tin</th>
                <th>Vô hiệu hóa</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($users) && is_object($users))
                @foreach ($users as $user)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>
                            @if ($user->image != null)
                                <a href="{{ asset('images/user/' . $user->image) }}" data-lightbox="roadtrip">
                                    <span class="avatar song_image  m-0">
                                        <img src="{{ asset('images/user/' . $user->image) }}" alt="Avatar">
                                    </span>
                                </a>
                            @else
                                <a href="{{ asset('images/user/default-avatar.jpg') }}" data-lightbox="roadtrip">
                                    <span class="avatar song_image  m-0">
                                        <img src="{{ asset('images/user/default-avatar.jpg') }}" alt="Default Avatar">
                                    </span>
                                </a>
                            @endif
                        </td>
                        <td>
                            {{ $user->fullname }}
                        </td>
                        <td>
                            {{ $user->email }}
                        </td>
                        <td>
                            {{ $user->phone }}
                        </td>
                        <td>
                            @if ($user->status_disable == 0)
                                <button class="btn btn-secondary btn-sm">
                                    Vô hiệu hóa
                                </button>
                            @elseif ($user->status_role == 1)
                                <button class="btn btn-danger btn-sm">
                                    Chưa kích hoạt
                                </button>
                            @elseif ($user->status_role == 2)
                                <button class="btn btn-primary btn-sm">
                                    Đã kích hoạt
                                </button>
                            @elseif ($user->status_role == 3)
                                <button class="btn btn-info btn-sm">
                                    Tài khoản VIP
                                </button>
                            @elseif ($user->status_role == 4)
                                <button class="btn btn-success btn-sm">
                                    Admin
                                </button>
                            @endif

                        </td>
                        <td>
                            <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-warning btn-sm"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                        </td>
                        <td>
                            <a href="{{ route('user.updateSd', ['id' => $user->id]) }}"
                                onclick="
                               return confirm('Bạn có chắc chắn muốn thay đổi trạng thái?')">
                                <input type="checkbox" class="js-switch" id="status_disable_checkbox"
                                    {{ $user->status_disable == 1 ? 'checked' : '' }}>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    {{ $users->links('pagination::bootstrap-4') }}
</div>
