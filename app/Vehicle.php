<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'plate','type_vehicle','client_id'
    ];
    public function parkingLot(){
       return $this->hasOne('App\ParkingLot','vehicle_id');
    }
}
