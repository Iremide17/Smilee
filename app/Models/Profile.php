<?php

namespace App\Models;

use App\Traits\HasAuthor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;
    use HasAuthor;

    const TABLE = 'profiles';
    protected $table = self::TABLE;

    protected $fillable = [
        'bio',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'author_id'
    ];

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

}
