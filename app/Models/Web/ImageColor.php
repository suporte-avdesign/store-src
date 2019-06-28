<?php

namespace AVD\Models\Web;

use Illuminate\Database\Eloquent\Model;

class ImageColor extends Model
{
    /**
     * Grids Positions
     * @return array
     **/
    public function grids()
    {
        return $this->hasMany(GridProduct::class);
    }    /**
 * Images Positions
 * @return array
 **/
    public function positions()
    {
        return $this->hasMany(ImagePosition::class);
    }

    /**
     * Product
     * @return array
     **/
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
