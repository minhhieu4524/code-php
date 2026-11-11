<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    // Khai báo tên bảng nếu trong database của bạn là 'post' (hoặc 'posts' tùy thuộc vào thực tế DB của bạn)
    protected $table = 'post'; 

    // Các trường cho phép thêm/sửa dữ liệu hàng loạt (Mass Assignment)
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'content',
        'image',
        'status',
        'published_at',
    ];

    /**
     * Mối quan hệ: Một bài viết thuộc về một Tác giả (User).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Mối quan hệ: Một bài viết có nhiều Bình luận (Comments).
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
}