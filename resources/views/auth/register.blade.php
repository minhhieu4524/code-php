<!DOCTYPE html>
<html lang="en">
<head>
  <title>Đăng ký</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5" style="max-width: 450px;">
    <div class="card shadow">
        <div class="card-header bg-success text-white text-center">
            <h4>Đăng ký tài khoản mới</h4>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p class="mb-0">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Họ và tên:</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label>Địa chỉ Email:</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label>Mật khẩu:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Nhập lại mật khẩu:</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success btn-block">Đăng ký</button>
            </form>
            <div class="text-center mt-3">
                <p>Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập ngay</a></p>
                <p><a href="{{ route('home') }}">← Quay về trang chủ</a></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>