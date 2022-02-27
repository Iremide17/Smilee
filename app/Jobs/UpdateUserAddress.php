<?php

namespace App\Jobs;

use Illuminate\Support\Arr;
use Illuminate\Bus\Queueable;
use App\Models\BillingAddress;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Http\Requests\AddressStoreRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class UpdateUserAddress implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    private $attributes;
    private $billingAddress;
    
   
    public function __construct(BillingAddress $billingAddress , array $attributes = [])
    {
        $this->billingAddress = $billingAddress;
        $this->attributes = Arr::only($attributes, [
            'address', 'city', 'state_id', 'phone'
        ]);
    }

    public static function fromRequest(BillingAddress $billingAddress, AddressStoreRequest $request): self
    {
        return new static($billingAddress, [
            'address'         => $request->address(),
            'city'          => $request->city(),
            'state_id'      => $request->state(),
            'phone'          => $request->phone(),
        ]);
    }

    public function handle()
    {
        $this->billingAddress->update($this->attributes);
        $this->billingAddress->save();
        return $this->billingAddress;
    }
}
