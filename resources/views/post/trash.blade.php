@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Thùng Rác Bài Viết Của Bạn</h2>
        <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm">&larr; Quay về trang chủ</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Tiêu đề bài viết</th>
                            <th>Thời gian xóa</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($trashedPosts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->deleted_at ? $post->deleted_at->format('d/m/Y H:i') : '' }}</td>
                                <td class="text-center">
                                    <!-- Nút Khôi phục -->
                                    <form action="{{ route('posts.restore', $post->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Khôi phục</button>
                                    </form>

                                    <!-- Nút Xóa vĩnh viễn -->
                                    <form action="{{ route('posts.force-delete', $post->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn bài viết này? Hành động này không thể hoàn tác!');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Xóa vĩnh viễn</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Thùng rác hiện đang trống.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection