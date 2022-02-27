<?php

namespace App\Models;

use App\Traits\HasTimestamps;
use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BillingAddress extends Model
{
    use HasFactory;
    use HasTimestamps;
    use HasUser;

    const TABLE = 'billing_addresses';
    protected $table = self::TABLE;

    protected $fillable = [
        'order_id',
        'address',
        'city',
        'state_id',
        'phone'
    ];

    public function id(): string
    {
        return $this->id;
    }

    public function address(): string
    {
        return $this->address;
    }

    public function city(): string
    {
        return $this->city;
    }

    public function phone(): string
    {
        return $this->phone;
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
            '2' => 'badge-success',
            '5' => 'badge-warning',
        ];

        return $badges[$this->status_id];
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
}
