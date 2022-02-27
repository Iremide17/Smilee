<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreatePayment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $paymentDetail;

    public static function fromData($paymentDetail): self
    {
        return new static(
            $paymentDetail->body(),
            $paymentDetail->parentId(),
            $paymentDetail->author(),
            $paymentDetail->commentAble(),
            $paymentDetail->depth(),
        );
    }
}
