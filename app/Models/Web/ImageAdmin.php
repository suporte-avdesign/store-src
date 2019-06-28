<?php

namespace AVD\Models\Web;

use Illuminate\Database\Eloquent\Model;

class ImageAdmin extends Model
{
    protected $fillable = [
        'admin_id',
        'image',
        'status'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
