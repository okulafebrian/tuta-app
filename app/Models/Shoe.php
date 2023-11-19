<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class Shoe extends Model
{
    use HasFactory;
    protected $table = 'shoes';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];
    protected $appends = ['formatted_price', 'formatted_discount_price', 'total_stock'];

    public function getMainPhoto()
    {
        $path = 'public/shoes/' . $this->code . '/' . $this->photo . '/';
        $files = Storage::files($path);
        
        if (!empty($files)) {
            return basename($files[0]);
        }
        
        return null;
    }

    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getFormattedDiscountPriceAttribute()
    {
        return 'Rp ' . number_format($this->discount_price, 0, ',', '.');
    }

    public function shoeVariants(): HasMany
    {
        return $this->hasMany(ShoeVariant::class);
    }

    public function getTotalStockAttribute()
    {
        return $this->shoeVariants->sum('stock');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class, 'shoe_variants')->distinct();
    }

    public function sizes(): BelongsToMany
    {
        return $this->belongsToMany(Size::class, 'shoe_variants')->distinct();
    }

    public function variantPhotos()
    {
        return $this->shoeVariants()->select('color_id', 'photo')->distinct();
    }
}

