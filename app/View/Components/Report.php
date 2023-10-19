<?php

namespace App\View\Components;

use App\Traffic;
use Illuminate\Support\Facades\Auth;

use Illuminate\View\Component;

class Report extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $user = Auth::user();
        $userCoin =  $user->coin;
        $userMoney =  $user->total_money;
        $userDiscount = $user->userLevels->first()->level->discount;
        $userServices = Traffic::join('users', 'users.id', '=', 'traffics.user_id')
            ->where([
                ['traffics.user_id', $user->id],
                ['traffics.traffic_status', 'Đang xử lý']
            ])->get();
        return view('components.report', compact('userCoin', 'userMoney', 'userDiscount', 'userServices'));
    }
}
