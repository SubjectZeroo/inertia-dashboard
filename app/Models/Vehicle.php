<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id', 'vehicle_model_id', 'unit', 'serial', 'price'
    ];

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

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function vehicle_model()
    {
        return $this->belongsTo(VehicleModel::class);
    }
}
