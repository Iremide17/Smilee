<?php

namespace App\Events;

use App\Models\OrderDetail;
use Illuminate\Queue\SerializesModels;

class OrderWasCreated
{
    use SerializesModels;

    public $detail;

    public function __construct(OrderDetail $detail)
    {
        $this->detail = $detail;
    }
}
