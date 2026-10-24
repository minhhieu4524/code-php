@extends('layouts.master')

@section('title', 'V-News - Trang thông tin điện tử tổng hợp')

@section('content')
<div class="row">
    
    <!-- Cột trái: Nội dung tin tức lấy từ Database qua Query Builder (8 cột) -->
    <div class="col-lg-8">
        
        <div class="bg-white p-3 mb-3 shadow-sm rounded">
            <h4 class="font-weight-bold text-uppercase border-bottom pb-2 mb-3" style="color: #0b5ed7; font-size: 16px;">
                <i class="fas fa-newspaper mr-2"></i>Tin Tức Mới Nhất
            </h4>

            @if(count($posts) > 0)
                <!-- Bài viết đầu tiên hiển thị nổi bật dạng tiêu điểm -->
                @php $firstPost = $posts[0]; @endphp
                <div class="mb-4 pb-3 border-bottom">
                    <div class="row">
                        <div class="col-md-6 mb-2 mb-md-0">
                            <img src="https://picsum.photos/600/350?random={{ $firstPost->id }}" class="img-fluid rounded w-100" alt="News Image">
                        </div>
                        <div class="col-md-6">
                            <h2 class="h5 font-weight-bold mb-2">
                                <a href="{{ url('/post/' . $firstPost->id) }}" class="text-dark text-decoration-none">{{ $firstPost->title }}</a>
                            </h2>
                            <p class="text-muted small mb-2"><i class="far fa-clock mr-1"></i>{{ $firstPost->created_at }}</p>
                            <p class="text-secondary small">{{ Str::limit($firstPost->description, 110) }}</p>
                            <a href="{{ url('/post/' . $firstPost->id) }}" class="btn btn-primary btn-sm px-3">Đọc tiếp</a>
                        </div>
                    </div>
                </div>

                <!-- Danh sách các bài viết tiếp theo -->
                <div class="list-posts">
                    @foreach($posts as $index => $post)
                        @if($index > 0)
                            <div class="media mb-3 pb-3 border-bottom align-items-center">
                                <img src="https://picsum.photos/150/100?random={{ $post->id }}" class="mr-3 rounded" style="width: 130px; height: 85px; object-fit: cover;" alt="...">
                                <div class="media-body">
                                    <h5 class="mt-0 h6 font-weight-bold">
                                        <a href="{{ url('/post/' . $post->id) }}" class="text-dark text-decoration-none">{{ $post->title }}</a>
                                    </h5>
                                    <p class="text-muted small mb-1"><i class="far fa-clock mr-1"></i>{{ $post->created_at }}</p>
                                    <p class="text-secondary small mb-0 d-none d-sm-block">{{ Str::limit($post->description, 90) }}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @else
                <div class="alert alert-warning text-center py-4">
                    <i class="fas fa-exclamation-circle fa-2x mb-2"></i>
                    <p class="mb-0">Hiện tại chưa có bản ghi bài viết nào trong cơ sở dữ liệu!</p>
                </div>
            @endif
        </div>

    </div>

    <!-- Cột phải: Sidebar tin xem nhiều và tiện ích (4 cột) -->
    <div class="col-lg-4">
        
        <!-- Tin xem nhiều / Đọc nhiều -->
        <div class="sidebar-box">
            <h5><i class="fas fa-chart-line mr-2"></i>Đọc nhiều nhất</h5>
            <ul class="list-unstyled mb-0">
                <li class="media mb-3 pb-2 border-bottom">
                    <span class="font-weight-bold text-muted mr-3 h5 mb-0">1</span>
                    <div class="media-body">
                        <a href="#" class="text-dark small font-weight-bold text-decoration-none">Giải pháp tối ưu hóa truy vấn dữ liệu với Laravel Query Builder</a>
                    </div>
                </li>
                <li class="media mb-3 pb-2 border-bottom">
                    <span class="font-weight-bold text-muted mr-3 h5 mb-0">2</span>
                    <div class="media-body">
                        <a href="#" class="text-dark small font-weight-bold text-decoration-none">Xây dựng cấu trúc layout trang web chuẩn bằng Blade Template Engine</a>
                    </div>
                </li>
                <li class="media">
                    <span class="font-weight-bold text-muted mr-3 h5 mb-0">3</span>
                    <div class="media-body">
                        <a href="#" class="text-dark small font-weight-bold text-decoration-none">Ứng dụng mô hình MVC trong phát triển phần mềm thương mại điện tử</a>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Tiện ích nhanh (Thời tiết, tài chính) -->
        <div class="sidebar-box">
            <h5><i class="fas fa-cloud-sun mr-2"></i>Thông tin tiện ích</h5>
            <div class="small text-secondary">
                <div class="d-flex justify-content-between py-1 border-bottom">
                    <span>Hà Nội</span>
                    <span class="font-weight-bold">26°C - Có mây</span>
                </div>
                <div class="d-flex justify-content-between py-1 border-bottom">
                    <span>TP. Hồ Chí Minh</span>
                    <span class="font-weight-bold">32°C - Nắng nhẹ</span>
                </div>
                <div class="d-flex justify-content-between py-1 pt-2">
                    <span>Tỷ giá USD</span>
                    <span class="font-weight-bold">25,450 ₫</span>
                </div>
            </div>
        </div>

        <!-- Khung quảng cáo mẫu -->
        <div class="sidebar-box text-center bg-light p-4">
            <p class="text-uppercase text-muted small font-weight-bold mb-1">Không gian quảng cáo</p>
            <h6 class="text-primary font-weight-bold">V-News Digital Media</h6>
            <p class="small text-muted mb-0">Liên hệ đặt banner truyền thông thương hiệu.</p>
        </div>

    </div>
</div>
@endsection