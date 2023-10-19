<?php

namespace App\View\Components;

use App\Support;
use Illuminate\Support\Facades\Auth;

use Illuminate\View\Component;

class SupportType extends Component
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
        $allCount = Support::all();
        $penddingCount = Support::where([['status', 'Chờ hỗ trợ' ], ['user_id', Auth::user()->id]])->count();
        $progressCount = Support::where([['status', 'Đang hỗ trợ' ], ['user_id', Auth::user()->id]])->count();
        $completedCount = Support::where([['status', 'Đã hỗ trợ' ], ['user_id', Auth::user()->id]])->count();
        return view('components.support-type', compact('allCount', 'penddingCount', 'progressCount', 'completedCount'));
    }
}
