<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Join bảng post với bảng users để lấy tên người đăng bài
        $posts = DB::table('post')
            ->join('users', 'post.user_id', '=', 'users.id')
            ->select('post.*', 'users.name as author_name')
            ->orderBy('post.id', 'desc')
            ->get();

        return view('welcome', compact('posts'));
    }
}