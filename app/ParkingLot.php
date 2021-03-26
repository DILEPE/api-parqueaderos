<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParkingLot extends Model
{
    protected $fillable = [
        'lote','type_vehicle','status','vehicle_id'

    ];
}
