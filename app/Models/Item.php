<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id', 'item_category_id', 'item_brand_id', 'code', 'name', 'description', 'price', 'cost'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('code', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('price', 'like', '%' . $search . '%')
                    ->orWhere('cost', 'like', '%' . $search . '%');
            });
        });
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function item_category()
    {
        return $this->belongsTo(ItemCategory::class);
    }

    public function item_brand()
    {
        return $this->belongsTo(ItemBrand::class);
    }
}
