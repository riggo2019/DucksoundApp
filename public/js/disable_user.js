
$(document).ready(function () {
    $('#status_disable_checkbox').change(function () {
        var isChecked = $(this).is(':checked');
        var confirmation = confirm('Bạn có chắc chắn muốn thay đổi trạng thái không?');

        if (confirmation) {
            var status = isChecked ? 1 : 0;

            $.ajax({
                url: '{{ route("user.updateSd", ["id" => $user->id]) }}', // Thay đổi URL theo route của bạn
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // Thêm token CSRF để bảo mật
                    status_disable: status
                },
                success: function (response) {
                    alert('Cập nhật trạng thái thành công.');
                },
                error: function (xhr) {
                    alert('Cập nhật trạng thái thất bại.');
                    // Reset checkbox về trạng thái cũ nếu cập nhật thất bại
                    $('#status_disable_checkbox').prop('checked', !isChecked);
                }
            });
        } else {
            // Reset checkbox về trạng thái cũ nếu người dùng hủy xác nhận
            $(this).prop('checked', !isChecked);
        }
    });
});
