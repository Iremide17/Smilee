<?php

namespace App\Models;

use App\Cast\TitleCast;
use App\Traits\HasTags;
use App\Traits\HasLikes;
use App\Traits\HasComments;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Contracts\CommentAble;

class Post extends Model implements CommentAble, Viewable
{
    use HasTags;
    use HasLikes;
    use HasFactory;
    use InteractsWithViews;
    use HasComments;

    const STANDARD = 'standard';
    const PREMIUM = 'premium';
    
    const TABLE = 'posts';

    public $table = self::TABLE;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'is_commentable',
        'image',
        'published_at',
        'type',
        'writer_id',
        'photo_credit_text',
        'photo_credit_link',
        'status_id'
    ];

     //eagerload with relationship
     protected $with = [
        'tagsRelation',
        'likesRelation',
        'commentsRelation'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'title' => TitleCast::class,
        'body' => TitleCast::class,
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

    public function PhotoCreditText(): ?string
    {
        return $this->photo_credit_text;
    }

    public function PhotoCreditLink(): ?string
    {
        return $this->photo_credit_link;
    }

     public function body(): string
    {
        return $this->body;
    }

    public function publishedAt(): string
    {
        return $this->published_at;
    }


    public function publishedAtDate(): string
    {
        return $this->published_at->format('d F Y');
    }

    public function type(): string
    {
        return $this->type;
    }

    public function getCreatedDateAttribute()
    {
        return $this->published_at->format('M, d Y');
    }

    public function image(): string
    {
        return $this->image;
    }

    public function isCommentable(): bool
    {
        return $this->is_commentable;
    }

     public function excerpt (int $limit = 250): string
    {
        return Str::limit(strip_tags($this->body()) , $limit);
    }

    public function scopeForTag(Builder $query, string $tag): Builder
    {
        return $query->published()
            ->verified()
            ->whereHas('tagsRelation', function ($query) use ($tag) {
            $query->where('tags.slug', $tag);
        });
    }

    public function scopeVerified(Builder $query): Builder
    {
        return $query->where('status_id', 4);
    }

    public function isPremium(): bool
    {
        return $this->type() == 'premium';
    }

    public function readTime()
    {
        $minutes = round(str_word_count(strip_tags($this->body())) / 200);

        return  $minutes == 0 ? 1 : $minutes;
    }

    public function commentType(): string
    {
        return 'posts';
    }

    public function commentAbleTitle(): string
    {
        return $this->title();
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function delete()
    {
        $this->removeTags();
        parent::delete();
    }

    public function scopeLoadLatest(Builder $query, $count = 4)
    {
        return $query->whereNotNull('published_at')
            ->published()
            ->inRandomOrder()
            ->paginate($count);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published_at', '<=', new \DateTime());
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        return $query->where(function($query) use ($term) {
            $query->where('title', 'like', $term);
        });
    }

    public function writer(): BelongsTo
    {
        return $this->belongsTo(Writer::class);
    }

}
