<?php

namespace App\Models;

use id;
use App\Traits\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetail extends Model
{
    use HasFactory;
    use HasTimestamps;

    const TABLE = 'order_details';
    protected $table = self::TABLE;

    protected $fillable = [
        'order_id',
        'vendor_id',
        'product_id',
        'status_id',
        'order_tracker_id',
        'tracking_code',
        'price',
    ];

    public function tracker()
    {
        return $this->belongsTo(OrderTracker::class, 'order_tracker_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function id(): string
    {
        return $this->id;
    }

    public function price(): string
    {
        return $this->price;
    }

    public function trackingCode(): ?string
    {
        return $this->tracking_code;
    }

    public function createdAt(): string
    {
        return $this->created_at;
    }


    public function createdAtDate(): string
    {
        return $this->created_at->format('d F Y');
    }

    public function getStatusBadgeAttribute()
    {

        $badges = [
            '1' => 'badge-danger',
            '2' => 'badge-info',
            '4' => 'badge-success',
        ];

        return $badges[$this->status_id];
    }

    public function getStatusBtnAttribute()
    {

        $btns = [
            '1' => 'btn-danger',
            '2' => 'btn-info',
            '4' => 'btn-success',
        ];

        return $btns[$this->status_id];
    }

    public function scopeOwner(Builder $query): Builder
    {
        return $query->where('vendor_id', auth()->user()->vendor->id());
    }

    public function scopeVendorOrders(Builder $query, $count = 4)
    {
        return $query->owner()->paginate($count);
    }
}
