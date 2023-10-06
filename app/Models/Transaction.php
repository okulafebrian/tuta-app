<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;
    
    const PENDING = 0;
    const SUCCESS = 1;
    const CANCELED = 2;
    const EXPIRED = 3;
    
    protected $table = 'transactions';
    protected $primaryKey = 'id';
    
    protected $timestamp = true;
    
    protected $guarded = [];

    public function transactionDetails(): HasMany
    {
        return $this->hasMany(TransactionDetail::class);
    }
    
    public function getTransactionDetails()
    {
        return $this->transactionDetails;
    }
}
