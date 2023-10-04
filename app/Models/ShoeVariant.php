<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoeVariant extends Model
{
    use HasFactory;
    protected $table = 'shoe_variants';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];
}
