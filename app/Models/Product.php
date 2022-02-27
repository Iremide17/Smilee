<?php

namespace App\Models;

use App\Cast\PriceCast;
use App\Cast\TitleCast;
use App\Traits\HasLikes;
use Illuminate\Support\Str;
use App\Traits\HasCategories;
use App\Contracts\CommentAble;
use App\Traits\HasCommentable;
use App\Traits\HasComments;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model implements Viewable, CommentAble
{
    use HasFactory;
    use HasLikes;
    use HasCategories;
    use InteractsWithViews;
    use HasCommentable;
    use HasComments;

    const TABLE = 'products';

    protected $table = self::TABLE;

    protected $fillable = [
        'title',
        'slug',
        'price',
        'image',
        'image2',
        'image3',
        'type',
        'code',
        'barcode',
        'description',
        'vendor_id',
        'is_commentable',
        'status_id'
    ];

    protected $with = [
        'categoriesRelation',
        'likesRelation',
    ];

    protected $casts = [
        'title' => TitleCast::class,
        'type' => TitleCast::class,
        'is_commentable' => 'boolean',
    ];

    public function id(): int
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function price(): string
    {
        return $this->price;
    }

    public function firstImage(): ?string
    {
        return $this->image;
    }

    public function secondImage(): ?string
    {
        return $this->image2;
    }

    public function thirdImage(): ?string
    {
        return $this->image3;
    }

    public function code(): ?string
    {
        return $this->code;
    }

    public function barcode(): string
    {
        return $this->barcode;
    }

    public function description(): ?string
    {
        return $this->description;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function commentType(): string
    {
        return 'products';
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function getStatusBadgeAttribute()
    {

        $badges = [
            '1' => 'badge-danger',
            '2' => 'badge-default',
            '3' => 'badge-primary',
            '4' => 'badge-success',
            '5' => 'badge-warning',
        ];

        return $badges[$this->status_id];
    }

    public function slug(): string
    {
        return $this->slug;
    }

    public function isCommentable(): bool
    {
        return $this->is_commentable;
    }

    public function isNew(): bool
    {
        return $this->type() == 'new';
    }

    public function excerpt(int $limit = 250): string
    {
        return Str::limit(strip_tags($this->description()), $limit);
    }

    public function replyAbleSubject(): string
    {
        return $this->title();
    }

    public function scopeLoadLatest(Builder $query, $count = 4)
    {
        return $query->inRandomOrder()
            ->verified()
            ->paginate($count);
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
                    ->orWhere('price', 'like', $term);
        });
    }

    public function commentAbleTitle(): string
    {
        return $this->title();
    }
}
