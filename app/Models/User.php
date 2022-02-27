<?php

namespace App\Models;

use App\Models\Post;
use App\Models\Writer;
use App\Cast\TitleCast;
use App\Traits\HasPoints;
use App\Traits\HasFollows;
use Illuminate\Support\Str;
use App\Traits\ModelHelpers;
use Laravel\Sanctum\HasApiTokens;
use Bavix\Wallet\Traits\HasWallet;
use Bavix\Wallet\Interfaces\Wallet;
use Bavix\Wallet\Traits\HasWallets;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use function Illuminate\Events\queueable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail, Wallet, PointAble
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasWallet;
    use HasWallets;
    use ModelHelpers;
    use HasPoints;
    use HasFollows;

    const ADMIN = 1;
    const SUPERADMIN = 2;
    const AGENT = 3;
    const WRITER = 4;
    const VENDOR = 5;
    const DEFAULT = 6;

    const TABLE = 'users';

    protected $table = self::TABLE;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'type',
        'line1',
        'line2',
        'city',
        'state',
        'country',
        'postal_code',
        'facebook_id',
        'google_id',
    ];

    protected $with = [
        'wallet',
        // 'subscriptions'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'trial_ends_at'     => 'datetime'
        // 'username'  => TitleCast::class
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function userName(): string
    {
        return $this->username;
    }

    public function emailAddress(): string
    {
        return $this->email;
    }

    public function bioWriter(): string
    {
        return $this->writer->bio();
    }

    public function bioWriterExcerpt($limit = 80): string
    {
        return Str::limit($this->bioWriter(), $limit);
    }

    public function facebook()
    {
        return $this->writer->facebook();
    }

    public function twitter()
    {
        return $this->writer->twitter();
    }

    public function instagram()
    {
        return $this->writer->instagram();
    }

    public function linkedin()
    {
        return $this->writer->linkedin();
    }

    public function type(): int
    {
        return (int) $this->type;
    }

    public function createdAt(): string
    {
        return $this->created_at;
    }


    public function createdAtDate(): string
    {
        return $this->created_at->format('d F Y');
    }

    public function isAdmin(): bool
    {
        return $this->type() === self::ADMIN;
    }

    public function isSuperAdmin(): bool
    {
        return $this->type() === self::SUPERADMIN;
    }

    public function isAgent(): bool
    {
        return $this->type() === self::AGENT;
    }

    public function isWriter(): bool
    {
        return $this->type() === self::WRITER;
    }

    public function isVendor(): bool
    {
        return $this->type() === self::VENDOR;
    }

    public function isDefault(): bool
    {
        return $this->type() === self::DEFAULT;
    }

     // Profile Relations
     public function writer(): HasOne
     {
         return $this->hasOne(Writer::class, 'user_id');
     }

     public function joinedDate()
     {
         return $this->created_at->format('d/m/Y');
     }

    public function vendor(): HasOne
    {
        return $this->hasOne(Vendor::class, 'user_id');
    }

    public function agent(): HasOne
    {
        return $this->hasOne(Agent::class, 'user_id');
    }

    public function billingAddress(): HasOne
    {
        return $this->hasOne(BillingAddress::class, 'user_id');
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function($query) use ($term) {
            $query->where('name', 'like', $term)
                    ->orWhere('email', 'like', $term);
        });
    }

    public function threads()
    {
        return $this->threadsRelation;
    }

    public function latestThreads(int $amount = 5)
    {
        return $this->threadsRelation()->latest()->limit($amount)->get();
    }

    public function deleteThreads()
    {
        foreach ($this->threads() as $thread) {
            $thread->delete();
        }
    }

    public function threadsRelation(): HasMany
    {
        return $this->hasMany(Thread::class, 'author_id');
    }

    public function countThreads(): int
    {
        return $this->threadsRelation()->count();
    }

    public function getRouteKeyName()
    {
        return 'username';
    }

    // protected static function booted()
    // {
    //     static::updated(queueable(function ($customer) {
    //         $customer->syncStripeCustomerDetails();
    //     }));
    // }

    public function paystackAddress()
    {
        return [
            'line1'         => $this->lineOne(),
            'line2'         => $this->lineTwo(),
            'city'          => $this->city(),
            'state'         => $this->state(),
            'country'       => $this->country(),
            'postal_code'   => $this->postalCode(),
        ];
    }
}
