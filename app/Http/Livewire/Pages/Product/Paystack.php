<?php

namespace App\Http\Livewire\Pages\Product;

use App\Facades\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Paystack extends Component
{
    public $carts;
    public $subTotal;
    public $shipping;
    public $total;
    public $paymentType;

    public function mount(): void
    {
        $this->carts = Cart::get();
        $cartProductsIds = array_column($this->carts['products'], 'price');
        $price = array_sum($cartProductsIds);
        $this->subTotal = $price;
        $this->shipping = config('points.rewards.shipping');
        $this->total = $price + $this->shipping; 
    }

    public function render()
    {
        $split = [
            "type" => "percentage",
            "currency" => "NGN",
            "subaccounts" => [
             [ "subaccount" => "ACCT_0vpsncxygq3d5y1", "share" => 10 ],
            ],
            "bearer_type" => "all",
            "main_account_share" => 90
        ];

        return view('livewire.pages.product.paystack',[
            'paymentType' => $this->paymentType,
            'split' => $split
        ]);
    }
}
