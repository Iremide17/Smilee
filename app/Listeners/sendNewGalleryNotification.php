<?php

namespace App\Listeners;

use App\Events\GalleryWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\NewGalleryNotification;

class sendNewGalleryNotification implements ShouldQueue
{
    public function handle(GalleryWasCreated $event)
    {
        $gallery = $event->gallery->vendor;

        foreach ($gallery->subscriptions() as $subscription) {
            $subscription->user()->notify(new NewGalleryNotification($event->gallery));
        }
    }
}
