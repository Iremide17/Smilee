<?php

namespace App\Http\Livewire\Pages\Payment;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Choose extends Component
{
    use AuthorizesRequests;

    public $model;
    public $paymentDialogue = false;

    public function choosePaymentType()
    {
        $this->resetErrorBag();
        $this->paymentDialogue = true;
    }
    
    public function render()
    {
        return view('livewire.pages.payment.choose');
    }
}
