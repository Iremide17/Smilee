<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\PaymentWasMade;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\NewPaymentNotification;

class SendNewPaymentNotification implements ShouldQueue
{
    public function handle(PaymentWasMade $event)
    {
        $admins = User::where('type', 1)->get();

        foreach ($admins as $admin) {
            $admin->notify(new NewPaymentNotification($event->payment));
        }
    }
}
