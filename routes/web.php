<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use Illuminate\Support\Facades\Schedule;

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
// Các route yêu cầu phải đăng nhập
Route::middleware('auth')->group(function () {
    // ... (các route quản lý bài viết cũ của bạn)

    // Route gửi bình luận mới cho bài viết
    Route::post('/posts/{postId}/comments', [CommentController::class, 'store'])->name('comments.store');

    // Route xóa bình luận
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
});
// Khu vực trang quản trị Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Trang thống kê tổng quan
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Quản lý danh mục
    Route::resource('categories', CategoryController::class);

    // Quản lý tất cả bài viết vi phạm / toàn trang
    Route::get('posts', [AdminPostController::class, 'index'])->name('posts.index');
    Route::delete('posts/{id}', [AdminPostController::class, 'destroy'])->name('posts.destroy');

    // Quản lý bình luận vi phạm
    Route::get('comments', [AdminCommentController::class, 'index'])->name('comments.index');
    Route::delete('comments/{id}', [AdminCommentController::class, 'destroy'])->name('comments.destroy');
});
Schedule::command('posts:publish-scheduled')->everyMinute();

Route::middleware('auth')->group(function () {
    Route::get('/posts-trash', [PostController::class, 'trash'])->name('posts.trash');
    Route::post('/posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');
    Route::delete('/posts/{id}/force-delete', [PostController::class, 'forceDelete'])->name('posts.force-delete');
});