<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Không tìm thấy trang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="text-center">
        <h1 class="display-1 font-weight-bold text-danger">404</h1>
        <h3 class="mb-3">Trang bạn tìm kiếm không tồn tại!</h3>
        <p class="text-muted mb-4">Có thể đường dẫn đã bị hỏng hoặc trang đã bị xóa.</p>
        <a href="{{ route('home') }}" class="btn btn-primary px-4">Quay về trang chủ</a>
    </div>
</body>
</html>