<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\User;
use App\TrafficType;

class MenuUser extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $users;
    public function __construct()
    {
        $this->users = User::all();
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $trafficType = TrafficType::all();
        return view('components.menu-user', compact('trafficType'));
    }
}
