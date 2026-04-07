<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = [
        'product_id',
        'image',
        'position',
        'alt_text',
        'status',
    ];

    /**
     * Get the product that owns this image
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
