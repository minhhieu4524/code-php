<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function create() {
        return view('post.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        DB::table('post')->insert([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'image' => $imagePath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('home')->with('success', 'Đăng bài viết thành công!');
    }

    public function edit($id) {
        $post = DB::table('post')->where('id', $id)->first();

        if (!$post || $post->user_id != auth()->id()) {
            return redirect()->route('home')->with('error', 'Bạn không có quyền chỉnh sửa bài viết này!');
        }

        return view('post.edit', compact('post'));
    }

    public function update(Request $request, $id) {
        $post = DB::table('post')->where('id', $id)->first();

        if (!$post || $post->user_id != auth()->id()) {
            return redirect()->route('home')->with('error', 'Bạn không có quyền chỉnh sửa bài viết này!');
        }

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $post->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        DB::table('post')->where('id', $id)->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'image' => $imagePath,
            'updated_at' => now(),
        ]);

        return redirect()->route('home')->with('success', 'Cập nhật bài viết thành công!');
    }

    public function destroy($id) {
        $post = DB::table('post')->where('id', $id)->first();

        if (!$post || $post->user_id != auth()->id()) {
            return redirect()->route('home')->with('error', 'Bạn không có quyền xóa bài viết này!');
        }

        DB::table('post')->where('id', $id)->delete();

        return redirect()->route('home')->with('success', 'Xóa bài viết thành công!');
    }
}