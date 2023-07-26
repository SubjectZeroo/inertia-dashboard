<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('unit', 'like', '%' . $search . '%')
                ->orWhere('serial', 'like', '%' . $search . '%')
                ->orWhere('price', 'like', '%' . $search . '%');
            });
        });
    }
}
