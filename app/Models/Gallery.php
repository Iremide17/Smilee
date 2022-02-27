<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Traits\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory;
    use HasTimestamps;

    const TABLE = 'galleries';
    protected $table = self::TABLE;

    protected $fillable = [
        'name',
        'image',
        'description',
        'vendor_id',
    ];

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function image(): string
    {
        return $this->image;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function excerpt (int $limit = 250): string
    {
        return Str::limit(strip_tags($this->description()) , $limit);
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }
    
}
