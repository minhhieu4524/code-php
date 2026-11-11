<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('post', function (Blueprint $table) {
            if (!Schema::hasColumn('post', 'status')) {
                $table->string('status')->default('published')->after('description'); // Trạng thái bài viết: draft, published, scheduled
            }
            if (!Schema::hasColumn('post', 'published_at')) {
                $table->timestamp('published_at')->nullable()->after('status'); // Thời gian hẹn giờ đăng
            }
            if (!Schema::hasColumn('post', 'deleted_at')) {
                $table->softDeletes(); // Cột hỗ trợ thùng rác (SoftDeletes)
            }
        });
    }

    public function down(): void
    {
        Schema::table('post', function (Blueprint $table) {
            $table->dropColumn(['status', 'published_at']);
            $table->dropSoftDeletes();
        });
    }
};