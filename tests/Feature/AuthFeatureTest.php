<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AuthFeatureTest extends TestCase
{
    use RefreshDatabase;

    // 1. Test thành công: Truy cập trang đăng nhập thành công
    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    // 2. Test thành công: Người dùng đăng nhập thành công với thông tin đúng
    public function test_user_can_login_with_correct_credentials()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'password123'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('/');
    }

    // 3. Test thất bại: Đăng nhập thất bại khi sai mật khẩu
    public function test_user_cannot_login_with_incorrect_password()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('email');
    }

    // 4. Test thành công: Đăng ký tài khoản thành công và gửi mail chào mừng
    public function test_new_user_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'Nguyen Van A',
            'email' => 'a@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'a@example.com']);
        $response->assertRedirect('/');
    }

    // 5. Test thất bại: Đăng ký thất bại khi thiếu trường bắt buộc
    public function test_registration_fails_when_fields_are_missing()
    {
        $response = $this->post('/register', [
            'name' => '',
            'email' => 'invalid-email',
            'password' => '123',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }

    // 6. Test thành công: Yêu cầu cấp lại mật khẩu (Quên mật khẩu) thành công
    public function test_user_can_request_password_reset()
    {
        $user = User::factory()->create();

        $response = $this->post('/forgot-password', [
            'email' => $user->email,
        ]);

        $response->assertSessionHas('status');
    }

    // 7. Test thất bại: Quên mật khẩu thất bại khi email không tồn tại
    public function test_password_reset_fails_with_non_existent_email()
    {
        $response = $this->post('/forgot-password', [
            'email' => 'notfound@example.com',
        ]);

        $response->assertSessionHasErrors('email');
    }

    // 8. Test thành công: Người dùng đăng xuất thành công
    public function test_authenticated_user_can_logout()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }
}