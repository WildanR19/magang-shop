<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductStockLog extends Model
{
    protected $fillable = [
        'product_id',
        'change_type',
        'quantity_changed',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
