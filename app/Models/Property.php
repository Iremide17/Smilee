<?php

namespace App\Models;

use App\Models\Status;
use App\Cast\PriceCast;
use App\Cast\TitleCast;
use App\Traits\HasLikes;
use App\Traits\HasAuthor;
use App\Traits\HasOrders;
use App\Traits\HasPoints;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model implements Viewable, PointAble
{
    use HasLikes;
    use HasFactory;
    use HasAuthor;
    use HasPoints;
    use HasOrders;
    use InteractsWithViews;

    const SALE = 'sale';
    const RENT = 'rent';


    const TABLE = 'properties';
    protected $table = self::TABLE;


    protected $fillable = [
        'slug',
        'name',
        'type',
        'category',
        'room',
        'year_built',
        'price',
        'region',
        'address',
        'latitude',
        'longitude',
        'postal_code',
        'image',
        'image_2',
        'image_3',
        'video',
        'description',
        'fence',
        'tiled',
        'well',
        'tap',
        'toilet',
        'available',
        'agent_id',
        'status_id'
    ];

    protected $with = [
        'authorRelation'
    ];

    protected $casts = [
        'name'      =>  TitleCast::class,
        'price'     => PriceCast::class,
        'year_built'=> 'datetime',
        'fence'     => 'boolean',
        'tiled'     => 'boolean',
        'well'      => 'boolean',
        'tap'       => 'boolean',
        'toilet'    => 'boolean',
        'available' =>  'boolean',
    ];

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function slug(): string
    {
        return $this->slug;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function category(): string
    {
        return $this->category;
    }

    public function room(): int
    {
        return $this->room;
    }

    public function yearBuilt(): string
    {
        return $this->year_built->format('d F Y');
    }

    public function price(): string
    {
        return $this->price;
    }

    public function region(): string
    {
        return $this->region;
    }

    public function address(): string
    {
        return $this->address;
    }

    public function latitude(): string
    {
        return $this->latitude;
    }

    public function longitude(): string
    {
        return $this->longitude;
    }

    public function postalCode(): string
    {
        return $this->postal_code;
    }

    public function firstImage(): ?string
    {
        return $this->image;
    }

    public function secondImage(): ?string
    {
        return $this->image_2;
    }

    public function thirdImage(): ?string
    {
        return $this->image_3;
    }

    public function video(): ?string
    {
        return $this->video;
    }

    public function fence(): bool
    {
        return $this->fence;
    }

    public function tiled(): bool
    {
        return $this->tiled;
    }

    public function well(): bool
    {
        return $this->well;
    }

    public function tap(): bool
    {
        return $this->tap;
    }

    public function toilet(): bool
    {
        return $this->toilet;
    }

    public function availability(): bool
    {
        return $this->available;
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

    public function agent(): BelongsTo
    {
        return $this->belongsTo(Agent::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeLoadLatest(Builder $query, $count = 4)
    {
        return $query->availabled()
            ->verified()
            ->paginate($count);
    }

    public function scopeAvailabled(Builder $query): Builder
    {
        return $query->where('available', true);
    }

    public function scopeVerified(Builder $query): Builder
    {
        return $query->where('status_id', 4);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        return $query->where(function($query) use ($term) {
            $query->where('name', 'like', $term)
                    ->orWhere('address', 'like', $term);

        });
    }

}

