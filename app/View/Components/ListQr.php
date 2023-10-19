<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use App\QrPayment;

class ListQr extends Component
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
        $currentUser = Auth::user();
        $dataQr = QrPayment::select('users.transfer_content','qr_payments.qr_img', 'bank_acounts.bank_name', 'bank_acounts.acount_number', 'bank_acounts.acount_name','bank_acounts.bank_id')
            ->where('user_id', $currentUser->id)
            ->join('bank_acounts', 'bank_acounts.id', '=', 'qr_payments.bank_acount_id')
            ->join('users', 'users.id', '=', 'qr_payments.user_id')
            ->get();
        return view('components.list-qr', compact('dataQr'));
    }
}
