<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory;
    protected $table = 'cities';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];

    public function districts(): HasMany
    {
        return $this->hasMany(District::class);
    }
}
