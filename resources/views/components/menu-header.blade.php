<ul class="list-services d-none d-lg-flex">
    <li class="p-relative"><a href="#">Traffic Google <i class="bi bi-caret-down-fill"></i></a>
        <ul class="sub-menu p-absolute shadow-lg">
            @foreach ($trafficType as $item)
                <li><a href="{{ route('createTraffic') . '?type_id=' . $item->id }}">{{ $item->traffic_name }}</a>
                </li>
            @endforeach
        </ul>
    </li>
    <li class="p-relative"><a href="">Tăng Điểm Seo <i class="bi bi-caret-down-fill"></i></a>
        <ul class="sub-menu p-absolute shadow-lg">
            <li>
                <a href="#">Tăng điểm DA</a>
            </li>
            <li>
                <a href="#">Tăng điểm DR</a>
            </li>
        </ul>
    </li>
    <li><a href="#">Backlink Profile</a></li>
    <li><a href="#">Backlink Blog 2.0</a></li>
</ul>
