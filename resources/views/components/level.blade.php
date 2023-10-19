<div class="card shadow mb-3">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="title-section mb-0">Cấp bậc đại lý</h2>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-sm level">
                <thead>
                    <tr>
                        <th class="text-center align-middle text-no-wrap">Level</th>
                        <th class="text-center align-middle text-no-wrap">Tổng nạp</th>
                        <th class="text-center align-middle text-no-wrap">Chiết khấu (%)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataLevels as $item)
                        <tr>
                            <td class="text-center align-middle text-no-wrap">{{ $item->level_name }}
                            </td>
                            <td class="text-center align-middle text-no-wrap">
                                {{ $item->hook > 0 ? '>= ' . number_format($item->hook, 0, ',', '.') : number_format($item->hook, 0, ',', '.') }}
                                đ</td>
                            <td class="text-center align-middle text-no-wrap">{{ $item->discount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
