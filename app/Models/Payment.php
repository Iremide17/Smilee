<?php

namespace App\Models;

use App\Traits\HasAuthor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Payment extends Model
{
    use HasFactory;
    use HasAuthor;

    const TABLE = 'payments';
    protected $table = self::TABLE;

    protected $fillable = [
        'email','amount', 'status', 'trans_id','ref_id', 'author_id', 'payment_type'
    ];

    protected $with = [
       'authorRelation',
    ];

    public function id(): int
    {
        return $this->id;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function amount(): string
    {
        return $this->amount;
    }

    public function transactionId(): int
    {
        return $this->trans_id;
    }

    public function referenceId(): string
    {
        return $this->ref_id;
    }

    public function getRouteKeyName()
    {
        return 'trans_id';
    }

    public function payment(): string
    {
        return $this->payment_type;
    }
}
