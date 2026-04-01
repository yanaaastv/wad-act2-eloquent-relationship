<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['plate_number', 'brand', 'model', 'year', 'color'])]

class Vehicle extends Model
{
    public function policies(): BelongsToMany {
        return $this->belongsToMany(Policy::class, 'policy_vehicle', 'vehicle_id', 'policy_id');
    }
}
