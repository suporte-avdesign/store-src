<?php

namespace AVD\Models\Web;

use Illuminate\Database\Eloquent\Model;

class UserTransport extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'phone'
    ];
}
