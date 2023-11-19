<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShoeVariant extends Model
{
    use HasFactory;
    protected $table = 'shoe_variants';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];

    public function shoe(): BelongsTo
    {
        return $this->belongsTo(Shoe::class);
    }

    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class);
    }

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }
}
