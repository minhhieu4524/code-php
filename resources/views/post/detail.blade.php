@extends('layouts.master')

@section('title', $post->title)

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="bg-white p-4 p-md-5 rounded shadow-sm">
            
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 small mb-3">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/posts') }}">Tin tức</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Chi tiết bài viết</li>
                </ol>
            </nav>

            <h1 class="font-weight-bold text-dark mb-3" style="font-size: 26px; line-height: 1.4;">{{ $post->title }}</h1>
            
            <div class="d-flex align-items-center text-muted small mb-4 pb-3 border-bottom">
                <span class="mr-3"><i class="far fa-user mr-1"></i>Tác giả: Phóng viên V-News</span>
                <span><i class="far fa-clock mr-1"></i>Đăng ngày: {{ $post->created_at }}</span>
            </div>

            <div class="mb-4 text-center">
                <img src="https://picsum.photos/850/450?random={{ $post->id }}" class="img-fluid rounded w-100" alt="News Image">
            </div>

            <div class="article-content text-secondary" style="font-size: 1.05rem; line-height: 1.8;">
                <p class="font-weight-bold text-dark">{{ $post->description }}</p>
                <p>Nội dung chi tiết của bài viết được lấy trực tiếp từ hệ thống quản lý cơ sở dữ liệu (Database) thông qua các câu lệnh truy vấn của Laravel Query Builder. Giao diện được tối ưu hóa theo mô hình báo điện tử, giúp người dùng dễ dàng nắm bắt thông tin nhanh chóng.</p>
                <p>Mọi thông tin phản hồi hoặc đóng góp ý kiến về bài viết xin vui lòng gửi về hộp thư điện tử của tòa soạn hoặc để lại bình luận phía bên dưới hệ thống.</p>
            </div>

            <div class="mt-5 pt-3 border-top d-flex justify-content-between align-items-center">
                <a href="{{ url('/') }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-arrow-left mr-1"></i> Quay lại trang chủ
                </a>
                <span class="text-muted small">Chia sẻ: <i class="fab fa-facebook text-primary ml-1"></i> <i class="fab fa-twitter text-info ml-1"></i></span>
            </div>

        </div>
    </div>
</div>
@endsection 