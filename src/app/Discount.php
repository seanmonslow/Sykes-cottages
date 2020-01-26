<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    //
    protected $primaryKey = '__pk';

    protected $table = 'discounts';

    public function property()
    {
        return $this->belongsTo('App\Property', '_fk_property');
    }
}
