<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    protected $fillable = ['registration_id', 'type', 'full_address', 'state', 'district', 'pincode'];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}