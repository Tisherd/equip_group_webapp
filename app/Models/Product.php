<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $with = ['price'];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'id_group');
    }

    public function price(): HasOne
    {
        return $this->hasOne(Price::class, 'id_product');
    }
}
