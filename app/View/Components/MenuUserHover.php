<?php

namespace App\View\Components;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class MenuUserHover extends Component
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
        $userCoin = Auth::user()->coin;
        return view('components.menu-user-hover',compact('userCoin'));
    }
}
