<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Services\GroupHierarchy;

class Group extends Model
{
    /** @use HasFactory<\Database\Factories\GroupFactory> */
    use HasFactory;

    protected $fillable = ['id_parent', 'name'];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'id_group');
    }

    public function children()
    {
        return $this->hasMany(Group::class, 'id_parent');
    }

    public function scopeWithHierarchy($query): array
    {
        $groups = $query->withCount('products')->get();
        $hierarchy = new GroupHierarchy($groups);
        return $hierarchy->getHierarchy();
    }
}
