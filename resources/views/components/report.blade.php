<div class="card shadow report mb-3">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="title-section mb-0">Báo cáo</h2>
        </div>
        <div class="row gx-2">
            <div class="col-6 mb-2">
                <div class="p-2 bd-style-2 d-flex shadow-sm">
                    <div class="icon-report">
                        <i class="bi bi-wallet text-primary"></i>
                    </div>
                    <div class="wp-block">
                        <p class="mb-0 title-report">Tổng nạp</p>
                        <p class="mb-0 desc-report">{{ number_format($userMoney, 0, ',', '.') }} đ</p>
                    </div>
                </div>
            </div>
            <div class="col-6 mb-2">
                <div class="p-2 bd-style-2 d-flex shadow-sm">
                    <div class="icon-report">
                        <i class="bi bi-percent text-success"></i>
                    </div>
                    <div class="wp-block">
                        <p class="mb-0 title-report">Discount</p>
                        <p class="mb-0 desc-report">{{ $userDiscount }}%</p>
                    </div>
                </div>
            </div>
            <div class="col-6 mb-2">
                <div class="p-2 bd-style-2 d-flex shadow-sm">
                    <div class="icon-report">
                        <i class="bi bi-coin text-danger"></i>
                    </div>
                    <div class="wp-block">
                        <p class="mb-0 title-report">Coin</p>
                        <p class="mb-0 desc-report"> {{ number_format($userCoin, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-6 mb-2">
                <div class="p-2 bd-style-2 d-flex shadow-sm">
                    <div class="icon-report">
                        <i class="bi bi-diagram-3-fill text-info"></i>
                    </div>
                    <div class="wp-block">
                        <p class="mb-0 title-report">Dịch vụ</p>
                        <p class="mb-0 desc-report">Đang chạy: {{ $userServices->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
