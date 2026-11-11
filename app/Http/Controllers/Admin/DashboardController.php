<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalPosts = Post::count();
        $totalComments = Comment::count();
        
        // Top 5 bài viết có nhiều bình luận nhất
        $topPosts = Post::withCount('comments')
                        ->orderBy('comments_count', 'desc')
                        ->take(5)
                        ->get();

        return view('admin.dashboard', compact('totalUsers', 'totalPosts', 'totalComments', 'topPosts'));
    }
}