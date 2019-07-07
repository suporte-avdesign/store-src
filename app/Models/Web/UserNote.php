<?php

namespace AVD\Models\Web;

use Illuminate\Database\Eloquent\Model;

class UserNote extends Model
{
    protected $fillable = [
        'user_id',
        'admin',
        'label',
        'description'
    ];
}
