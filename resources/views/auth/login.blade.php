{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!DOCTYPE html>
<html lang="en"> --}}

{{-- <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ontraffic.vn - Dịch vụ tăng traffic nhanh chóng, hiệu quả</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('client/images/fav-icon.png') }}">
    <meta property="og:title" content="Dịch vụ tăng traffic nhanh chóng, hiệu quả - ontraffic.vn">
    <meta property="og:description" content="Tăng traffic cho website nhanh chóng và hiệu quả với chi phí tối ưu, đa dạng các loại hình dịch vụ và chất lượng dịch vụ tốt nhất đến từ ontraffic.vn">
    <meta property="og:image" content="{{asset('client/images/thumnail-website.png')}}">
    <meta property="og:image:alt" content="ontraffic.vn">
    <meta property="og:site_name" content="ontraffic.vn">
    <meta property="og:url" content="https://ontraffic.vn">
     <meta property="og:type" content="website">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        integrity="sha512-ZnR2wlLbSbr8/c9AgLg3jQPAattCUImNsae6NHYnS9KrIwRdcY9DxFotXhNAKIKbAXlRnujIqUWoXXwqyFOeIQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/general.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/user-login.css') }}">
    <style>
        #app {
            height: 100vh;
            display: flex;
            align-items: center;
            background: url({{ asset('client/images/white-background.png') }});
            background-size: 100% 100%;
        }
    </style>
</head>

<body>
    <div id="app">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-7 mb-2 mb-md-0">
                    <img class="img-fluid" src="{{ asset('client/images/thumnail-website.png') }}" alt="">
                </div>
                <div class="col-12 col-md-5">
                    <div class="card mt-2 shadow card-gray border-0 bd-style-1">
                        <div class="card-body text-left">
                            <div class="text-center">
                                <img src="{{ asset('client/images/logo-ontraffic.png') }}" alt=""
                                    class="w-50">
                            </div>
                            <form id="login-form" class="form-horizontal form-material" method="POST"
                                action="{{ route('userHandlelogin') }}">
                                @csrf
                                <div class="form-group mt-3">
                                    <input placeholder="Email" id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror form-control-lg input-light border-0 border-0 bd-style-2 py-1"
                                        name="email" value="{{ old('email') }}" required autocomplete="email"
                                        autofocus>
                                </div>
                                <div class="form-group mt-3">
                                    <input placeholder="Mật khẩu" id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror form-control-lg input-light border-0 border-0 bd-style-2 py-1"
                                        name="password" required autocomplete="current-password">
                                </div>
                                @if (session('errorLogin'))
                                    <div class="form-group mt-3 error-login">
                                        <p class="text-danger mb-0 fw-bold px-1"><i
                                                class="bi bi-exclamation-circle-fill"></i>
                                            {{ session('errorLogin') }}</p>
                                    </div>
                                @endif
                                <div class="form-group d-flex justify-content-between mt-3 px-1">
                                    <label class="d-flex align-items-center">
                                        <input class="form-check-input mt-0" type="checkbox" name="remember"
                                            id="remember" {{ old('remember') ? 'checked' : '' }}> <span
                                            class="px-1">Nhớ tài khoản<span></label>
                                    <a href="{{ route('password.request') }}" class="text-dark float-right"
                                        id="to-recover"><i class="fa fa-lock m-r-5"></i> Quên mật khẩu?</a>
                                </div>
                                <div class="form-group text-center my-3">
                                    <button type="submit" class="btn w-100 btn-primary border-0 bd-style-2 py-2">
                                        <span class="spinner-border spinner-border-sm d-none hanle-login" role="status"
                                            aria-hidden="true"></span>
                                        <span class="text-button">Đăng nhập</span>
                                    </button>
                                </div>
                                <div class="form-group my-4 text-center">
                                    <span>Bạn chưa có tài khoản? <a href="{{ route('register') }}"
                                            class="text-green float-right font-bool" id="to-register">Đăng ký
                                            ngay</a></span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="online-status"></div>
    <script src="{{ asset('jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('status-online.js') }}"></script>
    <script src="{{ asset('client/js/user-login.js') }}"></script>
</body>

</html> --}}
@extends('layouts.auth-user')
@section('css')
    <link rel="stylesheet" href="{{ asset('client/css/user-login.css') }}">
@endsection
@section('form')
    <form id="login-form" class="form-horizontal form-material form-auth-user" method="POST"
        action="{{ route('userHandlelogin') }}">
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
        <div class="form-group my-4 text-center">
            <span>Bạn chưa có tài khoản? <a href="{{ route('register') }}" class="text-green float-right font-bool"
                    id="to-register">Đăng ký
                    ngay</a></span>
        </div>
    </form>
@endsection
@section('js')
    <script src="{{ asset('client/js/user-login.js') }}"></script>
@endsection
