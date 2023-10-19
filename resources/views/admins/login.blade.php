@extends('layouts.auth-user')
@section('css')
    <link rel="stylesheet" href="{{ asset('client/css/user-login.css') }}">
@endsection
@section('form')
    <form id="login-form" class="form-horizontal form-material form-auth-user" method="POST"
        action="{{ route('adminHandleLogin') }}">
        @csrf
        @if (session('status'))
            <div class="form-group mt-3 register-success">
                <p class="text-primary mb-0 fw-bold px-1 text-center"><i class="bi bi-check-circle-fill"></i>
                    {{ session('status') }}</p>
            </div>
        @endif
        <div class="form-group mt-3">
            <input placeholder="Email" id="email" type="email"
                class="form-control form-control-lg input-light border-0 border-0 bd-style-2 py-1" name="email"
                value="{{ old('email') }}@if(session('status')){{session('email')}}@endif" required
                autocomplete="email">
        </div>
        <div class="form-group mt-3 form-group-password">
            <input placeholder="Mật khẩu" id="password" type="password"
                class="form-control form-control-lg input-light border-0 border-0 bd-style-2 py-1" name="password" required
                autocomplete="current-password" value="@if(session('status')){{session('password')}}@endif">
            <span class="toggle-show-password">
                <i class="bi bi-eye-fill"></i>
            </span>
        </div>
        @if (session('errorLogin'))
            <div class="form-group mt-3 error-login">
                <p class="text-primary mb-0 fw-bold px-1"><i class="bi bi-exclamation-circle-fill"></i>
                    {{ session('errorLogin') }}</p>
            </div>
        @endif
        <div class="form-group d-flex justify-content-between mt-3 px-1">
            <label><input type="checkbox" checked="checked" name="remember"> Nhớ tài khoản</label>
            <a href="{{ route('password.request') }}" class="text-dark float-right" id="to-recover"><i
                    class="fa fa-lock m-r-5"></i> Quên mật khẩu</a>
        </div>
        <div class="form-group text-center my-3">
            <button type="submit" class="btn w-100 btn-primary border-0 bd-style-2 py-2">
                <span class="spinner-border spinner-border-sm d-none handle" role="status" aria-hidden="true"></span>
                <span class="text-button">Đăng nhập</span>
            </button>
        </div>
    </form>
@endsection
@section('js')
    <script src="{{ asset('client/js/user-login.js') }}"></script>
@endsection
