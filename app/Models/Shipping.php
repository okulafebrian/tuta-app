<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipping extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'shippings';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];
    protected $appends = ['formatted_send_end_time'];
    protected $casts = [
        'send_start_time' => 'datetime',
        'send_end_time' => 'datetime',
    ];

    public static function generateCode()
    {
        $lastShipping = static::orderBy('created_at', 'desc')->first();
        
        if ($lastShipping) {
            $parts = explode('-', $lastShipping->code);
            $queueNumber = (int) end($parts) + 1;

            $queueNumber = str_pad($queueNumber, 6, '0', STR_PAD_LEFT);

            return 'TUTA-' . $queueNumber;
        } else {
            return 'TUTA-000001';
        }
    }

    public function getFormattedSendEndTimeAttribute()
    {
        $sendEndTime  = $this->send_end_time;

        return $sendEndTime->format('d-m-Y');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
