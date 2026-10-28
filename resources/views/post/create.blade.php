<!DOCTYPE html>
<html lang="en">
<head>
  <title>Viết bài mới</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5" style="max-width: 600px;">
    <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
            <h4>Tạo bài viết mới</h4>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p class="mb-0">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Tiêu đề bài viết:</label>
                    <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
                </div>

                <div class="form-group">
                    <label>Nội dung bài viết:</label>
                    <textarea name="description" class="form-control" rows="6" required>{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Ảnh bài viết (Định dạng: jpeg, png, jpg, gif | Tối đa: 2MB):</label>
                    <input type="file" name="image" class="form-control-file">
                </div>

                <button type="submit" class="btn btn-success btn-block">Đăng bài</button>
            </form>
            <div class="text-center mt-3">
                <p><a href="{{ route('home') }}">← Quay về trang chủ</a></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>