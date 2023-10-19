<div class="wp-moblie-menu p-3">
    <div class="text-center pt-3 pb-2">
        <img src="{{ asset('/client/images/user.png') }}" alt="" class="user-avatar">
    </div>
    <div class="wp-block text-center">
        <p class="mb-0 info-username text-dark"><strong>{{ Auth::user()->name }}</strong></p>
        <p class="mb-0 num-coin text-success"><span class="coin"> {{ number_format($userCoin, 0, ',', '.') }} Coin</span></p>
        <p class="mb-0 level-user btn btn-primary w-100 my-3">Cấp đại lý: {{ $userLevel }}</p>
    </div>
    <ul class="moblie-menu p-2">
        <x-menu-user></x-menu-user>
    </ul>
</div>
