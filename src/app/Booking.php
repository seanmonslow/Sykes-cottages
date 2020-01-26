<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    protected $primaryKey = '__pk';

    protected $table = 'bookings';

    public function property()
    {
        return $this->belongsTo('App\Location', '_fk_property');
    }
}
