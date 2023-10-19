@extends('layouts.user')
@section('css')
    <style>
        .bg-custom-01 {
            background: #ebebeba6;
        }

        .time-support {
            font-size: 13px;
        }

        .support-item {
            cursor: pointer;
            transition: all 0.5s ease;
        }

        .support-item:hover {
            background: #ebebeb;
        }

        @media(max-width:992px) {
            .col.text-right.text-responsive {
                text-align: left;
            }
        }

        @media(max-width:376px) {
            .section-support {
                flex-wrap: wrap;
            }

            .section-support .title-section,
            .section-support .group {
                width: 100%;
            }

            .section-support .group {
                display: flex;
                justify-content: space-between;
            }

            .section-support .group .btn {
                width: 49%;
            }

            .section-support .title-section,
            .section-support .group .btn {
                margin-bottom: 5px !important;
            }
        }

        @media(max-width:315px) {
            .section-support .group {
                flex-wrap: wrap;
            }

            .section-support .group .btn {
                width: 100%;
            }
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
                    class="bi bi-caret-right-fill center"></i> <span>Trung tâm hỗ trợ</span></a>
        </span>
    </div>
@endsection
@section('content')
    <div class="row gx-3 no-reverse">
        <div class="col-12 col-md-6 col-lg-9">
            <x-support-type></x-support-type>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="section-support d-flex justify-content-between align-items-center mb-2">
                        <h2 class="title-section mb-0">Hỗ trợ của bạn</h2>
                        <div class="group">
                            @if (!request()->status)
                                <a class="btn btn-primary reload"><span
                                        class="spinner-border spinner-border-sm d-none handle" role="status"
                                        aria-hidden="true"></span>
                                    <span class="text-button"><i class="bi bi-arrow-clockwise"></i></span></a>
                            @endif
                            <a href="{{ route('createSupport') }}" class="btn btn-primary"><i
                                    class="bi bi-plus-circle-fill"></i> Tạo hỗ trợ</a>
                        </div>
                    </div>
                    @if (!request()->status)
                        <div class="form-group">
                            <select data-old="" required id="sp_type_id" name="sp_type_id"
                                class="form-select form-select bd-style-2 select-url filter-support">
                                <option value="">Tất cả hỗ trợ</option>
                                @foreach ($supportTypes as $item)
                                    <option value="{{ $item->id }}">Hỗ trợ
                                        {{ $item->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="card mt-2 list-supports">
                        @if ($listSupport->count() > 0)
                            @foreach ($listSupport as $support)
                                <a href="{{ route('getSupportById', $support->id_support) }}"
                                    class="card-body p-2 mb-1 bg-custom-01 bd-style-1 support-item">
                                    <div class="row">
                                        <div class="col-auto mb-1">
                                            <img src="{{ asset('client/images/user.png') }}" alt=""
                                                style="width:50px;height:auto">
                                        </div>
                                        <div class="col">
                                            <div class="row gx-1">
                                                <div class="col-12">
                                                    <div class="row gx-1">
                                                        <div class="col-auto">
                                                            <span class="badge rounded-pill bg-primary">Hỗ trợ
                                                                {{ $support->name }}</span>
                                                            <span
                                                                class="badge rounded-pill {{ $support->status == 'Đã hỗ trợ' ? 'bg-success' : 'bg-warning' }} ">{{ $support->status }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <span class="badge rounded-pill bg-light text-dark"><i
                                                            class="bi bi-clock"></i>
                                                        {{ date('H:i d/m/Y', strtotime($support->created_at)) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <a href="" class="card-body p-2 mb-1 bg-custom-01 bd-style-1">
                                <div class="row">
                                    <div class="col-12">
                                        <p class="mb-0">Chưa có dữ liệu hỗ trợ của bạn !</p>
                                    </div>
                                </div>
                            </a>
                        @endif
                    </div>
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
@section('js')
    <script src="{{ asset('/bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.reload').click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "{{ route('renderSupport') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    dataType: "json",
                    success: function(dataRender) {
                        $('.list-supports').html(dataRender);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert("Đã xảy ra lỗi khi tải dữ liệu: " + textStatus + " - " +
                            errorThrown);
                    }
                });
                $(this).find('.handle').removeClass('d-none');
                $(this).find('.text-button').hide();
                $('#sp_type_id').find('option:first').prop('selected', true);
                setTimeout(() => {
                    $(this).find('.handle').addClass('d-none');
                    $(this).find('.text-button').show();
                }, 500);
            });
            $('.filter-support').change(function(e) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('renderSupport') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        sp_type_id: $(this).val()
                    },
                    dataType: "json",
                    success: function(dataRender) {
                        $('.list-supports').html(dataRender);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert("Đã xảy ra lỗi khi tải dữ liệu: " + textStatus + " - " +
                            errorThrown);
                    }
                });
            });
        });
    </script>
@endsection
