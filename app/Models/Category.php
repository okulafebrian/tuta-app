<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{   
    use HasFactory;
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];

    public function shoes(): HasMany
    {
        return $this->hasMany(Shoe::class);
    }
}
