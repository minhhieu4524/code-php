@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white text-center font-weight-bold">Quên mật khẩu</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group">
                            <label>Nhập email tài khoản của bạn:</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
                            @error('email')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Gửi mật khẩu mới qua Email</button>
                    </form>

                    <div class="text-center mt-3">
                        <a href="{{ route('login') }}">← Quay lại trang đăng nhập</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection