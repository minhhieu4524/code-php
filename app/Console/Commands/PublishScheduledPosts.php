<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use Illuminate\Support\Facades\Log;

class PublishScheduledPosts extends Command
{
    protected $signature = 'posts:publish-scheduled';
    protected $description = 'Tự động xuất bản các bài viết hẹn giờ đã đến hạn';

    public function handle()
    {
        // Lấy các bài viết ở trạng thái 'scheduled' có thời gian hẹn <= thời gian hiện tại
        $posts = Post::where('status', 'scheduled')
                     ->where('published_at', '<=', now())
                     ->get();

        foreach ($posts as $post) {
            $post->status = 'published';
            $post->save();

            // Ghi log thời gian xuất bản tự động theo định dạng yêu cầu
            Log::info('daily check info - Scheduled Post Published', [
                'post_id' => $post->id,
                'title' => $post->title,
                'published_at' => now()
            ]);
        }

        $this->info('Đã xuất bản thành công ' . $posts->count() . ' bài viết hẹn giờ.');
    }
}