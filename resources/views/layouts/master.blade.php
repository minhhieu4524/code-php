<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'V-News - Báo điện tử tiếng Việt')</title>
    
    <!-- Bootstrap 4 CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
        body { background-color: #f7f7f7; font-family: Arial, sans-serif; }
        .vn-header-top { font-size: 13px; border-bottom: 1px solid #e5e5e5; background: #fff; padding: 6px 0; }
        .vn-navbar { background-color: #0b5ed7 !important; }
        .vn-navbar .nav-link { color: #fff !important; font-weight: 600; text-transform: uppercase; font-size: 13px; padding-left: 12px; padding-right: 12px; }
        .vn-navbar .nav-link:hover { color: #ffc107 !important; }
        .sidebar-box { background: #fff; border-top: 3px solid #0b5ed7; padding: 15px; margin-bottom: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .sidebar-box h5 { font-size: 15px; font-weight: bold; text-transform: uppercase; color: #0b5ed7; border-bottom: 1px solid #eee; padding-bottom: 8px; margin-bottom: 15px; }
        footer { background: #222; color: #aaa; padding: 40px 0 20px; font-size: 13px; }
    </style>
</head>
<body>

    <!-- Thanh topbar hiển thị ngày tháng -->
    <div class="vn-header-top d-none d-md-block">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <span class="text-muted"><i class="far fa-calendar-alt mr-1"></i> Thứ Bảy, 24/10/2026</span>
            </div>
            <div>
                <a href="#" class="text-dark mr-3 text-decoration-none">Mới nhất</a>
                <a href="#" class="text-dark mr-3 text-decoration-none">Tin nổi bật</a>
                <a href="#" class="text-dark text-decoration-none"><i class="fas fa-search mr-1"></i> Tìm kiếm</a>
            </div>
        </div>
    </div>

    <!-- Header chính & Logo -->
    <div class="bg-white py-3 border-bottom">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="{{ url('/') }}" class="text-decoration-none">
                <span style="background: #900; color: #fff; padding: 4px 10px; font-weight: bold; font-size: 20px; border-radius: 3px;">V-NEWS</span>
                <span class="text-dark font-weight-bold ml-2 h4 mb-0 d-none d-sm-inline">Báo Điện Tử</span>
            </a>
            <div class="d-none d-lg-block text-muted small">
                Hệ thống thông tin tổng hợp trực tuyến nhanh chóng & chính xác
            </div>
        </div>
    </div>

    <!-- Thanh Menu chuyên mục (Header file) -->
    @include('layouts.header')

    <!-- Nội dung thay đổi linh hoạt giữa các trang -->
    <div class="container my-4">
        @yield('content')
    </div>

    <!-- Footer chân trang -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5 class="text-white font-weight-bold">V-NEWS - BÁO ĐIỆN TỬ</h5>
                    <p class="small">Tổng biên tập: Vũ Minh Hiếu<br>Trụ sở: Hà Nội, Việt Nam<br>Hotline: 0343.669.581</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5 class="text-white font-weight-bold">Chuyên mục chính</h5>
                    <ul class="list-unstyled small">
                        <li><a href="#" class="text-light">Thời sự</a></li>
                        <li><a href="#" class="text-light">Thế giới</a></li>
                        <li><a href="#" class="text-light">Kinh doanh</a></li>
                        <li><a href="#" class="text-light">Khoa học - Công nghệ</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="text-white font-weight-bold">Hợp tác phát triển</h5>
                    <p class="small">Ứng dụng xây dựng trên nền tảng Laravel Framework kết hợp Bootstrap 4 và Query Builder.</p>
                </div>
            </div>
            <hr style="border-color: #444;">
            <div class="text-center pt-2">
                <p class="mb-0">&copy; 2026 V-News. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>