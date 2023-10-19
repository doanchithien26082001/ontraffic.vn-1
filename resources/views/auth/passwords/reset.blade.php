{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
@extends('layouts.auth-user')
@section('css')
    <link rel="stylesheet" href="{{ asset('client/css/user-login.css') }}">
@endsection
@section('form')
    <form id="register-form" class="form-horizontal form-material form-auth-user" method="POST"
        action="{{ route('userHandleResetPassword') }}">
        @csrf
        <div class="form-group mt-3">
            <input placeholder="Email" id="email" type="email"
                class="form-control form-control-lg input-light border-0 border-0 bd-style-2 py-1 no-drop" name="email"
                value="{{ $email ?? old('email') }}" required autocomplete="email">
            @error('email')
                <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i class="bi bi-exclamation-circle-fill"></i>
                    {{ $message }}</p>
            @enderror
        </div>
        <div class="form-group mt-3 form-group-password">
            <input placeholder="Mật khẩu" id="password" type="password"
                class="form-control form-control-lg input-light border-0 border-0 bd-style-2 py-1" name="password" required
                autocomplete="new-password">
            @error('password')
                <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i class="bi bi-exclamation-circle-fill"></i>
                    {{ $message }}</p>
            @enderror
            <span class="toggle-show-password">
                <i class="bi bi-eye-fill"></i>
            </span>
        </div>
        <div class="form-group mt-3 form-group-password">
            <input placeholder="Xác nhận mật khẩu" id="password-confirm" type="password"
                class="form-control form-control-lg input-light border-0 border-0 bd-style-2 py-1"
                name="password_confirmation" required autocomplete="new-password">
            @error('password_confirmation')
                <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i class="bi bi-exclamation-circle-fill"></i>
                    {{ $message }}</p>
            @enderror
            <span class="toggle-show-password">
                <i class="bi bi-eye-fill"></i>
            </span>
        </div>
        <div class="form-group text-center my-3">
            <button type="submit" class="btn w-100 btn-primary border-0 bd-style-2 py-2">
                <span class="spinner-border spinner-border-sm d-none handle" role="status" aria-hidden="true"></span>
                <span class="text-button">Đặt lại mật khẩu</span>
            </button>
        </div>
        <div class="form-group my-4 text-center">
            <span>Đã có tài khoản? <a href="{{ route('userLogin') }}" class="text-green float-right font-bool"
                    id="to-login">Đăng nhập ngay</a></span>
        </div>
    </form>
@endsection



