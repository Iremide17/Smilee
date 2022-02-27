<?php

namespace App\Policies;

class PaystackSub
{
    const CANCELLED_STATUS = 'cancelled';
    const ACTIVE_STATUS = 'active';
    const COMPLETED_STATUS = 'complete';

    /**
     * Get the billable entity instance by Paystack ID.
     *
     */
    public static function findBillable($paystackId)
    {
        if ($paystackId === null) {
            return;
        }

        $model = config('paystacksubscription.model', env('SUBSCRIPTION_MODEL'));

        return (new $model)->where('paystack_id', $paystackId)->first();
    }
}
