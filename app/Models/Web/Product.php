<?php

namespace AVD\Models\Web;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Prices
     * @return array
     **/
    public function prices()
    {
        return $this->hasMany(ProductPrice::class);
    }

    /**
     * Images
     * @return array
     **/
    public function images()
    {
        return $this->hasMany(ImageColor::class);
    }


    /**
     * Category
     * @return array
     **/
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Section
     * @return array
     **/
    public function section()
    {
        return $this->belongsTo(Section::class);
    }




}
