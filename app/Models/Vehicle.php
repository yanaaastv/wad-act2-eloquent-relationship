<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vehicle extends Model
{
    protected $fillable = ['plate_number', 'customer_id', 'brand', 'model', 'year', 'color'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function policies(): BelongsToMany
    {
        return $this->belongsToMany(
            Policy::class,
            'policy_vehicle',
            'vehicle_id',
            'policy_id'
        );
    }
}
