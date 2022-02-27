<?php

namespace App\Helper;

use App\Models\Furniture;

class Furnish
{
    public function __construct()
    {
        if($this->get() === null)
            $this->set($this->empty());
    }

    public function add(Furniture $furniture): void
    {
        $furnish = $this->get();
        $cartFurnituresIds = array_column($furnish['furnitures'], 'id');
        $furniture->amount = !empty($furniture->price) ? $furniture->price : 1;

        if (in_array($furniture->id, $cartFurnituresIds)) {
            $furnish['furnitures'] = $this->furnitureCartIncrement($furniture->id, $furnish['furnitures']);
            $this->set($furnish);
            return;
        }

        array_push($furnish['furnitures'], $furniture);
        $this->set($furnish);
    }

    public function remove(int $furnitureId): void
    {
        $furnish = $this->get();
        array_splice($furnish['furnitures'], array_search($furnitureId, array_column($furnish['furnitures'], 'id')), 1);
        $this->set($furnish);
    }

    public function clear(): void
    {
        $this->set($this->empty());
    }

    public function empty(): array
    {
        return [
            'furnitures' => [],
        ];
    }

    public function get(): ?array
    {
        return request()->session()->get('furnish');
    }

    private function set($furnish): void
    {
        request()->session()->put('furnish', $furnish);
    }

    private function furnitureCartIncrement($furnitureId, $cartItems)
    {
        $amount = 1;
        $cartItems = array_map(function ($item) use ($furnitureId, $amount) {
            if ($furnitureId == $item['id']) {
                $item['amount'] += $amount;
                $item['price'] += $item['price'];
            }

            return $item;
        }, $cartItems);

        return $cartItems;
    }
}
