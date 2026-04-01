<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


#[Fillable(['name', 'email', 'password'])]

class Customer extends Model
{
    public function profile(): HasOne {
        return $this->hasOne(CustomerProfile::class, 'user_id', 'user_id');
    }

    public function policies(): HasMany {
        return $this->hasMany(Policy::class, 'user_id', 'user_id');
    }
}
