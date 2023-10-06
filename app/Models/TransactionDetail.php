<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionDetail extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'transaction_details';
    
    protected $primaryKey = 'id';
    
    protected $timestamp = true;
    
    protected $guarded = [];

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }
    
    public function shoe(): BelongsTo
    {
        return $this->belongsTo(Shoe::class);
    }
    
    public function getTransaction()
    {
        return $this->transaction;
    }
    
    public function getShoe()
    {
        return $this->shoe;
    }
}
