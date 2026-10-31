<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Hiển thị danh sách người dùng (nếu có).
     */
    public function index()
    {
        $users = User::with('posts')->get();
        return view('user', ['users' => $users]);
    }

    /**
     * Hiển thị form đăng nhập.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Xử lý đăng nhập + Ghi log thời gian đăng nhập.
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Ghi log thời gian đăng nhập với chuỗi 'daily check info'
            Log::info('daily check info - Login Time', [
                'user' => Auth::user(),
                'login_at' => now()
            ]);

            return redirect()->intended(route('home'));
        }

        return back()
            ->withErrors([
                'email' => 'Tài khoản hoặc mật khẩu không chính xác.',
            ])
            ->onlyInput('email');
    }

    /**
     * Hiển thị form đăng ký.
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Xử lý đăng ký + Ghi log thời gian đăng ký + Gửi mail chào mừng.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Ghi log thời gian đăng ký kèm nhãn 'daily check info'
        Log::info('daily check info - User Registered', [
            'user_id' => $user->id,
            'email' => $user->email,
            'registered_at' => now()
        ]);

        // Gửi email chào mừng
        Mail::to($user->email)->send(new WelcomeMail($user));

        // Tự động đăng nhập sau khi đăng ký thành công
        Auth::login($user);

        return redirect()->route('home')->with('success', 'Đăng ký tài khoản thành công!');
    }

    /**
     * Xử lý quên mật khẩu + Cấp mật khẩu mới + Ghi log + Gửi mail.
     */
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.exists' => 'Email này không tồn tại trong hệ thống.'
        ]);

        $user = User::where('email', $request->email)->first();
        
        // Tạo mật khẩu ngẫu nhiên mới gồm 8 ký tự
        $newPassword = Str::random(8);
        $user->password = Hash::make($newPassword);
        $user->save();

        // Ghi log thời gian cấp lại mật khẩu kèm nhãn 'daily check info'
        Log::info('daily check info - Password Reset', [
            'user_id' => $user->id,
            'email' => $user->email,
            'reset_at' => now()
        ]);

        // Gửi email chứa mật khẩu mới
        Mail::to($user->email)->send(new ResetPasswordMail($newPassword));

        return back()->with('status', 'Mật khẩu mới đã được tạo và gửi vào email của bạn!');
    }

    /**
     * Đăng xuất khỏi hệ thống.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}