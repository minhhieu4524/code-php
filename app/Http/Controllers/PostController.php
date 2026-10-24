<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index() 
    {
        $posts = DB::table('post')->get();
        return view('post.index', compact('posts'));
    }

    public function show($id)
    {
        $post = DB::table('post')->where('id', $id)->first();
        if (!$post) { abort(404); }
        return view('post.detail', compact('post'));
    }
}