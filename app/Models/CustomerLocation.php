<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'state_id', 'name', 'phone', 'address', 'ubication'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        });
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
