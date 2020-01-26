<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceBand extends Model
{
    //
    protected $table = 'price_bands';

    protected $primaryKey = '__pk';

    public function property()
    {
        return $this->belongsTo('App\Property', '_fk_property');
    }
}
