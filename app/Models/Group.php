<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    /** @use HasFactory<\Database\Factories\GroupFactory> */
    use HasFactory;

    protected $fillable = ['id_parent', 'name'];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'id_group');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Group::class, 'id_parent');
    }
}
