<?php

namespace AVD\Models\Web;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    /**
     * Images
     * @return array
     **/
    public function images()
    {
        return $this->hasMany(ImageSection::class);
    }

    /**
     * Categories
     * @return array
     **/
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    /**
     * Products
     * @return array
     **/
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    //
}
