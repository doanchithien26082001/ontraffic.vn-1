<div class="card mb-2">
    <div class="card-body row gx-2">
        <div class="col-12 col-md-6 mb-1">
            <div class="card shadow-sm p-2">
                <a href="{{ route('userSupport') }}" class="text-danger box text-center"><i
                        class="bi bi-person-lines-fill"></i> Tất cả
                    0</span></a>
            </div>
        </div>
        <div class="col-12 col-md-6 mb-1">
            <div class="card shadow-sm p-2">
                <a href="{{ route('userSupport') }}?status=pendding" class="text-danger box text-center"><i
                        class="bi bi-clock-fill"></i> <span>Chờ
                        hỗ trợ
                        {{ $penddingCount }}</span></a>
            </div>
        </div>
        <div class="col-12 col-md-6 mb-1">
            <div class="card shadow-sm p-2">
                <a href="{{ route('userSupport') }}?status=progress" class="text-secondary box text-center"><i
                        class="bi bi-capslock-fill"></i>
                    <span>Đang hỗ
                        trợ {{ $progressCount }}</span></a>
            </div>
        </div>
        <div class="col-12 col-md-6 mb-1">
            <div class="card shadow-sm p-2">
                <a href="{{ route('userSupport') }}?status=completed " class="text-warning box text-center"><i
                        class="bi bi-check-square-fill"></i>
                    <span>Đã hỗ
                        trợ {{ $completedCount }}</span></a>
            </div>
        </div>
    </div>
</div>
