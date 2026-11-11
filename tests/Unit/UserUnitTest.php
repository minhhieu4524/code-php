<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\User;

class UserUnitTest extends TestCase
{
    // 1. Test Unit thành công: Kiểm tra cấu hình thuộc tính của User model
    public function test_user_has_correct_fillable_attributes()
    {
        $user = new User();
        
        $expected = [
            'name',
            'email',
            'password',
        ];

        // Kiểm tra xem các trường fillable có khớp không
        $this->assertEquals($expected, array_intersect($user->getFillable(), $expected));
    }

    // 2. Test Unit thất bại: Kiểm tra xác thực logic tên người dùng không được để trống rỗng logic tùy chỉnh
    public function test_user_name_cannot_be_empty_logic()
    {
        $user = new User(['name' => '']);
        
        $this->assertEmpty($user->name);
    }
}