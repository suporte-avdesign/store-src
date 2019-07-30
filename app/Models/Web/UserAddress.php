<?php

namespace AVD\Models\Web;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $fillable = [
        'user_id',
        'delivery',
        'invoice',
        'address',
        'number',
        'complement',
        'district',
        'city',
        'state',
        'zip_code'
    ];
}
