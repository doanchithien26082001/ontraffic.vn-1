@extends('layouts.user')
@section('css')
    <link rel="stylesheet" href="{{ asset('zoom-image.css') }}" />
    <style>
        .icon-report {
            padding: 14px 19px;
            border-radius: 10px;
            background: #9771df1a;
        }

        .icon-report i {
            font-size: 20px;
        }

        .report .wp-block {
            margin-left: 15px;
        }

        .report .wp-block .title-report {
            font-weight: 700;
        }

        .report .wp-block .desc-report {
            font-size: 14px;
            color: rgb(75 167 179);
        }

        .report .p-2.bd-style-2.d-flex {
            background: #92a3bd1a;
        }

        .qr-img {
            position: relative;
            height: auto;
            cursor: pointer;
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

        @media(max-width:976px) {
            .icon-report {
                padding: 9px 7px;
            }
        }

        @media (max-width: 767px) {
            table.history td {
                padding: 5px 20px;
            }

            .page-content .content .payment.row {
                flex-direction: column;
            }
        }

        @media(max-width:600px) {

            .is-horizontal .fancybox__nav .f-button.is-prev,
            .is-horizontal .fancybox__nav .f-button.is-next {
                display: none;
            }
        }

        @media(max-width:365px) {
            .text-xs {
                display: inline-block;
                width: 100%;
            }

            .nav-link {
                padding: 0.2rem 0.5rem;
            }

            .tooltip-ontraffic {
                left: 0;
            }

            .report .wp-block {
                margin-left: 5px;
            }
        }
    </style>
@endsection
@section('breadcrumb')
    <div class="breadcrumb">
        <span class="nav-link home d-flex align-content-center"><a href="{{ route('userDashboard') }}"><i
                    class="bi bi-house-fill"></i> <span>Hệ thống</span></a>
        </span>
        <span class="nav-link d-flex align-content-center"><a href="{{ route('userPayment') }}"><i
                    class="bi bi-caret-right-fill center"></i> <span>Nạp tiền & Lịch sử</span></a>
        </span>
    </div>
@endsection
@section('content')
    <div class="row gx-3 payment">
        <div class="col-12 col-md-6 col-lg-7">
            <div class="card shadow mb-3">
                <div class="card-body">
                    <!-- Tab Nav -->
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="recharge-tab" data-bs-toggle="tab" href="#recharge"
                                        role="tab" aria-controls="recharge" aria-selected="true">Nạp tiền</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="history-tab" data-bs-toggle="tab" href="#history" role="tab"
                                        aria-controls="history" aria-selected="false">Lịch sử</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Tab Content -->
                    <div class="tab-content p2 mt-3" id="myTabContent">
                        <div class="tab-pane fade show active" id="recharge" role="tabpanel"
                            aria-labelledby="recharge-tab">
                            <div class="card shadow-sm">
                                <div class="card-body text-justify">
                                    <x-text-payment></x-text-payment>
                                </div>
                            </div>
                            <div class="row gx-2">
                                <x-list-qr></x-list-qr>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div
                                        class="header-notication d-flex justify-content-between align-items-center mb-3 flex-wrap flex-md-nowrap">
                                        <h2 class="title-section mb-0">Lịch sử nạp tiền</h2>
                                        <input type="text" name="find-history" id="find-history"
                                            class="form-control bd-style-2 w-50 w-sm-100 mt-3 mt-sm-0"
                                            placeholder="Nhập id tìm kiếm">
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover history">
                                            <thead>
                                                <tr>
                                                    <th class="text-center align-middle text-no-wrap">Id nạp</th>
                                                    <th class="text-center align-middle text-no-wrap">Thời gian</th>
                                                    <th class="text-center align-middle text-no-wrap">Số tiền nạp</th>
                                                    <th class="text-center align-middle text-no-wrap">Tổng nạp</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($transactionHistory->count() > 0)
                                                    @foreach ($transactionHistory as $item)
                                                        <tr>
                                                            <td class="text-center align-middle text-no-wrap">
                                                                {{ $item->id_payment }}</td>
                                                            <td class="text-center align-middle text-no-wrap">
                                                                {{ date('H:i d/m/Y', strtotime($item->created_at)) }}</td>
                                                            <td class="text-center align-middle text-no-wrap">
                                                                {{ number_format($item->money, 0, ',', '.') }} đ</td>
                                                            <td class="text-center align-middle text-no-wrap">
                                                                {{ number_format($item->money_total, 0, ',', '.') }} đ</td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="4"
                                                            class="text-center align-middle text-no-wrap text-bold">Chưa có
                                                            dữ liệu cho mục này</td>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div
                                        class="header-notication d-flex justify-content-between align-items-center my-3 flex-wrap flex-md-nowrap">
                                        <h2 class="title-section mb-0">Biến động Coin</h2>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center align-middle text-no-wrap">Thời gian</th>
                                                    <th class="text-center align-middle text-no-wrap">Coin +</th>
                                                    <th class="text-center align-middle text-no-wrap">Coin -</th>
                                                    <th class="text-center align-middle text-no-wrap">Tổng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="4"
                                                        class="text-center align-middle text-no-wrap text-bold">Chưa có
                                                        dữ liệu cho mục này</td>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
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
@section('js-before')
    <script src="{{ asset('zoom-image.js') }}"></script>
    <script>
        Fancybox.bind("[data-fancybox]", {});
    </script>
@endsection
@section('js')
    <script src="{{ asset('bootstrap.min.js') }}"></script>
    <script src="{{ asset('copy.js') }}"></script>
    <script>
        CopyTextOntraffic('.text-xs-copy', 'Đã sao chép!', 1000);
    </script>
    <script>
        $('#find-history').keyup(function(e) {
            $.ajax({
                type: "POST",
                url: "{{ url('find-history') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    value: $(this).val(),
                },
                dataType: "json",
                success: function(result) {
                    $('.history tbody').html(result);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Đã xảy ra lỗi khi tải dữ liệu: " + textStatus + " - " + errorThrown);
                }
            });
        });
    </script>
@endsection
