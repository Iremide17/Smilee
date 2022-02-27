<?php

namespace App\Models;

use App\Traits\HasAuthor;
use App\Traits\HasLevels;
use Illuminate\Support\Str;
use App\Traits\HasSemesters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bank extends Model
{
    use HasFactory;
    use HasAuthor;
    use HasSemesters;
    use HasLevels;

    const TABLE = 'banks';
    protected $table = self::TABLE;

    protected $fillable = [
        'name',
        'description',
        'content',
        'author_id',
    ];

    protected $with = [
        'authorRelation',
        'semestersRelation',
        'levelsRelation'
    ];

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function excerpt (int $limit = 250): string
    {
        return Str::limit(strip_tags($this->description()) , $limit);
    }

}
