<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    
    const PAYMENT_PENDING = 1;
    const PAYMENT_SUCCESS = 2;
    const SHIPPING_ARRANGED = 3;
    const ORDER_SHIPPED = 4;
    const ORDER_COMPLETED = 5;
    const ORDER_CANCELLED = 6;
    const PAYMENT_EXPIRED = 7;
    
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];
    protected $appends = [
        'formatted_created_at',
        'formatted_expired_at',
        'formatted_cancelled_at',
        'expired_due_time',
    ];
    protected $casts = [
        'paid_at' => 'datetime',
        'shipped_at' => 'datetime',
        'completed_at' => 'datetime',
        'expired_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    public static function generateCode()
    {   
        $date = Carbon::now()->format('dmY');
        $queueNumber = 1;

        $lastTicket = static::where('code', 'like', "INV-$date-____")
            ->orderBy('created_at', 'desc')
            ->first();

        if ($lastTicket) {
            $parts = explode('-', $lastTicket->code);
            $queueNumber = (int) end($parts) + 1;
        }
        
        $queueNumber = str_pad($queueNumber, 4, '0', STR_PAD_LEFT);

        return "INV-$date-$queueNumber";
    }

    public function getFormattedCreatedAtAttribute()
    {
        $createdAt  = $this->created_at;

        if ($createdAt) {
            return $createdAt->translatedFormat('d M Y');
        }
    }

    public function getFormattedCancelledAtAttribute()
    {
        $cancelledAt  = $this->cancelled_at;

        if ($cancelledAt) {
            return $cancelledAt->translatedFormat('d M Y H:m');
        }
    }

    public function getExpiredDueTimeAttribute()
    {
        $expiredDueTime = Carbon::parse($this->created_at)->addHour();

        return $expiredDueTime->translatedFormat('d M Y H:i');
    }

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
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

    public function shippings(): HasMany
    {
        return $this->hasMany(Shipping::class);
    }

    public function latestShipping() {
        return $this->shippings()->latest('created_at')->first();
    }
}
