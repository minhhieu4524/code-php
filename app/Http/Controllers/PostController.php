<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Hiển thị form tạo bài viết mới.
     */
    public function create() {
        return view('post.create');
    }

    /**
     * Lưu bài viết mới vào CSDL (Hỗ trợ 3 trạng thái: nháp, đã đăng, hẹn giờ).
     */
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => 'required|in:draft,published,scheduled',
            'published_at' => 'nullable|required_if:status,scheduled|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        // Xử lý thời gian xuất bản dựa theo trạng thái
        $publishedAt = null;
        if ($request->status === 'published') {
            $publishedAt = now();
        } elseif ($request->status === 'scheduled') {
            $publishedAt = $request->published_at;
        }

        Post::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'content' => $request->input('content', $request->description), // Hoặc lấy từ ô nội dung chi tiết nếu có
            'image' => $imagePath,
            'status' => $request->status,
            'published_at' => $publishedAt,
        ]);

        return redirect()->route('home')->with('success', 'Đăng bài viết thành công!');
    }

    /**
     * Hiển thị form chỉnh sửa bài viết (Có chặn quyền ở Server).
     */
    public function edit($id) {
        $post = Post::findOrFail($id);

        // Chặn quyền server-side: Chỉ tác giả hoặc admin mới được sửa
        if ($post->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            return redirect()->route('home')->with('error', 'Bạn không có quyền chỉnh sửa bài viết này!');
        }

        return view('post.edit', compact('post'));
    }

    /**
     * Cập nhật bài viết (Có chặn quyền ở Server và hỗ trợ 3 trạng thái).
     */
    public function update(Request $request, $id) {
        $post = Post::findOrFail($id);

        // Chặn quyền server-side tuyệt đối
        if ($post->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            return redirect()->route('home')->with('error', 'Bạn không có quyền chỉnh sửa bài viết này!');
        }

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => 'required|in:draft,published,scheduled',
            'published_at' => 'nullable|required_if:status,scheduled|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $post->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        $publishedAt = $post->published_at;
        if ($request->status === 'published') {
            $publishedAt = now();
        } elseif ($request->status === 'scheduled') {
            $publishedAt = $request->published_at;
        } elseif ($request->status === 'draft') {
            $publishedAt = null;
        }

        $post->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'image' => $imagePath,
            'status' => $request->status,
            'published_at' => $publishedAt,
        ]);

        return redirect()->route('home')->with('success', 'Cập nhật bài viết thành công!');
    }

    /**
     * Xóa bài viết (Chuyển vào thùng rác - SoftDeletes, chặn quyền server).
     */
    public function destroy($id) {
        $post = Post::findOrFail($id);

        // Chặn quyền server-side
        if ($post->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            return redirect()->route('home')->with('error', 'Bạn không có quyền xóa bài viết này!');
        }

        // Thực hiện xóa mềm (đưa vào thùng rác) nhờ trait SoftDeletes trong Model Post
        $post->delete();

        return redirect()->route('home')->with('success', 'Đã chuyển bài viết vào thùng rác!');
    }

    /**
     * 1. Hiển thị danh sách bài viết trong thùng rác của user hiện tại (hoặc tất cả nếu là admin).
     */
    public function trash()
    {
        $query = Post::onlyTrashed();

        // Nếu không phải admin thì chỉ xem thùng rác của chính mình
        if (auth()->user()->role !== 'admin') {
            $query->where('user_id', auth()->id());
        }

        $trashedPosts = $query->get();
                        
        return view('post.trash', compact('trashedPosts'));
    }

    /**
     * 2. Khôi phục bài viết từ thùng rác.
     */
    public function restore($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        
        if ($post->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403, 'Hành động trái phép.');
        }
        
        $post->restore();
        return back()->with('success', 'Đã khôi phục bài viết thành công.');
    }

    /**
     * 3. Xóa vĩnh viễn bài viết khỏi CSDL.
     */
    public function forceDelete($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        
        if ($post->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403, 'Hành động trái phép.');
        }
        
        $post->forceDelete();
        return back()->with('success', 'Đã xóa vĩnh viễn bài viết khỏi cơ sở dữ liệu.');
    }
}