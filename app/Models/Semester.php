<?php

namespace App\Models;

use App\Traits\HasPeriods;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    use HasPeriods;
    
    const TABLE = 'semesters';
    public $table = self::TABLE;

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'active',
    ];

    protected $with = [
        'periodsRelation'
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
