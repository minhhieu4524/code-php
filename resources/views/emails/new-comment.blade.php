<h2>Xin chào {{ $comment->post->user->name ?? 'Tác giả' }},</h2>
<p>Bài viết của bạn vừa nhận được một bình luận mới từ tài khoản: <strong>{{ $comment->user->name ?? 'Người dùng' }}</strong></p>
<p>Nội dung bình luận: <em>"{{ $comment->content }}"</em></p>
<p>Hãy truy cập vào hệ thống để xem chi tiết.</p>