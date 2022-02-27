<?php

namespace App\Events;

use App\Models\Payment;
use Illuminate\Queue\SerializesModels;

class PaymentWasMade
{
    use SerializesModels;

    public $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }
}
