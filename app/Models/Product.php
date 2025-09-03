<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function solds()
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }
}