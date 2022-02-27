<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTracker extends Model
{
    use HasFactory;

    const TABLE = 'order_trackers';

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
