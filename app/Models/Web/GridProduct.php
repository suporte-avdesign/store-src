<?php

namespace AVD\Models\Web;

use Illuminate\Database\Eloquent\Model;

class GridProduct extends Model
{
    /**
     * Color
     * @return array
     **/
    public function color()
    {
        return $this->belongsTo(ImageColor::class, 'image_color_id');
    }
}
