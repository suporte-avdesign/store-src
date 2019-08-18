<?php

namespace AVD\Models\Web;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $fillable = [
        'name',
        'email',
        'profile',
        'type',
        'city',
        'state',
        'zip_code',
        'latitude',
        'longitude',
        'day',
        'month',
        'active',
        'token',
        'confirmed'
    ];
}
