<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class, 'product_variants')->distinct();
    }

    public function sizes(): BelongsToMany
    {
        return $this->belongsToMany(Size::class, 'product_variants')->distinct();
    }

    public function mainPhotos()
    {
        $path = 'public/products/' . $this->code . '/main/';
        
        $files = Storage::allFiles($path);
        
        return empty($files) ? null : array_map('basename', $files);
    }

    public function variantPhotos()
    {
        return $this->variants()->distinct()->pluck('photo')->toArray();
    }

    public function getStockByColor($colorId)
    {
        return (int) $this->variants()->where('color_id', $colorId)->sum('stock');
    }

    public function getStockBySize($sizeId)
    {
        return (int) $this->variants()->where('size_id', $sizeId)->sum('stock');
    }

    public function getStock()
    {
        return (int) $this->variants()->sum('stock');
    }
}

