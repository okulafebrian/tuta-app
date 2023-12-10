<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use IntlDateFormatter;

class Shipping extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'shippings';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];
    protected $appends = ['formatted_send_end_time', 'formatted_etd_time'];
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
            return 'COBATUTA-000002';
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

    public function getFormattedEtdTimeAttribute()
    {
        $etd = $this->etd;

        $shipped_at = $this->order->shipped_at;
        
        if ($shipped_at) {
            [$etd1, $etd2] = array_map('intval', explode('-', $etd));

            $estDeliveryDate1 = Carbon::parse($shipped_at)->addDays($etd1);
            $estDeliveryDate2 = Carbon::parse($shipped_at)->addDays($etd2);

            if ($estDeliveryDate1->month === $estDeliveryDate2->month && $estDeliveryDate1->year === $estDeliveryDate2->year) {
                return $estDeliveryDate1->translatedFormat('j') . ' - ' . $estDeliveryDate2->translatedFormat('j M Y');
            } elseif ($estDeliveryDate1->year === $estDeliveryDate2->year) {
                return $estDeliveryDate1->translatedFormat('j M') . ' - ' . $estDeliveryDate2->translatedFormat('j M Y');
            } else {
                return $estDeliveryDate1->translatedFormat('j M Y') . ' - ' . $estDeliveryDate2->translatedFormat('j M Y');
            }
        }
    }
}
