@extends('layouts.master')

@section('content')
<div class="container-fluid mt-4">
    <h2 class="mb-4">Trang Quản Trị Hệ Thống (Admin Panel)</h2>

    <!-- Thống kê số liệu -->
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Tổng số Thành viên</h5>
                    <h3>{{ $totalUsers }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Tổng số Bài viết</h5>
                    <h3>{{ $totalPosts }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-info shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Tổng số Bình luận</h5>
                    <h3>{{ $totalComments }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Top 5 bài viết nhiều bình luận nhất -->
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-dark text-white font-weight-bold">Top 5 bài viết nhiều bình luận nhất</div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tiêu đề bài viết</th>
                        <th>Số lượng bình luận</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($topPosts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td><span class="badge badge-pill badge-info">{{ $post->comments_count }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 