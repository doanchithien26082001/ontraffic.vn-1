<?php

namespace App\View\Components;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class MobileMenu extends Component
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
        $userCoin = $user->coin;
        $userLevel = $user->userLevels->first()->level->level_name;
        return view('components.mobile-menu',compact('userCoin','userLevel'));
    }
}
