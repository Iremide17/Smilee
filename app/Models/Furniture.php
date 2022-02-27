<?php

namespace App\Models;

use App\Models\Status;
use App\Models\Vendor;
use App\Cast\PriceCast;
use App\Cast\TitleCast;
use Illuminate\Support\Str;
use App\Traits\HasCategories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Furniture extends Model
{
    use HasFactory; 
    use HasCategories;

    const TABLE = 'furnitures';
    protected $table = self::TABLE;

    protected $fillable = [
        'title',
        'slug',
        'price',
        'type',
        'description',
        'code',
        'image',
        'image2',
        'image3',
        'vendor_id',
        'status_id'
    ];

    protected $with =[
        'vendor',
        'categoriesRelation'
    ];

    protected $casts = [
        'title'  =>  TitleCast::class,
        'price'  =>  PriceCast::class,
    ];

    public function id(): int
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function slug(): string
    {
        return $this->slug;
    }

    public function price(): string
    {
        return $this->price;
    }

    public function firstImage(): string
    {
        return $this->image;
    }

    public function secondImage(): string
    {
        return $this->image2;
    }

    public function thirdImage(): string
    {
        return $this->image3;
    }

    public function code(): string
    {
        return $this->code;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->format('M, d Y');
    }

    public function excerpt(int $limit = 250): string
    {
        return Str::limit(strip_tags($this->description()) , $limit);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function scopeVerified(Builder $query): Builder
    {
        return $query->where('status_id', 4);
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        return $query->where(function($query) use ($term) {
            $query->where('title', 'like', $term)
                    ->orWhere('code', 'like', $term);
        });
    }

    public function scopeLoadLatest(Builder $query, $count = 4)
    {
        return $query->inRandomOrder()
            ->verified()
            ->paginate($count);
    }
    
}
