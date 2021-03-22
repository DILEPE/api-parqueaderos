<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name', 'document', 'type_document',
    ];
    public function vehicles(){
        return $this->hasMany('App\Vehicle');
    }
}
