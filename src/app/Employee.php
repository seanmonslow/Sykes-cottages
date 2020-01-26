<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
	protected $primaryKey = '__pk';

    protected $table = 'employee';

    public function department()
    {
        return $this->belongsTo('App\Department', '_fk_department');
    }
}
