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
            'vehicle_id'=>'required|integer',
            'parking_lot_id'=>'required|integer',
            'tariff_id'=>'required|integer'

        ];
    }
    public function mesages(){
        return[
            'time_start.required'=>'fecha de inicio es requerida',
            'time_start.date_format'=>'hora de inicio debe tener formato HH:MM',
            'vehicle_id.required'=>'el vehiculo debe ser obligatorio',
            'vehicle_id.integer'=>'la opcion seleccionada no es valida',
            'parking_lot_id.required'=>'la posicion del parqueadero es requerida',
            'parking_lot_id.integer'=>'la posicion selecionada no es valida',
            'tariff_id.required'=>'la tarifa es requerida',
            'tariff_id.required'=>'la tarifa seleccionada no es valida'


        ];
    }
}
