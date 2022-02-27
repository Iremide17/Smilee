<?php

namespace App\Mail;

use App\Models\Comment;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewCommentEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $comment;
    public $subscription;

    public function __construct(Comment $comment, ?Subscription $subscription = null)
    {
        $this->comment = $comment;
        $this->subscription = $subscription;
    }

    public function build()
    {
        return $this->subject("Re: {$this->comment->commentAble()->title()}")
            ->markdown('emails.new_comment');
    }
}
