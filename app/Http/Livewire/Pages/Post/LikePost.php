<?php

namespace App\Http\Livewire\Pages\Post;

use App\Models\Post;
use Livewire\Component;
use App\Jobs\LikePostJob;
use App\Jobs\UnlikePostJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;

class LikePost extends Component
{
    use DispatchesJobs;
    
    public $post;

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function toggleLike()
    {
        if ($this->post->isLikedBy(Auth::user())) {
            $this->dispatchSync(new UnlikePostJob($this->post, Auth::user()));
        } else {
            $this->dispatchSync(new LikePostJob($this->post, Auth::user()));
        }
    }
    
    public function render()
    {
        return view('livewire.pages.post.like-post');
    }
}
