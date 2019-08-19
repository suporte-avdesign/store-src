<?php

namespace AVD\Models\Web;

use Illuminate\Database\Eloquent\Model;

class ContactSpam extends Model
{
    /**
     *
     * @param array $attributes
     * @return $this
     */
    public function fill(array $attributes)
    {
        !isset($attributes['email']) ?: $attributes['email'] = strtolower($attributes['email']);

        return parent::fill($attributes);
    }
}
