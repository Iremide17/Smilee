<?php

namespace App\Models;

use App\Models\User;
use App\Cast\TitleCast;
use App\Traits\HasAuthor;
use Illuminate\Support\Str;
use App\Traits\HasLikes;
use App\Traits\HasPoints;
use App\Traits\HasSubscriptions;
use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agent extends Model implements Viewable, PointAble
{
    use HasLikes;
    use HasFactory;
    use HasPoints;
    use HasSubscriptions;
    use InteractsWithViews;
    use HasUser;

    const TABLE = 'agents';
    protected $table = self::TABLE;

    protected $fillable = [
        'name',
        'slug',
        'phone',
        'email',
        'address',
        'instagram',
        'facebook',
        'twitter',
        'linkedin',
        'area_covered',
        'website',
        'language',
        'image',
        'description',
        'code',
        'user_id',
        'status_id'
    ];

    protected $with =[
        'userRelation'
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

    public function areaCovered(): ?string
    {
        return $this->area_covered;
    }

    public function website(): ?string
    {
        return $this->website;
    }

    public function language(): ?string
    {
        return $this->language;
    }

    public function image(): string
    {
        return $this->image;
    }

    public function code(): string
    {
        return $this->code;
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

    public function scopeForCategory(Builder $query, string $category): Builder
    {
        return $query->whereHas('categoriesRelatitudeion', function ($query) use ($category) {
            $query->where('categories.slug', $category);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }

    public function agentProperties(): string
    {
        return $this->properties()->count();
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

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        return $query->where(function($query) use ($term) {
            $query->where('name', 'like', $term)
                    ->orWhere('email', 'like', $term)
                    ->orWhere('phone', 'like', $term)
                    ->orWhere('code', 'like', $term)
                    ->orWhere('address', 'like', $term);

        });
    }
    
}