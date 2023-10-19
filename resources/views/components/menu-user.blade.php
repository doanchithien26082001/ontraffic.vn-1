<li><a href="{{ route('userAcount') }}"><i class="bi bi-person-fill-gear icon-item"></i> Tài khoản</a></li>
<li><a href="{{ route('userPayment') }}"><i class="bi bi-wallet2 icon-item"></i> Nạp & lịch sử nạp</a></li>
{{-- <li><a href=""><i class="bi bi-clock-history icon-item"></i> Lịch sử nạp tiền</a></li> --}}
<li><a href="{{ route('userSupport') }}"><i class="bi bi-headset icon-item"></i> Hỗ trợ</a></li>
<li><a href="{{ route('userHandleLogout') }}"><i class="bi bi-box-arrow-right icon-item"></i> Đăng xuất</a></li>
<div class="strikethrough bg-secondary my-2" style="height: 1px;"></div>
<li class="has-sub-menu"><a href=""><i class="bi bi-fast-forward-fill icon-item"></i> Tạo tiến trình <i
            class="bi arrow-01 bi-caret-down-fill"></i></a>
    <ul class="sub-nav">
        @foreach ($trafficType as $item)
            <li><a href="{{ route('createTraffic').'?type_id='.$item->id }}">{{ $item->traffic_name }}</a>
            </li>
        @endforeach
    </ul>
</li>
<li><a href=""><i class="bi bi-graph-up icon-item"></i> Quản lý tiến trình</a></li>
<div class="strikethrough bg-secondary my-2" style="height: 1px;"></div>
<li><a href=""><i class="bi bi-tags-fill icon-item"></i> Bảng giá & đại lý</a></li>
<li><a href=""><i class="bi bi-bag-plus-fill icon-item"></i> Cửa hàng</a></li>
<li><a href=""><i class="bi bi-file-earmark-post icon-item"></i> Blog</a></li>
<div class="strikethrough bg-secondary my-2" style="height: 1px;"></div>
<li><a href=""><i class="bi bi-facebook icon-item"></i> Group Facebook</a></li>
<li><a href=""><i class="bi bi-telegram icon-item"></i> Tin nhắn Telegram</a></li>
<li><a href=""><i class="bi bi-telegram icon-item"></i> Group Telegram</a></li>
