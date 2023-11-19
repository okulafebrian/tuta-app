<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    
    const PAYMENT_PENDING = 0;
    const PAYMENT_SUCCESS = 1;
    const ORDER_CANCELED = 2;
    const ORDER_ACCEPTED = 3;
    const ORDER_SHIPPED = 4;
    const ORDER_COMPLETED = 5;
    
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];
    protected $appends = ['formatted_created_at', 'formatted_expired_at', 'expiredDueTime'];
    protected $casts = [
        'accepted_at' => 'datetime',
        'paid_at' => 'datetime',
        'shipped_at' => 'datetime',
        'completed_at' => 'datetime',
        'expired_at' => 'datetime',
        'canceled_at' => 'datetime',
    ];

    public static function orderID()
    {
        $lastOrder = static::orderBy('created_at', 'desc')->first();
        
        if ($lastOrder) {
            $parts = explode('-', $lastOrder->code);
            $queueNumber = (int) end($parts) + 1;

            return 'TT-' . $queueNumber;
        } else {
            return 'TT-100000';
        }
    }

    public function getFormattedCreatedAtAttribute()
    {
        $now = now();
        $createdAt  = $this->created_at;

        if ($createdAt->isToday()) {
            return 'Hari ini ' . $createdAt->format('H:i');
        } elseif ($createdAt->isYesterday()) {
            return 'Kemarin ' . $createdAt->format('H:i');
        } elseif ($createdAt->year === $now->year) {
            return $createdAt->format('d M H:i');
        } else {
            return $createdAt->format('d/m/y H:i');
        }
    }

    public function getFormattedExpiredAtAttribute()
    {
        $now = now();
        $expiredAt  = $this->expired_at;
        
        if ($expiredAt != null) {      
            if ($expiredAt->isToday()) {
                return 'Hari ini ' . $expiredAt->format('H:i');
            } elseif ($expiredAt->isYesterday()) {
                return 'Kemarin ' . $expiredAt->format('H:i');
            } elseif ($expiredAt->year === $now->year) {
                return $expiredAt->format('d M H:i');
            } else {
                return $expiredAt->format('d/m/y H:i');
            }
        }
    }

    public function getExpiredDueTimeAttribute()
    {
        $now = now();
        $expiredDueTime = Carbon::parse($this->created_at)->addHour();

        if ($expiredDueTime->isToday()) {
            return 'Hari ini ' . $expiredDueTime->format('H:i');
        } elseif ($expiredDueTime->isYesterday()) {
            return 'Kemarin ' . $expiredDueTime->format('H:i');
        } elseif ($expiredDueTime->year === $now->year) {
            return $expiredDueTime->format('d M H:i');
        } else {
            return $expiredDueTime->format('d/m/y H:i');
        }
    }

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }
    
    public function getOrderDetails()
    {
        return $this->orderDetails;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function zipCode(): BelongsTo
    {
        return $this->belongsTo(ZipCode::class);
    }

    public function shipping(): HasOne
    {
        return $this->hasOne(Shipping::class);
    }
}
