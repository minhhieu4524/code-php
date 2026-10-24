<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title ?? 'Chi tiết bài viết' }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f6f9; }
        .post-container { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); max-width: 700px; margin: auto; }
        h1 { color: #333; }
        .meta { color: #775; font-size: 14px; margin-bottom: 20px; }
        .content { line-height: 1.6; color: #555; }
    </style>
</head>
<body>

    <div class="post-container">
        <!-- Hiển thị tiêu đề bài viết -->
        <h1>{{ $post->title }}</h1>
        
        <div class="meta">
            <p><strong>Slug:</strong> {{ $post->slug }}</p>
            <p><strong>Ngày đăng:</strong> {{ $post->created_at }}</p>
        </div>

        <hr>

        <!-- Hiển thị mô tả/nội dung bài viết -->
        <div class="content">
            <p>{{ $post->description }}</p>
        </div>
    </div>

</body>
</html>