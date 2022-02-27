<?php

namespace App\Traits;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasPayments
{
    public function payments()
    {
        return $this->paymentsRelation;
    }

    public function paymentsRelation(): MorphMany
    {
        return $this->morphMany(Payment::class, 'paymentable');
    }

    public function latestPayments(int $amount = 5)
    {
        return $this->paymentsRelation()->latest()->limit($amount)->get();
    }
}
