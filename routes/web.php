<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

// 1. Trang chủ (Hiển thị danh sách bài viết)
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. Xác thực tài khoản (Đăng nhập, Đăng ký, Quên mật khẩu, Đăng xuất)
Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::post('/login', [UserController::class, 'login']);

Route::get('/register', [UserController::class, 'showRegister'])->name('register');
Route::post('/register', [UserController::class, 'register']);

// Quên mật khẩu & Cấp lại mật khẩu
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::post('/forgot-password', [UserController::class, 'forgotPassword'])->name('password.email');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// 3. Quản lý bài viết (Yêu cầu phải đăng nhập qua middleware 'auth')
Route::middleware('auth')->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
});

// 4. Route kiểm tra trang lỗi tùy chỉnh
Route::get('/404', function () {
    abort(404);
});