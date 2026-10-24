<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Khai báo tiêu đề truyền từ Controller sang View
        $title = "Trang Chủ - Quản Lý Website Bán Hàng";
        
        // Truyền biến $title sang file view (ví dụ: view 'welcome' hoặc view mới)
        return view('welcome', compact('title'));
    }
}