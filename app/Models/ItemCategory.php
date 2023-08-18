<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class ItemCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        });
    }
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] =  Str::slug($value);
    }

    public function item_subcategories()
    {
        return $this->hasMany(ItemSubcategory::class);
    }
}
