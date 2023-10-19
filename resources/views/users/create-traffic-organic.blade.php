@extends('layouts.user')
@section('css')
    <link rel="stylesheet" href="{{ asset('client/css/uploadfile.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/traffic.css') }}">
@endsection
@section('breadcrumb')
    <div class="breadcrumb">
        <span class="nav-link home d-flex align-content-center"><a href="{{ route('userDashboard') }}"><i
                    class="bi bi-house-fill"></i> <span>Hệ thống</span></a>
        </span>
        <span class="nav-link d-flex align-content-center"><a href="{{ route('userPayment') }}"><i
                    class="bi bi-caret-right-fill center"></i> <span>Tạo Traffic Organic</span></a>
        </span>
    </div>
@endsection
@section('content')
    <div class="row gx-3 no-reverse">
        <div class="col-12 col-md-6 col-lg-7">
            <div class="card shadow mb-3">
                <div class="card-body">
                    <div
                        class="title-traffic shadow-sm card-body bd-style-2 mb-2 d-flex justify-content-between align-items-center">
                        <h2 class="title-section mb-0 text-dark mb-0">Tạo Traffic Organic</h2>
                        <a href="" class="btn btn-primary"><i class="bi bi-graph-up icon-item"></i> Quản lý tiến
                            trình</a>
                    </div>
                    <form action="{{ route('handleCreateTrafficOrganic') }}" class="form" method="POST">
                        @csrf
                        <div class="form-group shadow-sm card-body bd-style-2 mb-1">
                            <label for="" class="form-label fw-bold">Từ khoá (top 10 - 1 trang nhất)</label>
                            <textarea name="key_words" placeholder="Mỗi từ khoá nằm trên dòng" class="form-control" id="" cols="30"
                                rows="10"></textarea>
                        </div>
                        <div class="form-group shadow-sm card-body bd-style-2 mb-1">
                            <label for="" class="form-label fw-bold">Url trang đích</label>
                            <input type="text" class="form-control bd-style-2"
                                placeholder="Nhập Url trang đích muốn chạy trafic">
                        </div>
                        <div class="form-group shadow-sm card-body bd-style-2 mb-1 upload-file">
                            {{-- <input type="file" class="files" multiple max="4"> --}}
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="" class="form-label mb-0 fw-bold">Thêm ảnh mô tả (click vảo ảnh để
                                    xoá)</label>
                                <span class="btn btn-primary upload"><i class="bi bi-cloud-arrow-up-fill"></i> Tải ảnh
                                    lên</span>
                            </div>
                            <div class="image-list"></div>
                        </div>
                        <div class="form-group shadow-sm card-body bd-style-2 mb-1">
                            <div class="row">
                                <div class="col-12 col-lg-6 mb-2 mb-lg-0">
                                    <label for="" class="form-label fw-bold">Số traffic/ngày (min 240, max
                                        30.000)</label>
                                    <input type="text" class="form-control bd-style-2"
                                        placeholder="Nhập Url trang đích muốn chạy trafic" value="240">
                                </div>
                                <div class="col-12 col-lg-6 mb-2 mb-lg-0">
                                    <label for="" class="form-label fw-bold">Tổng số trafic mua ( min 500 )</label>
                                    <input type="text" class="form-control bd-style-2"
                                        placeholder="Nhập Url trang đích muốn chạy trafic" value="500">
                                </div>
                            </div>
                        </div>
                        <div class="form-group shadow-sm card-body bd-style-2 mb-1">
                            <div class="row">
                                <div class="col-12 col-lg-6 mb-2 mb-lg-0">
                                    <label for="" class="form-label fw-bold">Time onsite</label>
                                    <select class="form-select bd-style-2 select-url" aria-label="Default select example ">
                                        <option selected value="1"> > 30s</option>
                                        <option value="1 "> > 60s</option>
                                        <option value="2 "> > 90s</option>
                                        <option value="3 "> > 120s</option>
                                    </select>
                                </div>
                                <div class="col-12 col-lg-6 mb-2 mb-lg-0">
                                    <label for="" class="form-label fw-bold">Giá gói</label>
                                    <input type="text" class="form-control bd-style-2"
                                        placeholder="Nhập Url trang đích muốn chạy trafic" value="990 Coin">
                                </div>
                            </div>
                        </div>
                        <div class="form-group shadow-sm card-body bd-style-2 mb-1">
                            <div class="row">
                                <div class="col-12 col-lg-6 mb-2 mb-lg-0">
                                    <label for="" class="form-label fw-bold">Chọn thiết bị</label>
                                    <div class="row">
                                        <div class="custom-control custom-checkbox col-auto">
                                            <input type="checkbox" class="custom-control-input" checked id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">Mobile</label>
                                        </div>
                                        <div class="custom-control custom-checkbox col-auto">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">PC</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-2 mb-lg-0">
                                    <label for="" class="form-label fw-bold">Số điện thoại</label>
                                    <input type="text" class="form-control bd-style-2"
                                        placeholder="Liên hệ khi có sự cố">
                                </div>
                            </div>
                        </div>
                        <div class="form-group shadow-sm card-body bd-style-2 mb-1">
                            <span class="fw-bold text-primary text-center d-block">Tổng: <span
                                    class="text-success h5">900,000 Coin</span></span>
                            <span class="fw-bold text-primary text-center d-block">Bạn sẽ buff <span
                                    class="text-success">1,000 traffic</span> với giá <span class="text-success"> 900 Coin
                                    / traffic<span></span>
                        </div>
                        <div class="form-group shadow-sm card-body bd-style-2">
                            <button class="btn btn-primary w-100">Tạo tiến trình</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-5">
            <x-report></x-report>
            <x-note></x-note>
            <x-contact></x-contact>
            <x-tutorial-payment></x-totorial-payment>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('bootstrap.min.js') }}"></script>
    <script src="{{ asset('/client/js/uploadfile.js') }}"></script>
@endsection
