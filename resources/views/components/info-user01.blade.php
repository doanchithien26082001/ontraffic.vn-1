<img src="{{ asset('/client/images/user.png') }}" alt="" class="user-avatar">
<div class="wp-block">
    <p class="text-left mb-0 info-username text-dark"><strong>{{ Auth::user()->name }}</strong></p>
    <p class="text-left mb-0 num-coin text-success"><span class="coin"> {{ number_format($userCoin, 0, ',', '.') }} Coin</span></p>
</div>
