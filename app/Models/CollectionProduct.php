<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionProduct extends Model
{
    use HasFactory;
    protected $table = 'collection_products';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];
}
