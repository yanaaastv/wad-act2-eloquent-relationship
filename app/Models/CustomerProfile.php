<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'address', 'contact_number', 'birthdate', 'driver_license_number'])]

class CustomerProfile extends Model
{
    public function customer(): BelongsTo {
        return $this->belongsTo(Customer::class, 'user_id', 'user_id');
    }
}
