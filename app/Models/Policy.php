<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['user_id', 'policy_number', 'start_date', 'end_date', 'status'])]
class Policy extends Model
{

    public function customer(): BelongsTo {
        return $this->belongsTo(Customer::class, 'user_id', 'user_id');
    }

    public function vehicles(): BelongsToMany {
        return $this->belongsToMany(Vehicle::class, 'policy_vehicle', 'policy_id', 'vehicle_id');
    }
}
