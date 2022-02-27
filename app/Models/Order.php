<?php

namespace App\Models;

use App\Models\Status;
use App\Traits\HasAuthor;
use App\Models\OrderDetail;
use App\Traits\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    use HasTimestamps;
    use HasAuthor;

    const TABLE = 'orders';
    protected $table = self::TABLE;

    protected $fillable = [
        'author_id',
        'total',
        'payment',
        'code',
    ];

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function id(): string
    {
        return $this->id;
    }

    public function total(): string
    {
        return $this->total;
    }

    public function payment(): string
    {
        return $this->payment;
    }

    public function code(): string
    {
        return $this->code;
    }


    public function createdAt(): string
    {
        return $this->created_at;
    }

    public function createdAtDate(): string
    {
        return $this->created_at->format('d F Y');
    }

    public function scopeLoadLatest(Builder $query, $count = 4)
    {
        return $query->inRandomOrder()
            ->paginate($count);
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        return $query->where(function($query) use ($term) {
            $query->where('code', 'like', $term);
        });
    }
}
