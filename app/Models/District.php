<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class District extends Model
{
    use HasFactory;
    protected $table = 'districts';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];

    public function zipCodes(): HasMany
    {
        return $this->hasMany(ZipCode::class);
    }
}