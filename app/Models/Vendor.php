<?php

namespace App\Models;

use App\Models\User;
use App\Models\Status;
use App\Cast\TitleCast;
use App\Models\Product;
use App\Traits\HasUser;
use App\Traits\HasLikes;
use App\Models\Furniture;
use App\Traits\HasAuthor;
use Illuminate\Support\Str;
use App\Traits\HasCategories;
use App\Traits\HasSubscriptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vendor extends Model implements Viewable, SubscriptionAble
{
    use HasLikes;
    use HasFactory;
    use HasCategories;
    use InteractsWithViews;
    use HasSubscriptions;
    use HasUser;

    const TABLE = 'vendors';
    protected $table = self::TABLE;

    protected $fillable = [
        'name',
        'slug',
        'phone',
        'email',
        'address',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'latitude',
        'longitude',
        'postal_code',
        'image',
        'banner',
        'description',
    ];

     protected $with = [
        'categoriesRelation'
    ];

    protected $casts = [
        'name'  =>  TitleCast::class,
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

    public function phone(): string
    {
        return $this->phone;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function address(): string
    {
        return $this->address;
    }

    public function instagram(): ?string
    {
        return $this->instagram;
    }

    public function facebook(): ?string
    {
        return $this->facebook;
    }

    public function twitter(): ?string
    {
        return $this->twitter;
    }

    public function linkedin(): ?string
    {
        return $this->linkedin;
    }

    public function latitude(): string
    {
        return $this->latitude;
    }

    public function longitude(): string
    {
        return $this->longitude;
    }

    public function image(): string
    {
        return $this->image;
    }

    public function banner(): string
    {
        return $this->banner;
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

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }

    public function vendorGalleries(): int
    {
        return $this->galleries->count();
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function vendorProducts(): int
    {
        return $this->products->count();
    }

    public function furnitures(): HasMany
    {
        return $this->hasMany(Furniture::class);
    }

    public function vendorfurnitures(): int
    {
        return $this->furnitures->count();
    }

    public function orders(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function scopeLoadLatest(Builder $query, $count = 4)
    {
        return $query->inRandomOrder()
            ->verified()
            ->paginate($count);
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
                    ->orWhere('email', 'like', $term)
                    ->orWhere('phone', 'like', $term)
                    ->orWhere('address', 'like', $term);

        });
    }
    
}