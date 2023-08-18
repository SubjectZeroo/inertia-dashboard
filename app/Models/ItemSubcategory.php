<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ItemSubcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description','item_category_id'
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

    public function item_category()
    {
        return $this->belongsTo(ItemCategory::class);
    }
}
