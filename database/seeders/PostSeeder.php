<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('post')->insert([
            [
                'title' => 'Đột phá trong phát triển ứng dụng Web: Xu hướng ứng dụng Laravel Framework tại Việt Nam',
                'slug' => 'dot-pha-phat-trien-ung-dung-web-laravel',
                'description' => 'Khám phá cách Laravel giúp các doanh nghiệp tối ưu hóa quy trình xây dựng hệ thống web hiện đại nhờ cấu trúc MVC và Query Builder mạnh mẽ.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Tối ưu hóa hiệu suất cơ sở dữ liệu với Laravel Query Builder cho hệ thống lớn',
                'slug' => 'toi-uu-hieu-suat-csdl-query-builder',
                'description' => 'Chia sẻ các kỹ thuật truy vấn dữ liệu nhanh chóng, giảm thiểu tối đa tài nguyên máy chủ và đảm bảo an toàn thông tin.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Bí quyết thiết kế giao diện báo điện tử chuẩn Responsive với Bootstrap 4',
                'slug' => 'bi-quyet-xay-dung-giao-dien-bao-dien-tu',
                'description' => 'Hướng dẫn chia cột layout, tối ưu tỷ lệ hình ảnh và trải nghiệm đọc tin tức trên thiết bị di động.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Thị trường công nghệ toàn cầu ghi nhận sự tăng trưởng mạnh mẽ trong quý IV',
                'slug' => 'thi-truong-cong-nghe-toan-cau-tang-truong',
                'description' => 'Các tập đoàn công nghệ lớn liên tục công bố doanh thu kỷ lục nhờ sự bùng nổ của trí tuệ nhân tạo và điện toán đám mây.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Ngành thương mại điện tử Việt Nam chuyển mình mạnh mẽ trong kỷ nguyên số',
                'slug' => 'nganh-thuong-mai-dien-tu-viet-nam-chuyen-minh',
                'description' => 'Xu hướng mua sắm trực tuyến kết hợp giải trí trực tiếp (Shoppertainment) đang trở thành động lực chính thúc đẩy doanh số bán hàng.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Giải pháp xanh và lộ trình chuyển đổi năng lượng bền vững cho các đô thị lớn',
                'slug' => 'giai-phap-xanh-chuyen-doi-nang-luong-ben-vung',
                'description' => 'Các dự án điện mặt trời, điện gió và giao thông công cộng chạy bằng điện đang được đẩy mạnh triển khai tại nhiều thành phố.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Tuyển gia tăng cường độ tập luyện chuẩn bị cho vòng loại giải vô địch quốc gia',
                'slug' => 'tuyen-gia-tang-cuong-do-tap-luyen',
                'description' => 'Ban huấn luyện chú trọng nâng cao thể lực và chiến thuật phản công nhanh nhằm đạt mục tiêu giành vé vào trận chung kết.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Xu hướng du lịch trải nghiệm văn hóa bản địa thu hút giới trẻ',
                'slug' => 'xu-huong-du-lich-trai-nghiem-van-hoa-ban-dia',
                'description' => 'Du khách hiện đại ưa chuộng các chuyến đi khám phá thiên nhiên nguyên sơ, thưởng thức ẩm thực vùng miền và giao lưu cùng cư dân địa phương.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Kỷ nguyên điện ảnh số: Kỹ xảo CGI và trí tuệ nhân tạo tái định hình ngành phim',
                'slug' => 'ky-nguyen-dien-anh-so-cgi-ai',
                'description' => 'Những công nghệ hiện đại giúp rút ngắn thời gian sản xuất hậu kỳ, đồng thời mang lại hình ảnh sống động chưa từng có trên màn ảnh rộng.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Mẹo chăm sóc sức khỏe và duy trì năng lượng tích cực cho người làm việc văn phòng',
                'slug' => 'meo-cham-soc-suc-khoe-cho-dan-van-phong',
                'description' => 'Các thói quen đơn giản như vận động nhẹ sau mỗi 60 phút, bổ sung đủ nước và tối ưu hóa không gian làm việc giúp tăng hiệu suất rõ rệt.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}