<nav class="navbar navbar-expand-lg navbar-dark vn-navbar shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand d-lg-none font-weight-bold" href="{{ url('/') }}">V-NEWS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#vnNavbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="vnNavbarNav">
      <ul class="navbar-nav ml-auto">
    <li class="nav-item active"><a class="nav-link" href="{{ url('/') }}"><i class="fas fa-home"></i></a></li>
    <li class="nav-item"><a class="nav-link" href="#">Thời sự</a></li>
    <li class="nav-item"><a class="nav-link" href="#">Góc nhìn</a></li>
    <li class="nav-item"><a class="nav-link" href="#">Thế giới</a></li>
    <li class="nav-item"><a class="nav-link" href="#">Kinh doanh</a></li>
    <li class="nav-item"><a class="nav-link" href="#">Giải trí</a></li>
    <li class="nav-item"><a class="nav-link" href="#">Thể thao</a></li>
    <li class="nav-item"><a class="nav-link" href="#">Pháp luật</a></li>
    <li class="nav-item"><a class="nav-link" href="#">Công nghệ</a></li>

    <!-- Thêm phần kiểm tra trạng thái đăng nhập của User -->
    @auth
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <!-- Form Đăng xuất có chứa @csrf để tránh lỗi 419 -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item">Đăng xuất</button>
                </form>
            </div>
        </li>
    @else
        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Đăng nhập</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Đăng ký</a></li>
    @endauth
</ul>
    </div>
  </div>
</nav>