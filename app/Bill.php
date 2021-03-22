<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = [
    "client_id","vehicle_id","value","description","parking_lot_id",
    
    ];
}
