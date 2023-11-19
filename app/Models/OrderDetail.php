<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'order_details';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
    
    public function shoe(): BelongsTo
    {
        return $this->belongsTo(Shoe::class);
    }
    
    public function getOrder()
    {
        return $this->order;
    }
    
    public function getShoe()
    {
        return $this->shoe;
    }
}
