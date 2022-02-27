<?php

namespace App\Models;

use App\Models\Status;
use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Writer extends Model
{
    use HasFactory;
    use HasUser;

    const TABLE = 'writers';
    protected $table = self::TABLE;

    protected $fillable = [
        'bio',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'user_id',
        'status_id'
    ];

    public function id(): string
    {
        return $this->id;
    }

    public function bio(): string
    {
        return $this->bio;
    }

    public function facebook(): string
    {
        return $this->facebook;
    }

    public function twitter(): string
    {
        return $this->twitter;
    }

    public function instagram(): string
    {
        return $this->instagram;
    }

    public function linkedin(): string
    {
        return $this->linkedin;
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function posts()
    {
        return $this->postsRelation;
    }

    public function postsRelation(): HasMany
    {
        return $this->hasMany(Post::class, 'writer_id');
    }

    public function latestPosts(int $amount = 5)
    {
        return $this->postsRelation()->latest()->limit($amount)->get();
    }

}
