<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Xóa dữ liệu cũ theo thứ tự bảng con trước, bảng cha sau để tránh lỗi khóa ngoại
        DB::table('post')->delete();
        DB::table('users')->delete();

        // 1. Tạo trước một tài khoản user có id = 1 để làm tác giả cho các bài viết
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Admin V-News',
            'email' => 'admin@vnews.com',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Thêm dữ liệu các bài báo vào bảng post
        DB::table('post')->insert([
            [
                'user_id' => 1,
                'title' => 'Đột phá trong phát triển ứng dụng Web: Xu hướng ứng dụng Laravel Framework tại Việt Nam',
                'slug' => 'dot-pha-phat-trien-ung-dung-web-laravel',
                'description' => 'Khám phá cách Laravel giúp các doanh nghiệp tối ưu hóa quy trình xây dựng hệ thống web hiện đại nhờ cấu trúc MVC và Query Builder mạnh mẽ.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Tối ưu hóa hiệu suất cơ sở dữ liệu với Laravel Query Builder cho hệ thống lớn',
                'slug' => 'toi-uu-hieu-suat-csdl-query-builder',
                'description' => 'Chia sẻ các kỹ thuật truy vấn dữ liệu nhanh chóng, giảm thiểu tối đa tài nguyên máy chủ và đảm bảo an toàn thông tin.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Bí quyết thiết kế giao diện báo điện tử chuẩn Responsive với Bootstrap 4',
                'slug' => 'bi-quyet-xay-dung-giao-dien-bao-dien-tu',
                'description' => 'Hướng dẫn chia cột layout, tối ưu tỷ lệ hình ảnh và trải nghiệm đọc tin tức trên thiết bị di động.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Thị trường công nghệ toàn cầu ghi nhận sự tăng trưởng mạnh mẽ trong quý IV',
                'slug' => 'thi-truong-cong-nghe-toan-cau-tang-truong',
                'description' => 'Các tập đoàn công nghệ lớn liên tục công bố doanh thu kỷ录 nhờ sự bùng nổ của trí tuệ nhân tạo và điện toán đám mây.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Ngành thương mại điện tử Việt Nam chuyển mình mạnh mẽ trong kỷ nguyên số',
                'slug' => 'nganh-thuong-mai-dien-tu-viet-nam-chuyen-minh',
                'description' => 'Xu hướng mua sắm trực tuyến kết hợp giải trí trực tiếp (Shoppertainment) đang trở thành động lực chính thúc đẩy doanh số bán hàng.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}