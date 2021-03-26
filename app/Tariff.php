<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    protected $fillable = [
        'value_minute','value_hour','name','discount','condition','type_vehicle'
    ];
}
