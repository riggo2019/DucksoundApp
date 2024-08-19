<header>
    <form action="{{ route('home.index') }}" method="get" class="filter">
        <div class="left-section">
            <div class="nav-links">
                <a class="navbar-minimalize" href="#"><i class='bx bx-menu'></i> </a>
            </div>
            <div class="search">
                <button type="submit" name="search" value="search">
                    <i class='bx bx-search'></i>
                </button>
                <input type="text" placeholder="Tìm kiếm thông tin bài hát" name="keyword">
            </div>
        </div>
    </form>
    
    <div class="right-section">
        @if ($logged_in === true)
            @include('home.component.profile')
        @else
            @include('home.component.login')
        @endif
    </div>
</header>
