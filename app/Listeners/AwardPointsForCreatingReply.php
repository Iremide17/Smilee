<?php

namespace App\Listeners;

use App\Events\ReplyWasCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AwardPointsForCreatingReply implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(ReplyWasCreated $event)
    {
        $amount = config('points.rewards.new_reply');
        $message = 'User created a reply';

        $author = $event->reply->author();

        $author->addPoints($amount, $message);
    }
}
