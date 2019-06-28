<?php

namespace AVD\Models\Web;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Images
     * @return array
     **/
    public function images()
    {
        return $this->hasMany(ImageCategory::class);
    }
    /**
     * Products
     * @return array
     **/
    public function products()
    {
        return $this->hasMany(Product::class);
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


