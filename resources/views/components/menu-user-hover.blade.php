<div class="card-body">
    <a href="" class="d-block text-center info avatar pb-2">
        <img src="{{ asset('/client/images/user.png') }}" alt="">
    </a>
    <p class="text-center mb-0 info-username text-dark">
        <strong>{{ Auth::user()->name }}</strong>
    </p>
    <p class="text-center mb-0 info-coin text-danger"><strong> {{ number_format($userCoin, 0, ',', '.') }} Coin</strong></p>
    <ul class="list-nav-user">
        <x-menu-user></x-menu-user>
    </ul>
</div>