<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
    "time_start",
    "vehicle_id",
    "parking_lot_id",
    "tariff_id",
    "time_stop",
    "client_id",
    "bill_id",
    "date_start",
    "date_stop"
    ];
    public function parkingLot(){
        return $this->belongsTo(ParkingLot::class);
    }
    public function client(){
        return $this->belongsTo(Client::class);
    }
    public function tariff(){
        return $this->belongsTo(Tariff::class);
    }
    public function bill(){
        return $this->belongsTo(Bill::class);
    }   
    
    public function vehicle(){
        return $this->belongsTo(Vehicle::class); 
    }    

}