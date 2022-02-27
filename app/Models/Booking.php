<?php

namespace App\Models;

use App\Models\Agent;
use App\Models\Status;
use App\Models\Property;
use App\Traits\HasAuthor;
use App\Traits\HasTimestamps;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;
    use HasTimestamps;
    use HasAuthor;

    const TABLE = 'bookings';
    protected $table = self::TABLE;

    protected $fillable = [
        'author_id',
        'property_id',
        'agent_id',
        'status_id',
        'duration',
        'start_at',
        'end_at'
    ];

    protected $with = [
        'authorRelation',
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    public function id(): int
    {
        return $this->id;
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
    
    public function agent(): BelongsTo
    {
        return $this->belongsTo(Agent::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function startAt(): ?string
    {
        return $this->start_at;
    }

    public function startAtDate(): ?string
    {
        return $this->start_at->format('d F Y');
    }

    public function endAt(): ?string
    {
        return $this->end_at;
    }

    public function endAtDate(): ?string
    {
        return $this->end_at->format('d F Y');
    }

    public function duration(): ?string
    {
        return $this->duration;
    }

    public function scopePayable(Builder $query): Builder
    {
        return $query->where('duration', '!=', null);
    }

    public function getStatusBtnAttribute()
    {

        $btns = [
            '1' => 'btn-primary text-sm text-gray-900 font-bold',
            '3' => 'btn-warning text-sm text-gray-900 font-bold',
            '4' => 'btn-success text-sm text-gray-900 font-bold',
            '5' => 'btn-danger text-sm text-gray-900 font-bold ',
        ];

        return $btns[$this->status_id];
    }

}
