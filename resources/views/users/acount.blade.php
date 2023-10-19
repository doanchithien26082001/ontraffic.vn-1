@extends('layouts.user')
@section('css')
    <link rel="stylesheet" href="{{ asset('/client/css/dashboard.css') }}">
    <style>
        .form-group-password {
            position: relative;
        }

        .toggle-show-password {
            position: absolute;
            top: 2px;
            right: 18px;
            color: #6d757d;
            cursor: pointer;
            padding: 6px;
        }
        .text-xs-copy {
            cursor: pointer;
        }

        .tooltip-ontraffic {
            position: fixed;
            display: inline-block;
            background-color: rgba(0, 0, 0, 1);
            color: white;
            top: 50%;
            left: 50%;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            z-index: 9999;
        }

        .tooltip-ontraffic::before {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            border-left: 10px solid rgba(0, 0, 0, 0);
            border-top: 10px solid rgba(0, 0, 0, 1);
            border-right: 10px solid rgba(0, 0, 0, 0);
        }

        @media(max-width:280px) {

            .card-acount .info-username,
            .card-acount .coin {
                font-size: 14px;
            }
        }
    </style>
@endsection
@section('breadcrumb')
    <div class="breadcrumb">
        <span class="nav-link home d-flex align-content-center"><a href="{{ route('userDashboard') }}"><i
                    class="bi bi-house-fill"></i> <span>Hệ thống</span></a>
        </span>
        <span class="nav-link d-flex align-content-center"><a href="{{ route('userAcount') }}"><i
                    class="bi bi-caret-right-fill center"></i> <span>Tài khoản</span></a>
        </span>
    </div>
@endsection
@section('content')
    <div class="row gx-3">
        <div class="col-3 content-01 d-none d-lg-block">
            <div class="card shadow mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 d-flex">
                            <x-info-user01></x-info-user01>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p class="text-center mb-0 level-user btn btn-primary w-100 my-3">Cấp đại lý: Khách hàng</p>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <ul class="list-nav-user">
                                <x-menu-user></x-menu-user>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-9 content-02 ">
            <x-report></x-report>
            <div class="card shadow-sm ">
                <div class="card-body row">
                    <p>User ID: <strong  class="text-xs-copy">{{ Auth::user()->transfer_content }}</strong></p>
                    <div class="col-12 col-sm-6 mb-2 mb-md-0">
                        <form action="{{ route('userHandleUpdateInfo') }}" method="POST" class="form-auth-user">
                            @csrf
                            @if (session('update-info'))
                                <div class="form-group mt-3 register-success update-info">
                                    <p class="text-primary mb-0 fw-bold px-1 text-center"><i
                                            class="bi bi-check-circle-fill"></i>
                                        {{ session('update-info') }}</p>
                                </div>
                            @endif
                            <div class="row mb-2 ">
                                <label for="inputEmail3" class="col-12 px-3 col-form-label fw-bold">Tên</label>
                                <div class="col-12 ">
                                    <input type="text" class="form-control bd-style-2" id="inputEmail3" name="name"
                                        value="{{ $errors->has('name') ? old('name') : Auth::user()->name }}">
                                    @error('name')
                                        <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                                class="bi bi-exclamation-circle-fill"></i>
                                            {{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2 ">
                                <label for="inputEmail3 " class="col-12 px-3 col-form-label fw-bold">Email</label>
                                <div class="col-12 ">
                                    <input type="email"class="form-control bd-style-2 " id="inputEmail3 "
                                        value="{{ $errors->has('email') ? old('email') : Auth::user()->email }}"
                                        name="email">
                                    @error('email')
                                        <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                                class="bi bi-exclamation-circle-fill"></i>
                                            {{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3 ">
                                <label for="inputEmail3 " class="col-12 px-3 col-form-label fw-bold">SĐT</label>
                                <div class="col-12 ">
                                    <input type="text" class="form-control bd-style-2 " id="inputEmail3"
                                        value="{{ $errors->has('number_phone') ? old('number_phone') : Auth::user()->number_phone }}"
                                        name="number_phone"
                                        @if (Auth::user()->number_phone == null) placeholder="Chưa cập nhật" @endif
                                        name="number_phone">
                                    @error('number_phone')
                                        <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                                class="bi bi-exclamation-circle-fill"></i>
                                            {{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2 ">
                                <div class="col-12 ">
                                    <button type="submit" class="btn w-100 btn-primary border-0 bd-style-2 py-2">
                                        <span class="spinner-border spinner-border-sm d-none handle" role="status"
                                            aria-hidden="true"></span>
                                        <span class="text-button">Cập nhật thông tin</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-sm-6">
                        <form action="{{ route('userHandleUpdatePassword') }}" method="POST" class="form-auth-user">
                            @csrf
                            @if (session('update-password'))
                                <div class="form-group mt-3 register-success update-info">
                                    <p class="text-primary mb-0 fw-bold px-1 text-center"><i
                                            class="bi bi-check-circle-fill"></i>
                                        {{ session('update-password') }}</p>
                                </div>
                            @endif
                            <div class="row mb-2 ">
                                <label for="inputEmail3 " class="col-12 px-3 col-form-label fw-bold">Mật khẩu cũ</label>
                                <div class="col-12 form-group-password">
                                    <input type="password" class="form-control bd-style-2" id="inputEmail3"
                                        value="{{ session('old_password') ? '' : old('old_password') }}"
                                        name="old_password">
                                    @if (session('old_password'))
                                        <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                                class="bi bi-exclamation-circle-fill"></i>
                                            {{ session('old_password') }}</p>
                                    @endif
                                    <span class="toggle-show-password">
                                        <i class="bi bi-eye-fill"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-2 ">
                                <label for="inputEmail3" class="col-12 px-3 col-form-label fw-bold">Mật khẩu mới</label>
                                <div class="col-12 form-group-password">
                                    <input type="password" class="form-control bd-style-2 " id="inputEmail3 "
                                        name="password">
                                    @error('password')
                                        <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                                class="bi bi-exclamation-circle-fill"></i>
                                            {{ $message }}</p>
                                    @enderror
                                    <span class="toggle-show-password">
                                        <i class="bi bi-eye-fill"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-3 ">
                                <label for="inputEmail3 " class="col-12 px-3 col-form-label fw-bold">Nhập lại mật
                                    khẩu</label>
                                <div class="col-12 form-group-password">
                                    <input type="password " class="form-control bd-style-2 " id="inputEmail3"
                                        name="password_confirmation">
                                    @error('password_confirmation')
                                        <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                                class="bi bi-exclamation-circle-fill"></i>
                                            {{ $message }}</p>
                                    @enderror
                                    <span class="toggle-show-password">
                                        <i class="bi bi-eye-fill"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-2 ">
                                <div class="col-12 ">
                                    <button type="submit" class="btn w-100 btn-primary border-0 bd-style-2 py-2">
                                        <span class="spinner-border spinner-border-sm d-none handle" role="status"
                                            aria-hidden="true"></span>
                                        <span class="text-button">Đặt lại mật khẩu</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('client/js/auth-user.js') }}"></script>
    <script src="{{asset('copy.js') }}"></script>
    <script>
        CopyTextOntraffic('.text-xs-copy', 'Đã sao chép!', 1000);
    </script>
@endsection
