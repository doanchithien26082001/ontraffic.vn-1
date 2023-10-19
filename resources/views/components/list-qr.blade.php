@foreach ($dataQr as $qr)
<div class="col-12 col-sm-6">
    <div class="mt-2 card shadow-sm">
        <div class="card-body">
            <div class="row gx-1">
                <div class="qr-img col-12">
                    <a href="{{ asset($qr->qr_img) }}" data-fancybox="zoom-qr" class="d-block"
                        data-caption="{{$qr->bank_name}}">
                        <img src="{{ asset($qr->qr_img) }}" alt="" class="img-fluid">
                    </a>
                </div>
                <div class="col-12 p-2">
                    <p class="mb-0"><span class="fst-normal text-danger text-xs">Ngân
                            hàng:</span> <span class="fw-bolder text-xs text-xs-copy">{{$qr->bank_name}}</span></p>
                    <p class="mb-0"><span class="fst-normal text-danger text-xs">Số tài
                            khoản:</span> </span> <span class="fw-bolder text-xs text-xs-copy">{{$qr->acount_number}}</span></p>
                    <p class="mb-0"><span class="fst-normal text-danger text-xs">Tên tài
                            khoản:</span> </span> <span class="fw-bolder text-xs">{{$qr->acount_name}}</span></p>
                    <p class="mb-0"><span class="fst-normal text-danger text-xs">Nội dung
                            CK:</span> </span> <span class="fw-bolder text-xs text-xs-copy">{{$qr->transfer_content}}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
