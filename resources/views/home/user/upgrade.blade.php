<div id="upgrade-content">
    <form action="{{ route('home.payment') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="header">
            <a href="{{ route('home.index') }}" title="Về trang chủ"><i class='bx bx-arrow-back'></i></a>
            <h5>Nâng cấp tài khoản</h5>
            <a href="{{ route('home.playlist') }}"></a>
        </div>
        <div class="container">
            <div class="title">Xin chào {{ $user->fullname }}</div>
            <div class="description">
                <h3>Nâng cấp tài khoản để trải nghiệm các tính năng cao cấp</h3>
                <ul class="checklist">
                    <h4>Đặc quyền đặc biệt:</h4>
                    <li><i class='bx bx-check'></i>Nghe nhạc không quảng cáo</li>
                    <li><i class='bx bx-check'></i>Tải nhạc về thiết bị cá nhân</li>
                    <li><i class='bx bx-check'></i>Không giới hạn số lượng playlist cá nhân</li>
                </ul>
            </div>
            <div class="card">
                <input type="hidden" value="" name="priceValue" id="priceValue">
                <div class="card-item">
                    <div class="title">Gói tháng</div>
                    <div class="price">20.000 đồng / tháng</div>
                    <button type="submit" onclick="setSubscriptionValue(20000)">Đăng ký gói</button>
                </div>
                <div class="card-item">
                    <div class="title">Gói năm</div>
                    <div class="price">200.000 đồng / năm</div>
                    <button type="submit" onclick="setSubscriptionValue(200000)">Đăng ký gói</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    function setSubscriptionValue(value) {
        document.getElementById('priceValue').value = value;
    }
</script>
