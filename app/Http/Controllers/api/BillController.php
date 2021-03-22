<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bill;
class BillController extends Controller

{
    public function store(Request $request)
    {
         $separar[1]=explode(':',$request->time_start);
         $separar[2]=explode(':',$request->time_stop);
   
         $total_minutos_trasncurridos[1] = ($separar[1][0]*60)+$separar[1][1];
         $total_minutos_trasncurridos[2] = ($separar[2][0]*60)+$separar[2][1];
         $total_minutos_trasncurridos = $total_minutos_trasncurridos[2]-$total_minutos_trasncurridos[1];
         if($total_minutos_trasncurridos>60){
           $horas=round($total_minutos_trasncurridos/60); 
           $minutos=$total_minutos_trasncurridos%60;
           $valorTarifa=($request->tariff['value_hour']*$horas)+($request->tariff['value_minute']*$minutos);
         }else{
            $valorTarifa=$request->tariff['value_minute']*$minutos;
         }
          if($total_minutos_trasncurridos>$request->tariff['condition']){
              $descuento=($valorTarifa*$request->tariff['discount'])/100;
              $valorTarifa=$valorTarifa-$descuento;
          }
          $datosFactura=[
            'client_id'=>$request->client_id,
            'vehicle_id'=>$request->vehicle_id,
            'value'=>$valorTarifa,
            'description'=>'Tiempo Total Transcurido:'.$total_minutos_trasncurridos.'\n Valor Horas:'.$horas.'\n minutos'.$minutos,
            'parking_lot_id'=>$request->parking_lot_id,

          ];
        try {
            $bill=Bill::create($datosFactura);
            return response()->json(
                [ 'status'=>'ok',
                  'message'=>' factura guardada exitosamente', 
                  'data'=>$bill->id
                ]
            );
         } catch (\Exception $e) {
             //dd($e);
            return response()->json(
                ['status'=>'error',
                'message'=>'error al guardar factura', 
                 'data'=>$e
                ]
            ); 
    }
}
public function list()
{
    $bill=bill::orderBy('created_at','ASC')->paginate(10);
    return response()->json(
        [ 'status'=>'ok',
          'message'=>'', 
          'data'=>$bill
        ]
    );

}
public function update(Request $request, $id)
    {
        $bill=bill::find($id);
        if(!$bill){
            return response()->json(
                [ 'status'=>'error',
                  'message'=>'factura no existe!', 
                  'data'=>''
                ]
            );
        }
        try {
            $bill->update($request->all());
            return response()->json(
                [ 'status'=>'ok',
                  'message'=>' factura actualizado exitosamente', 
                  'data'=>''
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                ['status'=>'error',
                'message'=>'error al actualizar factura', 
                 'data'=>$e
                ]
            );
        }
    }

}