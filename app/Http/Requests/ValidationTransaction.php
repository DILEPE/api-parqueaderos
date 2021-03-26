<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationTransaction extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'time_start'=>'required|date_format:H:i',
            'time_stop'=>'date_formt:H:i|after:time_start',
            'vehicle_id'=>'required|integer',
            'parking_lot_id'=>'required|integer',
            'tariff_id'=>'required|integer',
            'date_start'=>'required|date',
            'date_stop'=>'date|after:date_start'


        ];
    }
    public function mesages(){
        return[
            'time_start.required'=>'fecha de inicio es requerida',
            'time_start.time'=>'hora de inicio debe tener formato HH:MM',
            'time_stop.time'=>'hora de inicio debe tener formato HH:MM',
            'time_stop.after'=>'hora final debe ser mayor a la hora de inicio',
            'vehicle_id.required'=>'el vehiculo debe ser obligatorio',
            'vehicle_id.integer'=>'la opcion seleccionada no es valida',
            'parking_lot_id.required'=>'la posicion del parqueadero es requerida',
            'parking_lot_id.integer'=>'la posicion selecionada no es valida',
            'tariff_id.required'=>'la tarifa es requerida',
            'tariff_id.required'=>'la tarifa seleccionada no es valida',
            'date_start.required'=>'fecha de inicio es requerida',
            'date_start.date_format'=>'fecha de inicio no tiene formato ',
            'date_stop.date_format'=>'fecha final no tiene formato',
            'date_stop.after'=>'fecha final debe ser mayor a la fecha de inicio',




        ];
    }
}
