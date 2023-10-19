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
                    class="bi bi-caret-right-fill center"></i> <span>Tạo {{ $trafficType->traffic_name }}</span></a>
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
                        <h2 class="title-section mb-0 text-dark mb-0">Tạo {{ $trafficType->traffic_name }}</h2>
                        <a href="" class="btn btn-primary"><i class="bi bi-graph-up icon-item"></i> Quản lý tiến
                            trình</a>
                    </div>
                    @if ($trafficType->id == 1)
                        <form action="{{ route('handleCreateTraffic') . '?type_id=' . $trafficType->id }}"
                            class="form form-create-traffic" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group shadow-sm card-body bd-style-2 mb-1">
                                <label for="key_words" class="form-label fw-bold">Từ khoá (top 10 - 1 trang nhất)</label>
                                <textarea name="key_words" required name="key_words" placeholder="Mỗi từ khoá nằm trên dòng" class="form-control"
                                    id="key_words" cols="30" rows="4">{{ old('key_words') }}</textarea>
                                @error('key_words')
                                    <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                            class="bi bi-exclamation-circle-fill"></i>
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group shadow-sm card-body bd-style-2 mb-1">
                                <label for="url_target" class="form-label fw-bold">Url trang đích</label>
                                <input type="text" required class="form-control bd-style-2" name="url_target"
                                    value="{{ old('url_target') }}">
                                @error('url_target')
                                    <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                            class="bi bi-exclamation-circle-fill"></i>
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group shadow-sm card-body bd-style-2 mb-1 upload-file">
                                <input type="file" class="files" name="url_img">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label for="" class="form-label mb-0 fw-bold">Thêm ảnh mô tả (click vảo ảnh để
                                        xoá)</label>
                                    <span class="btn btn-primary upload"><i class="bi bi-cloud-arrow-up-fill"></i> Tải ảnh
                                        lên</span>
                                </div>
                                <div class="image-list"></div>
                                @error('url_img')
                                    <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                            class="bi bi-exclamation-circle-fill"></i>
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group shadow-sm card-body bd-style-2 mb-1">
                                <div class="row">
                                    <div class="col-12 col-lg-6 mb-2 mb-lg-0">
                                        <label for="traffic_of_date" class="form-label fw-bold">Số traffic/ngày (min 240,
                                            max
                                            30.000)</label>
                                        <input type="number" required class="form-control bd-style-2" id="traffic_of_date"
                                            name="traffic_of_date" placeholder="Nhập Url trang đích muốn chạy trafic"
                                            value="{{ old('traffic_of_date') ? old('traffic_of_date') : '240' }}"
                                            title="Số traffic/ngày từ 240 đến 30.000">
                                        @error('traffic_of_date')
                                            <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                                    class="bi bi-exclamation-circle-fill"></i>
                                                {{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-lg-6 mb-2 mb-lg-0">
                                        <label for="tota_buy_traffic" class="form-label fw-bold">Tổng số trafic mua ( min
                                            500
                                            )</label>
                                        <input type="number" required class="form-control bd-style-2 total_buy_traffic"
                                            id="total_buy_traffic" name="total_buy_traffic"
                                            value="{{ old('total_buy_traffic') ? old('total_buy_traffic') : '500' }}">
                                        @error('total_buy_traffic')
                                            <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                                    class="bi bi-exclamation-circle-fill"></i>
                                                {{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group shadow-sm card-body bd-style-2 mb-1">
                                <div class="row">
                                    <div class="col-12 col-lg-6 mb-2 mb-lg-0">
                                        <label for="time_onsite" class="form-label fw-bold">Time onsite</label>
                                        <select required class="form-select bd-style-2 select-url time_onsite"
                                            name="time_onsite">
                                            @foreach ($dataTimeOnsite as $key => $value)
                                                <option
                                                    @if (old('time_onsite')) @if (old('time_onsite') == $key + 1)
                                                        selected @endif
                                                @else @if ($key == 0) selected @endif @endif
                                                    value="{{ $value->id }}">
                                                    {{ $value->time_onsite_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('time_onsite')
                                            <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                                    class="bi bi-exclamation-circle-fill"></i>
                                                {{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-lg-6 mb-2 mb-lg-0">
                                        <label for="package_price" class="form-label fw-bold">Giá gói (Coin / 1
                                            traffic)</label>
                                        <input type="text" required class="form-control bd-style-2 package_price"
                                            id="package_price" name="package_price" value="{{ $minPrice }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group shadow-sm card-body bd-style-2 mb-1">
                                <div class="row">
                                    <div class="col-12 col-lg-6 mb-2 mb-lg-0">
                                        <label for="" class="form-label fw-bold">Chọn thiết bị</label>
                                        <div class="row">
                                            @foreach ($dataDevices as $key => $item)
                                                <div class="custom-control custom-checkbox col-auto">
                                                    <input type="checkbox" name="device[]" class="custom-control-input"
                                                        id="customCheck1" value="{{ $item->id }}"
                                                        @if (in_array($item->id, old('device', []))) checked @endif
                                                        @if (old('device') == false && $key == 0) checked @endif>
                                                    <label class="custom-control-label"
                                                        for="customCheck1">{{ $item->device_name }}</label>
                                                </div>
                                            @endforeach
                                            @error('device')
                                                <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                                        class="bi bi-exclamation-circle-fill"></i>
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 mb-2 mb-lg-0">
                                        <label for="number_phone" class="form-label fw-bold">Số điện thoại</label>
                                        <input required type="text" name="number_phone"
                                            class="form-control bd-style-2" placeholder="Liên hệ khi có sự cố"
                                            value="{{ old('number_phone') }}">
                                        @error('number_phone')
                                            <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                                    class="bi bi-exclamation-circle-fill"></i>
                                                {{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group shadow-sm card-body bd-style-2">
                                <button type="submit" class="spin-submit btn w-100 btn-primary border-0 py-2">
                                    <span class="spinner-border spinner-border-sm d-none handle" role="status"
                                        aria-hidden="true"></span>
                                    <span class="text-button">Tạo tiến trình</span>
                                </button>
                                <input type="hidden" class="data-coin" name="data-coin"
                                    value="{{ Auth::user()->coin }}">
                            </div>
                        </form>
                    @elseif($trafficType->id == 2)
                        <form action="{{ route('handleCreateTraffic') . '?type_id=' . $trafficType->id }}"
                            class="form form-create-traffic" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group shadow-sm card-body bd-style-2 mb-1">
                                <label for="key_words" class="form-label fw-bold">Từ khoá (top 10 - 1 trang nhất)</label>
                                <textarea name="key_words" required name="key_words" placeholder="Mỗi từ khoá nằm trên dòng" class="form-control"
                                    id="key_words" cols="30" rows="4">{{ old('key_words') }}</textarea>
                                @error('key_words')
                                    <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                            class="bi bi-exclamation-circle-fill"></i>
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group shadow-sm card-body bd-style-2 mb-1">
                                <label for="url_contain_backlink" class="form-label fw-bold">Url trang đích chứa
                                    backlink</label>
                                <input type="text" required id="url_contain_backlink" class="form-control bd-style-2"
                                    name="url_contain_backlink" value="{{ old('url_contain_backlink') }}"
                                    placeholder="Url trang web chứa backlink">
                                @error('url_contain_backlink')
                                    <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                            class="bi bi-exclamation-circle-fill"></i>
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group shadow-sm card-body bd-style-2 mb-1">
                                <label for="url_target" class="form-label fw-bold">Url trang đích</label>
                                <input type="text" required class="form-control bd-style-2" name="url_target"
                                    value="{{ old('url_target') }}" placeholder="Nhập chính xác url trang đích">
                                @error('url_target')
                                    <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                            class="bi bi-exclamation-circle-fill"></i>
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group shadow-sm card-body bd-style-2 mb-1 upload-file">
                                <input type="file" class="files" name="url_img">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label for="" class="form-label mb-0 fw-bold">Thêm ảnh mô tả (click vảo ảnh để
                                        xoá)</label>
                                    <span class="btn btn-primary upload"><i class="bi bi-cloud-arrow-up-fill"></i> Tải ảnh
                                        lên</span>
                                </div>
                                <div class="image-list"></div>
                                @error('url_img')
                                    <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                            class="bi bi-exclamation-circle-fill"></i>
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group shadow-sm card-body bd-style-2 mb-1">
                                <div class="row">
                                    <div class="col-12 col-lg-6 mb-2 mb-lg-0">
                                        <label for="traffic_of_date" class="form-label fw-bold">Số traffic/ngày (min 240,
                                            max
                                            30.000)</label>
                                        <input type="number" required class="form-control bd-style-2"
                                            id="traffic_of_date" name="traffic_of_date"
                                            placeholder="Nhập Url trang đích muốn chạy trafic"
                                            value="{{ old('traffic_of_date') ? old('traffic_of_date') : '240' }}"
                                            title="Số traffic/ngày từ 240 đến 30.000">
                                        @error('traffic_of_date')
                                            <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                                    class="bi bi-exclamation-circle-fill"></i>
                                                {{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-lg-6 mb-2 mb-lg-0">
                                        <label for="tota_buy_traffic" class="form-label fw-bold">Tổng số trafic mua ( min
                                            500
                                            )</label>
                                        <input type="number" required class="form-control bd-style-2 total_buy_traffic"
                                            id="total_buy_traffic" name="total_buy_traffic"
                                            value="{{ old('total_buy_traffic') ? old('total_buy_traffic') : '500' }}">
                                        @error('total_buy_traffic')
                                            <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                                    class="bi bi-exclamation-circle-fill"></i>
                                                {{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group shadow-sm card-body bd-style-2 mb-1">
                                <div class="row">
                                    <div class="col-12 col-lg-6 mb-2 mb-lg-0">
                                        <label for="time_onsite" class="form-label fw-bold">Time onsite</label>
                                        <select required class="form-select bd-style-2 select-url time_onsite"
                                            name="time_onsite">
                                            @foreach ($dataTimeOnsite as $key => $value)
                                                <option
                                                    @if (old('time_onsite')) @if (old('time_onsite') == $key + 1)
                                                    selected @endif
                                                @else @if ($key == 0) selected @endif @endif
                                                    value="{{ $value->id }}">
                                                    {{ $value->time_onsite_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('time_onsite')
                                            <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                                    class="bi bi-exclamation-circle-fill"></i>
                                                {{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-lg-6 mb-2 mb-lg-0">
                                        <label for="package_price" class="form-label fw-bold">Giá gói (Coin / 1
                                            traffic)</label>
                                        <input type="text" required class="form-control bd-style-2 package_price"
                                            id="package_price" name="package_price" value="{{ $minPrice }}"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group shadow-sm card-body bd-style-2 mb-1">
                                <div class="row">
                                    <div class="col-12 col-lg-6 mb-2 mb-lg-0">
                                        <label for="" class="form-label fw-bold">Chọn thiết bị</label>
                                        <div class="row">
                                            @foreach ($dataDevices as $key => $item)
                                                <div class="custom-control custom-checkbox col-auto">
                                                    <input type="checkbox" name="device[]" class="custom-control-input"
                                                        id="customCheck1" value="{{ $item->id }}"
                                                        @if (in_array($item->id, old('device', []))) checked @endif
                                                        @if (old('device') == false && $key == 0) checked @endif>
                                                    <label class="custom-control-label"
                                                        for="customCheck1">{{ $item->device_name }}</label>
                                                </div>
                                            @endforeach
                                            @error('device')
                                                <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                                        class="bi bi-exclamation-circle-fill"></i>
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 mb-2 mb-lg-0">
                                        <label for="number_phone" class="form-label fw-bold">Số điện thoại</label>
                                        <input required type="text" name="number_phone"
                                            class="form-control bd-style-2" placeholder="Liên hệ khi có sự cố"
                                            value="{{ old('number_phone') }}">
                                        @error('number_phone')
                                            <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                                    class="bi bi-exclamation-circle-fill"></i>
                                                {{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group shadow-sm card-body bd-style-2">
                                <button type="submit" class="spin-submit btn w-100 btn-primary border-0 py-2">
                                    <span class="spinner-border spinner-border-sm d-none handle" role="status"
                                        aria-hidden="true"></span>
                                    <span class="text-button">Tạo tiến trình</span>
                                </button>
                                <input type="hidden" class="data-coin" name="data-coin"
                                    value="{{ Auth::user()->coin }}">
                            </div>
                        </form>
                    @else
                        <form action="{{ route('handleCreateTraffic') . '?type_id=' . $trafficType->id }}"
                            class="form form-create-traffic" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group shadow-sm card-body bd-style-2 mb-1">
                                <label for="url_target" class="form-label fw-bold">Url trang đích</label>
                                <input type="text" required class="form-control bd-style-2" name="url_target"
                                    value="{{ old('url_target') }}" placeholder="Nhập url trang đích">
                                @error('url_target')
                                    <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                            class="bi bi-exclamation-circle-fill"></i>
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group shadow-sm card-body bd-style-2 mb-1 upload-file">
                                <input type="file" class="files" name="url_img">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label for="" class="form-label mb-0 fw-bold">Thêm ảnh mô tả (click vảo ảnh để
                                        xoá)</label>
                                    <span class="btn btn-primary upload"><i class="bi bi-cloud-arrow-up-fill"></i> Tải ảnh
                                        lên</span>
                                </div>
                                <div class="image-list"></div>
                                @error('url_img')
                                    <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                            class="bi bi-exclamation-circle-fill"></i>
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group shadow-sm card-body bd-style-2 mb-1">
                                <div class="row">
                                    <div class="col-12 col-lg-6 mb-2 mb-lg-0">
                                        <label for="traffic_of_date" class="form-label fw-bold">Số traffic/ngày (min 240,
                                            max
                                            30.000)</label>
                                        <input type="number" required class="form-control bd-style-2"
                                            id="traffic_of_date" name="traffic_of_date"
                                            placeholder="Nhập Url trang đích muốn chạy trafic"
                                            value="{{ old('traffic_of_date') ? old('traffic_of_date') : '240' }}"
                                            title="Số traffic/ngày từ 240 đến 30.000">
                                        @error('traffic_of_date')
                                            <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                                    class="bi bi-exclamation-circle-fill"></i>
                                                {{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-lg-6 mb-2 mb-lg-0">
                                        <label for="tota_buy_traffic" class="form-label fw-bold">Tổng số trafic mua ( min
                                            500
                                            )</label>
                                        <input type="number" required class="form-control bd-style-2 total_buy_traffic"
                                            id="total_buy_traffic" name="total_buy_traffic"
                                            value="{{ old('total_buy_traffic') ? old('total_buy_traffic') : '500' }}">
                                        @error('total_buy_traffic')
                                            <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                                    class="bi bi-exclamation-circle-fill"></i>
                                                {{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group shadow-sm card-body bd-style-2 mb-1">
                                <div class="row">
                                    <div class="col-12 col-lg-6 mb-2 mb-lg-0">
                                        <label for="time_onsite" class="form-label fw-bold">Time onsite</label>
                                        <select required class="form-select bd-style-2 select-url time_onsite"
                                            name="time_onsite">
                                            @foreach ($dataTimeOnsite as $key => $value)
                                                <option
                                                    @if (old('time_onsite')) @if (old('time_onsite') == $key + 1)
                                                    selected @endif
                                                @else @if ($key == 0) selected @endif @endif
                                                    value="{{ $value->id }}">
                                                    {{ $value->time_onsite_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('time_onsite')
                                            <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                                    class="bi bi-exclamation-circle-fill"></i>
                                                {{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-lg-6 mb-2 mb-lg-0">
                                        <label for="package_price" class="form-label fw-bold">Giá gói (Coin / 1
                                            traffic)</label>
                                        <input type="text" required class="form-control bd-style-2 package_price"
                                            id="package_price" name="package_price" value="{{ $minPrice }}"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group shadow-sm card-body bd-style-2 mb-1">
                                <div class="row">
                                    <div class="col-12 col-lg-6 mb-2 mb-lg-0">
                                        <label for="" class="form-label fw-bold">Chọn thiết bị</label>
                                        <div class="row">
                                            @foreach ($dataDevices as $key => $item)
                                                <div class="custom-control custom-checkbox col-auto">
                                                    <input type="checkbox" name="device[]" class="custom-control-input"
                                                        id="customCheck1" value="{{ $item->id }}"
                                                        @if (in_array($item->id, old('device', []))) checked @endif
                                                        @if (old('device') == false && $key == 0) checked @endif>
                                                    <label class="custom-control-label"
                                                        for="customCheck1">{{ $item->device_name }}</label>
                                                </div>
                                            @endforeach
                                            @error('device')
                                                <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                                        class="bi bi-exclamation-circle-fill"></i>
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 mb-2 mb-lg-0">
                                        <label for="number_phone" class="form-label fw-bold">Số điện thoại</label>
                                        <input required type="text" name="number_phone"
                                            class="form-control bd-style-2" placeholder="Liên hệ khi có sự cố"
                                            value="{{ old('number_phone') }}">
                                        @error('number_phone')
                                            <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                                    class="bi bi-exclamation-circle-fill"></i>
                                                {{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group shadow-sm card-body bd-style-2">
                                <button type="submit" class="spin-submit btn w-100 btn-primary border-0 py-2">
                                    <span class="spinner-border spinner-border-sm d-none handle" role="status"
                                        aria-hidden="true"></span>
                                    <span class="text-button">Tạo tiến trình</span>
                                </button>
                                <input type="hidden" class="data-coin" name="data-coin"
                                    value="{{ Auth::user()->coin }}">
                            </div>
                        </form>
                    @endif
                    <div class="form-group shadow-sm card-body bd-style-2 mb-1">
                        <span class="fw-bold text-primary text-center d-block">Tổng: <span class="text-success h5"
                                id="total-price-coin"></span></span>
                        <span class="fw-bold text-primary text-center d-block">Bạn sẽ buff <span class="text-success"
                                id="total-transaction-traffic"></span> với giá
                            <span class="text-success" id="coin-price"><span></span>
                    </div>
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
    <script>
        $(document).ready(function() {
            $.ajax({
                type: "POST",
                url: "{{ route('getOnsitePrice') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    timeOnsiteId: $('.time_onsite').val(),
                    totalBuyTraffic: $('.total_buy_traffic').val()
                },
                dataType: "json",
                success: function(dataResponse) {
                    $('.package_price').val(dataResponse.timeOnsitePrice);
                    $('#total-price-coin').text(dataResponse.totalPrice);
                    $('#coin-price').text(dataResponse.timeOnsitePrice + " Coin / Traffic");
                    $('#total-transaction-traffic').text($('.total_buy_traffic').val() + " traffic");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $.notify("Đã xảy ra lỗi khi tải dữ liệu: " + textStatus + " - " +
                        errorThrown);
                }
            });
            $('.time_onsite').change(function(e) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('getOnsitePrice') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        timeOnsiteId: $(this).val(),
                        totalBuyTraffic: $('.total_buy_traffic').val()
                    },
                    dataType: "json",
                    success: function(dataResponse) {
                        $('.package_price').val(dataResponse.timeOnsitePrice);
                        $('#total-price-coin').text(dataResponse.totalPrice);
                        $('#coin-price').text(dataResponse.timeOnsitePrice + " Coin / Traffic");
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $.notify("Đã xảy ra lỗi khi tải dữ liệu: " + textStatus + " - " +
                            errorThrown);
                    }
                });
            });
            $('.total_buy_traffic').on('input', function(e) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('getTotalBuyTraffic') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        totalBuyTraffic: $(this).val(),
                        timeOnsiteId: $('.time_onsite').val(),
                    },
                    dataType: "json",
                    success: function(dataTotalPrice) {
                        $('#total-price-coin').text(dataTotalPrice)
                        $('#total-transaction-traffic').text($('.total_buy_traffic').val() +
                            " traffic")
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $.notify("Đã xảy ra lỗi khi tải dữ liệu: " + textStatus + " - " +
                            errorThrown);
                    }
                });
            });
            $('#traffic_of_date').on('input', function() {
                var minTrafficOfDate = 240;
                var maxTrafficOfDate = 30000;
                var currentValue = parseInt($(this).val());
                if (currentValue < minTrafficOfDate) {
                    $(this).val(min);
                } else if (currentValue > maxTrafficOfDate) {
                    $(this).val(max);
                }
            });

            function formatNumberWithCommas(number) {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
            $('.form-create-traffic').submit(function(e) {
                totalCoinTransaction = $('#total_buy_traffic').val() * $('#package_price').val();
                if (totalCoinTransaction > $('.data-coin').val()) {
                    e.preventDefault();
                    swal("Tạo tiến trình không thành công", "Tài khoản của bạn không đủ Coin!", "error");
                }
            });

        });
    </script>
    @if (session('response'))
        <script>
            swal("Tạo tiến trình không thành công", "Tài khoản của bạn không đủ Coin!", "error");
        </script>
    @endif
@endsection
