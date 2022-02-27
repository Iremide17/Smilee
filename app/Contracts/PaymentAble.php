<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface PaymentAble
{
    // public function title(): string;

    public function payments();

    public function latestPayments(int $amount = 5);

    public function deletePayments();

    public function paymentsRelation(): MorphMany;

    // public function PaymentAbleTitle(): string;
}
