<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Contracts\Queue\ShouldQueue;

class UnlikeVendorJob implements ShouldQueue
{
    private $vendor;
    private $user;

    public function __construct(Vendor $vendor, User $user)
    {
        $this->vendor = $vendor;
        $this->user = $user;
    }


    public function handle()
    {
        $this->vendor->dislikedBy($this->user);
    }
}
