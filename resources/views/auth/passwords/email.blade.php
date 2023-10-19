{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
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

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
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
@section('form')
    <form id="reset-form" class="form-horizontal form-material form-auth-user" method="POST"
        action="{{ route('password.email') }}">
        @csrf
        <div class="form-group mt-3">
            <input placeholder="Email" id="email" type="email"
                class="form-control form-control-lg input-light border-0 border-0 bd-style-2 py-1" name="email"
                value="{{ old('email') }}" required autocomplete="email">
            @error('email')
                <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i class="bi bi-exclamation-circle-fill"></i>
                    {{ $message }}</p>
            @enderror
            @if (session('status'))
                <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i class="bi bi-check-circle-fill"></i>
                    {{ session('status') }}</p>
            @endif
        </div>
        <div class="form-group text-center my-3">
            <button type="submit" class="btn w-100 btn-primary border-0 bd-style-2 py-2">
                <span class="spinner-border spinner-border-sm d-none handle" role="status" aria-hidden="true"></span>
                <span class="text-button">Đặt lại mật khẩu</span>
            </button>
        </div>
        <div class="form-group my-4 text-center">
            <span>Bạn chưa có tài khoản? <a href="{{ route('register') }}" class="text-green float-right font-bool"
                    id="to-register">Đăng ký ngay</a></span>
        </div>
    </form>
@endsection
