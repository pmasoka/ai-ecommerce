<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'description',
        'image',
        'position',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    // Parent Category
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Children Categories
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')
            ->where('status', 1)
            ->orderBy('position');
    }

    // Category Products
    public function products()
    {
        return $this->hasMany(Product::class)
            ->where('status', 1);
    }

    // Get All Child Category IDs Recursively
    public function getAllChildrenIds()
    {
        $ids = [];

        foreach ($this->children as $child) {
            $ids[] = $child->id;

            $ids = array_merge(
                $ids,
                $child->getAllChildrenIds()
            );
        }

        return $ids;
    }
}