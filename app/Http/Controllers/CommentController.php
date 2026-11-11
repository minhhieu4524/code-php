<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Mail\NewCommentMail;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    /**
     * Lưu bình luận mới vào bài viết.
     */
    public function store(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $post = Post::findOrFail($postId);

        // Tạo bình luận mới
        $comment = Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'content' => $request->content,
        ]);

        // Ghi log thời gian bình luận với nhãn 'daily check info'
        Log::info('daily check info - New Comment Created', [
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'comment_id' => $comment->id,
            'commented_at' => now()
        ]);

        return back()->with('success', 'Bình luận của bạn đã được đăng.');
    }

    /**
     * Xóa bình luận (Kiểm tra phân quyền nghiêm ngặt ở server-side).
     */
    public function destroy($id)
    {
        $comment = Comment::with('post')->findOrFail($id);
        $user = Auth::user();

        // Kiểm tra quyền xóa: 
        // 1. Người viết bình luận
        // 2. Tác giả bài viết
        // 3. Quản trị viên (nếu tài khoản có phân quyền admin)
        $isAdmin = isset($user->role) && $user->role === 'admin';
        
        if ($comment->user_id === $user->id || $comment->post->user_id === $user->id || $isAdmin) {
            $comment->delete();

            // Ghi log thời gian xóa bình luận
            Log::info('daily check info - Comment Deleted', [
                'user_id' => $user->id,
                'comment_id' => $id,
                'deleted_at' => now()
            ]);

            return back()->with('success', 'Đã xóa bình luận thành công.');
        }

        // Nếu không đủ quyền, trả về lỗi 403
        abort(403, 'Bạn không có quyền xóa bình luận này.');
    }
}
// Bên trong hàm store của CommentController:
$comment = Comment::create([
    'user_id' => Auth::id(),
    'post_id' => $post->id,
    'content' => $request->content,
]);

// Gửi email thông báo cho tác giả bài viết qua Queue
if ($post->user && $post->user->email) {
    Mail::to($post->user->email)->queue(new NewCommentMail($comment));
}