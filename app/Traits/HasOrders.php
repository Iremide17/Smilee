<?php

namespace App\Traits;

use App\Models\Order;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasOrders
{
    public function orders()
    {
        return $this->ordersRelation;
    }

    public function ordersRelation(): MorphMany
    {
        return $this->morphMany(Order::class, 'ordersRelation', 'orderable_type', 'orderable_id');
    }

    public function latestOrders(int $amount = 5)
    {
        return $this->ordersRelation()->latest()->limit($amount)->get();
    }

    public function deleteOrders()
    {
        foreach ($this->ordersRelation()->get() as $order) {
            $order->delete();
        }

        $this->unsetRelation('ordersRelation');
    }
}
