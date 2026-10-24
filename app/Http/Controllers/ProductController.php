<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 1. Hiển thị form nhập liệu (product.blade.php) khi vào trang chủ /
    public function index()
    {
        return view('product');
    }

    // 2. Xử lý gửi dữ liệu form qua POST /add-to-cart
    public function create(Request $request)
    {
        $title = $request->input('title');
        $slug = $request->input('slug');
        $description = $request->input('description');

        // Kiểm tra nếu có trường nào bị trống
        if (empty($title) || empty($slug) || empty($description)) {
            return back()
                ->withInput()
                ->with('message', 'Phải nhập đủ 3 giá trị');
        }

        // Nếu điền đầy đủ, trả về trang hiển thị kết quả (product_view.blade.php) kèm dữ liệu
        return view('product_view', [
            'title' => $title,
            'slug' => $slug,
            'description' => $description
        ]);
    }

    // 3. Hiển thị trực tiếp view kết quả (nếu gọi riêng qua route GET)
    public function show()
    {
        return view('product_view');
    }
}