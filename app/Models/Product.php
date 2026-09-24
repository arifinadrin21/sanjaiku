<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
    'category_id',
    'name',
    'slug',
    'description',
    'image',
    'status',
];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

   public function variants()
{
    return $this->hasMany(ProductVariant::class);
}
}