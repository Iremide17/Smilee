<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;
use App\Notifications\NewCommentNotification;

class NotificationSeeder extends Seeder
{
    use WithFaker;

    public function run()
    {
        Comment::all()->each(function (Comment $comment) {
            $comment->author()->notifications()->create([
                'id'   => Str::uuid()->toString(),
                'type' => NewCommentNotification::class,
                'data' => [
                    'type' => 'new_comment',
                    'comment' => $comment->id(),
                    'commentable_id' => $comment->commentable_id,
                    'commentable_type' => $comment->commentable_type,
                    'commentable_subject' => $comment->commentAble()->commentAbleSubject(),
                ],
                'created_at' => $comment->createdAt(),
                'updated_at' => $comment->createdAt(),
            ]);
        });
    }
}
