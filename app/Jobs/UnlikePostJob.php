<?php

namespace App\Jobs;

use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


class UnlikePostJob implements ShouldQueue
{
    use Dispatchable;

    public $post;
    public $user;

    public function __construct(Post $post, User $user)
    {
        $this->post = $post;
        $this->user = $user;
    }

    public function handle()
    {
        $this->post->dislikedBy($this->user);
    }
}
