<?php

namespace App\Jobs;

use App\Models\Post;
use App\Models\User;
use App\Exceptions\CannotLikeItem;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class LikePostJob implements ShouldQueue
{
    use Dispatchable;

    public $post;
    public $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Post $post, User $user)
    {
        $this->post = $post;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->post->isLikedBy($this->user)) {
            throw CannotLikeItem::alreadyLiked('post');
        }

        $this->post->likedBy($this->user);
    }
}
