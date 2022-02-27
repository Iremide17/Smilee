<?php

namespace App\Listeners;

use App\Events\GalleryWasCreated;


class AwardPointsForCreatingGallery
{
    public function handle(GalleryWasCreated $event)
    {
        $amount = config('points.rewards.new_gallery');
        $message = 'vendor created a gallery image';

        $author = $event->booking->author();

        $author->addPoints($amount, $message);
    }
}
