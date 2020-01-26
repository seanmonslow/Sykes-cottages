<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    protected $primaryKey = '__pk';

    protected $table = 'department';

    public function employees()
    {
        return $this->hasMany('App\Employee', '_fk_department');
    }
}
