@extends('layouts.user')
@section('css')
    <link rel="stylesheet" href="{{ asset('/client/css/uploadfile.css') }}">
@endsection
@section('js-head')
    <script src="https://cdn.tiny.cloud/1/1bgavvs0zlhvzs1vxwkx40n2dn2epr3tbrxe5etraoi8td04/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
@endsection

@section('breadcrumb')
    <div class="breadcrumb">
        <span class="nav-link home d-flex align-content-center"><a href="{{ route('userDashboard') }}"><i
                    class="bi bi-house-fill"></i> <span>Hệ thống</span></a>
        </span>
        <span class="nav-link d-flex align-content-center"><a href="{{ route('userAcount') }}"><i
                    class="bi bi-caret-right-fill center"></i> <span>Tạo hỗ trợ</span></a>
        </span>
    </div>
@endsection
@section('content')
    <div class="row gx-3 no-reverse">
        <div class="col-12 col-md-6 col-lg-9">
            <x-support-type></x-support-type>
            <div class="card mb-2 p-2">
                <div class="shadow-sm card-body bd-style-2 mb-2">
                    <h2 class="title-section mb-0 text-dark mb-0">Tạo hỗ trợ mới</h2>
                </div>
                <form action="{{ url('handle-support') }}" class="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group shadow-sm card-body bd-style-2 mb-1">
                        <label for="sp_type_id" class="form-label">Vấn đề cần hỗ trợ</label>
                        <select data-old="" required id="sp_type_id" name="sp_type_id"
                            class="form-select form-select bd-style-2 select-url" aria-label="Default select example">
                            <option value="">Chọn vấn đề cần hỗ trợ</option>
                            @foreach ($supportTypes as $item)
                                <option {{ old('sp_type_id') == $item->id ? 'selected' : '' }} value="{{ $item->id }}">
                                    {{ $item->name }} </option>
                            @endforeach
                        </select>
                        @error('sp_type_id')
                            <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                    class="bi bi-exclamation-circle-fill"></i>
                                {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group shadow-sm card-body bd-style-2 mb-1">
                        <label for="support_title" class="form-label">Tiêu đề hỗ trợ</label>
                        <input type="text" class="form-control form-control-lg input-light-1 bd-style-2 py-1"
                            name="support_title" value="{{ old('support_title') }}" id="support_title"
                            autocomplete="title-support">
                        @error('support_title')
                            <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                    class="bi bi-exclamation-circle-fill"></i>
                                {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group shadow-sm card-body bd-style-2 mb-1">
                        <label for="support_detail" class="form-label">Mô tả chi tiết</label>
                        <textarea id="support_detail" class="description" name="support_detail" rows="30">{{ old('support_detail') }}</textarea>
                        @error('support_detail')
                            <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                    class="bi bi-exclamation-circle-fill"></i>
                                {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group shadow-sm card-body bd-style-2 mb-1 upload-file">
                        <input type="file" class="files" name="img_upload[]" multiple="multiple">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="" class="form-label mb-0 fw-bold">Thêm ảnh mô tả (click vảo ảnh để
                                xoá)</label>
                            <span class="btn btn-primary upload"><i class="bi bi-cloud-arrow-up-fill"></i> Tải ảnh
                                lên</span>
                        </div>
                        <div class="image-list"></div>
                        @error('img_upload')
                            <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                    class="bi bi-exclamation-circle-fill"></i>
                                {{ $message }}</p>
                        @enderror
                        @error('img_upload.*')
                            <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                    class="bi bi-exclamation-circle-fill"></i>
                                {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group shadow-sm card-body bd-style-2">
                        <button type="submit" class="btn w-100 btn-primary border-0 py-2">
                            <span class="spinner-border spinner-border-sm d-none handle" role="status"
                                aria-hidden="true"></span>
                            <span class="text-button">Gửi Hỗ trợ</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card shadow-sm mb-2">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="title-section mb-0">Lưu ý</h2>
                    </div>
                    <ul>
                        <li class="text-dark mb-2"><i class="bi bi-caret-right-fill"></i> Hỗ trợ trong giờ hành chính từ Thứ
                            2 đến Thứ 6.</li>
                        <li class="text-dark mb-2"><i class="bi bi-caret-right-fill"></i> Giờ làm việc từ 9h30 sáng đến
                            18h30 chiều.</li>
                        <li class="text-dark mb-2"><i class="bi bi-caret-right-fill"></i> Ngoài giờ làm việc sẽ hỗ trợ chậm
                            hơn và phụ thuộc nhân viên hỗ trợ Online.</li>
                        <li class="text-dark mb-2"><i class="bi bi-caret-right-fill"></i> Nếu vấn đề không cần gấp vui
                            lòng
                            chờ đến giờ làm việc để xử lý tốt nhất, nhường cho các bạn cần hỗ trợ gấp ngoài giờ.</li>
                    </ul>
                </div>
            </div>
            <div class="card shadow-sm mb-2">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="title-section mb-0">Chính sách hoàn tiền</h2>
                    </div>
                    <ul>
                        <li class="text-dark mb-2"><i class="bi bi-caret-right-fill"></i> Hệ thống sẽ tự động khớp các
                            lệnh
                            hoàn tiền (hủy order hoặc chạy không đủ số lượng) từ 1-3 ngày sau khi hủy order hoặc hết hạn
                            job.</li>
                        <li class="text-dark mb-2"><i class="bi bi-caret-right-fill"></i> Nhập id lỗi hoặc trong thời gian
                            chạy die id thì hệ thống không hoàn lại tiền.</li>
                        <li class="text-dark mb-2"><i class="bi bi-caret-right-fill"></i> Mỗi ID chỉ được buff tối đa 10
                            lần
                            và hủy tối đa 2 lần để chống spam, nếu có lý do riêng thì có thể gửi yêu cầu hỗ trợ để mở
                            thêm.</a>
                        </li>
                        <li class="text-dark mb-2"><i class="bi bi-caret-right-fill"></i> Do phụ thuộc vào facebook,
                            instagram.. Với các lệnh buff vui lòng buff dư 30-50% để tránh tụt hoặc chọn gói bảo hành 7 ngày
                            kể từ khi Order.</li>
                        <li class="text-dark mb-2"><i class="bi bi-caret-right-fill"></i> Yêu cầu hỗ trợ nên gửi kèm hình
                            ảnh lỗi để đội ngũ support hỗ trợ nhanh và chính xác nhất.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js-before')
    <script src="{{ asset('/tiny.js') }}"></script>
@endsection
@section('js')
    <script src="{{ asset('/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-load-image/2.25.3/load-image.all.min.js"></script>
    <script src="{{ asset('/client/js/uploadfile.js') }}"></script>
    <script>
        $('.form').submit(function(e) {
            $(this).find('.handle').removeClass('d-none');
            $(this).find('.text-button').hide();
            setTimeout(() => {
                $(this).find('.handle').addClass('d-none');
                $(this).find('.text-button').show();
            }, 2000);
        });
    </script>
@endsection
