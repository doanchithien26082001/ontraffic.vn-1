<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\TrafficType;

class MenuHeader extends Component
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
        $trafficType = TrafficType::all();
        return view('components.menu-header',compact('trafficType'));
    }
}
