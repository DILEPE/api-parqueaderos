<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
 {
     protected $fillable = [
         "client_id","vehicle_id","value","description","parking_lot_id","status",
    
     ];
     public function client(){
         return $this->belongsTo('App\Client');
     }
     public function vehicle(){
         return $this->belongsTo('App\Vehicle');
     }
     public function parkingLot(){
         return $this->belongsTo('App\ParkingLot');
     }
 }
