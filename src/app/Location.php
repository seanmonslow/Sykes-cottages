<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
	protected $primaryKey = '__pk';

    protected $table = 'locations';

    public function properties()
    {
        return $this->hasMany('App\Property', '_fk_location');
    }
}
