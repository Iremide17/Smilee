<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Models\BillingAddress;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CreateUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;

    
    public function __construct(
        User $user
    )
    {
        $this->user = $user;
    }

    public function handle()
    {
        $ba = new BillingAddress([
            'address'               => $this->user->name(),
            'city'                  => $this->user->name(),
            'state_id'             => 1,
            'phone'                 => $this->user->name(),
        ]);

        $ba->useredBy($this->user);
        $ba->save();
        event(new Registered($this->user));
        return $ba;
    }
}
