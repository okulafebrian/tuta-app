<?php

namespace App\Models;

use App\Traits\MustVerifyPhone;
use App\Interfaces\MustVerifyPhone as IMustVerifyPhone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements IMustVerifyPhone
{
    use HasApiTokens, HasFactory, Notifiable;
    use MustVerifyPhone;

    protected $fillable = [
        'role_id',
        'name',
        'phone_number',
        'email',
        'password',
        'phone_last_attempt_date',
        'phone_verify_code_sent_at',
        'phone_verified_at',
        'phone_last_update_date'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'phone_verify_code_sent_at' => 'datetime',
        'phone_last_attempt_date' => 'datetime',
        'phone_last_update_date' => 'datetime',
        'password' => 'hashed',
    ];

    public function userPhoneVerified()
    {
        return ! is_null($this->phone_verified_at);
    }

    public function phoneVerifiedAt()
    {
        return $this->forceFill([
            'phone_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
    
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function mainAddress()
    {
        return $this->hasOne(Address::class)->where('is_main', 1);
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }
}
