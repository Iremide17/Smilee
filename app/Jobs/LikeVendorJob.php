<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Vendor;
use App\Exceptions\CannotLikeItem;
use Illuminate\Contracts\Queue\ShouldQueue;


class LikeVendorJob implements ShouldQueue
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
        if ($this->vendor->isLikedBy($this->user)) {
            throw CannotLikeItem::alreadyLiked('vendor');
        }

        $this->vendor->likedBy($this->user);
    }
}
