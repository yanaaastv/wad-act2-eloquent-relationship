<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerProfile extends Model
{
    protected $fillable = ['customer_id', 'address', 'contact_number', 'birthdate', 'driver_license_number'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
