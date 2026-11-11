<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Hiển thị trang chủ với danh sách bài viết và tìm kiếm.
     */
    public function index(Request $request)
    {
        // Khởi tạo truy vấn lấy các bài viết đã được đăng ('published') và không bị xóa mềm
        $query = Post::where('status', 'published')->with('user');

        // 1. Xử lý tìm kiếm theo từ khóa tiêu đề
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', '%' . $search . '%');
        }

        // Phân trang kết quả (5 bài viết mỗi trang) mới nhất lên đầu
        $posts = $query->latest()->paginate(5)->withQueryString();

        return view('welcome', compact('posts')); // Hoặc view('home') tùy theo file giao diện bạn đang dùng
    }
}