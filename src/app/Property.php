<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    //
    protected $table = 'properties';

    protected $primaryKey = '__pk';

    public function location()
    {
        return $this->belongsTo('App\Location', '_fk_location');
    }

    public function priceBands(){
    	return $this->hasMany('App\PriceBand', '_fk_property');
    }

    public function bookings(){
    	return $this->hasMany('App\Booking', '_fk_property');
    }

    public function discounts(){
    	return $this->hasMany('App\Discount', '_fk_property');
    }

    public function calculatePrice($date){
    	$discount = $this->discounts()->where('start_date', '<=', $date)
                                                    ->where('end_date', '>=', $date)
                                                    ->first();

       $priceBand = $this->priceBands()->where('start_date', '<=', $date)
                                                    ->where('end_date', '>=', $date)
                                                    ->first();

       if($discount != null && $priceBand != null){
          $this->attributes["discount"] = $discount->percentage;
       		$this->attributes["price"] = $priceBand->price - (($discount->percentage/100) * $priceBand->price);
       } else if($priceBand != null){
       		$this->attributes["price"] = $priceBand->price;
       }
    }
}
