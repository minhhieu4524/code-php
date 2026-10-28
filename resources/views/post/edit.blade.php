    <!DOCTYPE html>
<html lang="en">
<head>
  <title>Sửa bài viết</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5" style="max-width: 600px;">
    <div class="card shadow">
        <div class="card-header bg-warning text-dark text-center">
            <h4>Chỉnh sửa bài viết</h4>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p class="mb-0">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Tiêu đề bài viết:</label>
                    <input type="text" name="title" class="form-control" required value="{{ $post->title }}">
                </div>

                <div class="form-group">
                    <label>Nội dung bài viết:</label>
                    <textarea name="description" class="form-control" rows="6" required>{{ $post->description }}</textarea>
                </div>

                <div class="form-group">
                    <label>Ảnh hiện tại:</label><br>
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid mb-2" style="max-height: 150px;">
                    @else
                        <p>Không có ảnh</p>
                    @endif
                    <br>
                    <label>Đổi ảnh mới (nếu muốn):</label>
                    <input type="file" name="image" class="form-control-file">
                </div>

                <button type="submit" class="btn btn-warning btn-block text-white">Cập nhật bài viết</button>
            </form>
            <div class="text-center mt-3">
                <p><a href="{{ route('home') }}">← Quay về trang chủ</a></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>