<!DOCTYPE html>
<html lang="en">
<head>
  <title>Trang chủ blog</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>
  .fakeimg {
    height: 200px;
    background: #aaa;
  }
  </style>
</head>
<body>

<div class="jumbotron text-center" style="margin-bottom:0">
  <h1>Blog đầu tiên</h1>
  <p>Hệ thống tin tức và chia sẻ bài viết cá nhân</p> 
</div>

<!-- THANH NAVBAR -->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="{{ route('home') }}">Trang Chủ</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">
      @auth
        <li class="nav-item">
          <span class="nav-link text-warning font-weight-bold">Xin chào, {{ auth()->user()->name }}</span>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-success text-white px-3 ml-2" href="{{ route('posts.create') }}">Viết bài mới</a>
        </li>
        <li class="nav-item">
          <form action="{{ route('logout') }}" method="POST" class="d-inline ml-2">
            @csrf
            <button type="submit" class="nav-link btn btn-danger text-white px-3 border-0" style="background: none;">Đăng xuất</button>
          </form>
        </li>
      @else
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">Đăng ký</a>
        </li>
      @endauth
    </ul>
  </div>  
</nav>

<div class="container" style="margin-top:30px">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

  <div class="row">
    <!-- CỘT BÊN TRÁI: THÔNG TIN TÀI KHOẢN / CÁ NHÂN -->
    <div class="col-sm-4">
      <div class="card shadow-sm mb-4">
        <div class="card-header bg-secondary text-white">
          <h4 class="mb-0">Thông tin cá nhân</h4>
        </div>
        <div class="card-body text-center">
          @auth
            <div class="mb-3">
              <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center font-weight-bold" style="width: 80px; height: 80px; font-size: 32px;">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
              </div>
            </div>
            <h5 class="font-weight-bold">{{ auth()->user()->name }}</h5>
            <p class="text-muted mb-2">{{ auth()->user()->email }}</p>
            <p class="small text-success font-weight-bold">● Đang hoạt động</p>
            <hr>
            <a href="{{ route('posts.create') }}" class="btn btn-outline-primary btn-block btn-sm">Viết bài mới ngay</a>
          @else
            <div class="fakeimg mb-3 d-flex align-items-center justify-content-center text-white">Ảnh đại diện</div>
            <h5>Khách tham quan</h5>
            <p class="text-muted small">Hãy đăng nhập để tương tác, quản lý tài khoản và đăng bài viết của riêng bạn.</p>
            <a href="{{ route('login') }}" class="btn btn-primary btn-block btn-sm">Đăng nhập ngay</a>
          @endauth
        </div>
      </div>
    </div>
    
    <!-- CỘT BÊN PHẢI: DANH SÁCH BÀI VIẾT -->
    <div class="col-sm-8">
      <h2>Danh sách bài viết</h2>
      <hr>
      @forelse($posts as $post)
          <div class="mb-5 card p-4 shadow-sm">
              <h3 class="text-primary">{{ $post->title }}</h3>
              
              <!-- Hiển thị tên tác giả liên kết từ bảng users -->
              <h6 class="text-muted mb-3">
                  Tác giả: <span class="text-dark font-weight-bold">{{ $post->author_name ?? 'Ẩn danh' }}</span> | Ngày đăng: {{ $post->created_at }}
              </h6>
              
              @if(!empty($post->image))
                  <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid mb-3 rounded" alt="Ảnh bài viết" style="max-height: 350px; object-fit: cover; width: 100%;">
              @endif

              <p style="white-space: pre-line;">{{ $post->description }}</p>

              <!-- Chỉ hiện nút Sửa/Xóa nếu user đang đăng nhập là chủ bài viết -->
              @auth
                  @if($post->user_id == auth()->id())
                      <div class="mt-3">
                          <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm text-white">Sửa bài viết</a>
                          <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa bài viết này không?');">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-sm">Xóa bài viết</button>
                          </form>
                      </div>
                  @endif
              @endauth
          </div>
      @empty
          <div class="alert alert-info">Chưa có bài viết nào được đăng. Hãy đăng nhập và tạo bài viết đầu tiên của bạn!</div>
      @endforelse
    </div>
  </div>
</div>

<div class="jumbotron text-center" style="margin-bottom:0; margin-top:30px;">
  <p class="mb-0">Footer - Bản quyền thuộc về Blog của bạn</p>
</div>

</body>
</html>