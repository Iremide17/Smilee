<?php

namespace App\Models;

use App\Traits\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Status extends Model
{
    use HasFactory;
    use HasTimestamps;

    const TABLE = 'statuses';

    public $table = self::TABLE;

    protected $fillable =
    [
        'name',
    ];

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

}
