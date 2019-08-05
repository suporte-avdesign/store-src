<?php

namespace AVD\Models\Web;

use Illuminate\Database\Eloquent\Model;

class OrderNote extends Model
{
    protected $fillable = [
        'order_id',
        'who',
        'name',
        'description'
    ];
}
