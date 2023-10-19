@extends('layouts.user')
@section('css')
    <link rel="stylesheet" href="{{ asset('/client/css/uploadfile.css') }}">
    <link rel="stylesheet" href="{{ asset('zoom-image.css') }}" />
    <style>
        .support-detail p {
            margin-bottom: 5px;
        }

        .support-detail img {
            width: 100%;
            margin: 5px 0;
            height: auto;
        }

        .bg-custom-01 {
            background: #ebebeba6;
        }

        .bg-custom-02 {
            background: #ebebeb7d;
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
    </style>
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
                    class="bi bi-caret-right-fill center"></i> <span>Chi tiết hỗ trợ</span></a>
        </span>
    </div>
@endsection
@section('content')
    <div class="row gx-3 no-reverse">
        <div class="col-12 col-md-6 col-lg-9">
            <x-support-type></x-support-type>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="section-support mb-2 shadow-sm card-body bd-style-2">
                        <h2 class="title-section mb-0 text-dark mb-3">Chi tiết hỗ trợ <span
                                class="badge rounded-pill bg-primary"><i class="bi bi-chat-text"></i> <span
                                    class="num-response"></span></span></h2>
                        <div class="d-flex justify-content-between align-items-center flex-wrap flex-md-nowrap">
                            <p class="fw-bold">ID hỗ trợ: <span
                                    class="text-xs-copy text-danger">{{ $support->id_support }}</span></p>
                            <p class="fw-normal fs-6 text-success"><i class="bi bi-clock-history"></i>
                                {{ date('H:i d/m/Y', strtotime($support->created_at)) }}</p>
                        </div>
                        <p class="fw-bold">Loại hỗ trợ: <span class="badge rounded-pill bg-primary">Hỗ trợ
                                {{ $support->supportType->name }}</span></p>
                        <p class="fw-bold">Trạng thái: <span class="badge rounded-pill bg-success">
                                {{ $support->status }}</span></p>
                        <p class="fw-bold">Tiêu đề hỗ trợ: <span class="fw-lighter">{{ $support->support_title }}</span></p>
                        <div class="image-list">
                            @foreach ($support->getSupportImgs as $key => $item)
                                <a href="{{ asset($item->url_img) }}" data-fancybox="support-img" class="img-item d-block"
                                    data-caption="Ảnh yêu cầu hỗ trợ {{ $key + 1 }}">
                                    <img src="{{ asset($item->url_img) }}" alt="Ảnh yêu cầu hỗ trợ {{ $key + 1 }}"
                                        class="img-fluid">
                                </a>
                            @endforeach
                        </div>
                        <p class="fw-bold mt-3 mb-2">Nội dung:</p>
                        <div class="support-detail">{!! $support->support_detail !!}</div>
                    </div>
                    <div class="section-support mb-2 shadow-sm card-body bd-style-2">
                        <h2 class="title-section mb-0 text-dark mb-3">Phản hồi</h2>
                        @php
                            $lastAdminResponse = 0;
                        @endphp
                        @if ($support->getAdminSupportResponses->count() > 0)
                            @foreach ($support->getAdminSupportResponses as $item)
                                <div class="row p-2 mb-1 bg-custom-01 bd-style-1 gx-3 response">
                                    <div class="col-auto">
                                        <img src="http://localhost:8080/Backend/public/client/images/admin.png"
                                            alt="" style="width:50px;height:auto">
                                    </div>
                                    <div class="col mb-sm-1 mt-1">
                                        <p class="fw-bold mb-0 "><span class="badge rounded-pill bg-primary">Admin</span>
                                        </p>
                                        <p class="mb-0"><span class="badge rounded-pill bg-light text-dark"><i
                                                    class="bi bi-clock"></i>
                                                {{ date('H:i d/m/Y', strtotime($item->created_at)) }}</span></p>
                                    </div>
                                    <div class="col-12 mt-2 support-detail">
                                        {!! $item->response_detail !!}
                                    </div>
                                </div>
                                @foreach ($userResponses as $responses)
                                    @if ($responses->admin_rp_id == $item->id)
                                        <div class="row p-2 mb-1 bg-custom-02 bd-style-1 gx-3 response">
                                            <div class="col-auto">
                                                <img src="{{ asset('client/images/user.png') }}" alt=""
                                                    style="width:50px;height:auto">
                                            </div>
                                            <div class="col mb-sm-1 mt-1">
                                                <p class="fw-bold mb-0 "><span
                                                        class="badge rounded-pill bg-primary">User</span>
                                                </p>
                                                <p class="mb-0"><span class="badge rounded-pill bg-light text-dark"><i
                                                            class="bi bi-clock"></i>
                                                        {{ date('H:i d/m/Y', strtotime($responses->created_at)) }}</span>
                                                </p>
                                            </div>
                                            <div class="col-12 mt-2 support-detail">
                                                {!! $responses->responses_detail !!}
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                @php
                                    $lastAdminResponse = $item->id;
                                @endphp
                            @endforeach
                        @else
                            <div class="row p-2 mb-1 bg-custom-01 bd-style-1 gx-3 response">
                                <div class="col-auto">
                                    <img src="{{ asset('client/images/admin.png') }}" alt=""
                                        style="width:50px;height:auto">
                                </div>
                                <div class="col mb-sm-1 mt-1">
                                    <p class="fw-bold mb-0 "><span class="badge rounded-pill bg-primary">Admin</span></p>
                                    <p class="mb-0"><span class="badge rounded-pill bg-light text-dark">Phản hồi tự
                                            động</span></p>
                                </div>
                                <div class="col-12 mt-2 support-detail">
                                    <p>Chúng tôi đã ghi nhận yêu cầu hỗ trợ của bạn. Đội ngũ hỗ trợ đang xử lý và phản hồi
                                        yêu cầu của bạn trong thời gian sớm nhất!</p>
                                    <p>Xin cám ơn!</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    @if ($support->getAdminSupportResponses->count() > 0 && $support->status == 'Đang hỗ trợ')
                        <div class="card mb-2">
                            <div class="form-group shadow-sm card-body bd-style-2 ">
                                <form action="{{ route('userResponse', $lastAdminResponse) }}" method="post"
                                    class="form">
                                    @csrf
                                    <textarea class="description" name="response_detail" rows="20"></textarea>
                                    @error('response_detail')
                                        <p class="text-primary mb-0 fw-bold px-1 mt-2 form-error"><i
                                                class="bi bi-exclamation-circle-fill"></i>
                                            {{ $message }}</p>
                                    @enderror
                                    <button type="submit" class="btn w-100 btn-primary border-0 py-2 accordionmt-3 mt-3">
                                        <span class="spinner-border spinner-border-sm d-none handle" role="status"
                                            aria-hidden="true"></span>
                                        <span class="text-button">Gửi</span>
                                    </button>
                                    <a href="{{ route('completedSupport', $support->id_support) }}"
                                        class="btn w-100 btn-success border-0 py-2 accordionmt-3 mt-2 close-support"><span
                                            class="spinner-border spinner-border-sm d-none handle" role="status"
                                            aria-hidden="true"></span>
                                        <span class="text-button">Đóng hỗ trợ</span></a>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
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
    <script src="{{ asset('zoom-image.js') }}"></script>
    <script>
        Fancybox.bind("[data-fancybox]", {});
    </script>
@endsection
@section('js')
    <script src="{{ asset('/bootstrap.min.js') }}"></script>
    <script src="{{ asset('copy.js') }}"></script>
    <script>
        CopyTextOntraffic('.text-xs-copy', 'Đã sao chép!', 1000);
        var numResponse = $('.response').length;
        $('.num-response').text(numResponse);
    </script>
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
