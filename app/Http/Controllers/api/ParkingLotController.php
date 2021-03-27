<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ParkingLot;
class ParkingLotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ParkingLots=ParkingLot::all()->groupBy('type_vehicle');
        return response()->json(
            [ 'status'=>'ok',
              'message'=>'', 
              'data'=>$ParkingLots
            ]
        );
    }
    public function options($type){
        $options=ParkingLot::select('id','lote')->where('status','libre')->where('type_vehicle',$type)->get();
        $optionsData=[];
        foreach($options as $option){
             $optionsData[]=['text'=>$option->lote,'value'=>$option->id];  
        }
        return response()->json(
            [
               'status'=>'ok',
               'message'=>'', 
               'data'=>$optionsData   
            ]
        );
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //dd($request->all());
        try {
            ParkingLot::create($request->all());
            return response()->json(
                [ 'status'=>'ok',
                  'message'=>'guardado exitosamente', 
                  'data'=>''
                ]
            );
         } catch (\Exception $e) {
             //dd($e);
            return response()->json(
                ['status'=>'error',
                'message'=>'error al guardar', 
                 'data'=>$e
                ]
            );   

        } 
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ParkingLot=ParkingLot::find($id);
        if(!$ParkingLot){
            return response()->json(
                [ 'status'=>'error',
                  'message'=>'ubicacion no existe!', 
                  'data'=>''
                ]
            );
        }
        try {
            $ParkingLot->update($request->all());
            return response()->json(
                [ 'status'=>'ok',
                  'message'=>' ubicacion actualizado exitosamente', 
                  'data'=>''
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                ['status'=>'error',
                'message'=>'error al actualizar la ubicacion', 
                 'data'=>$e
                ]
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ParkingLot=ParkingLot::find($id);
        if(!$ParkingLot){
            return response()->json(
                [ 'status'=>'error',
                  'message'=>'ubicacion no existe!', 
                  'data'=>''
                ]
            );
        }
        try {
            $ParkingLot->delete();
            return response()->json(
                [ 'status'=>'ok',
                  'message'=>'ubicacion eliminado', 
                  'data'=>''
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                ['status'=>'error',
                'message'=>'error al eliminar ubicacion ', 
                 'data'=>$e
                ]
            );
            //throw $th;
        }
    }
    public function changeStatus(Request $request,$id){
        $ParkingLot=ParkingLot::find($id);
        $request->merge(['status'=>'ocupado']);
         try {
             $ParkingLot->update($request->all());
             return response()->json(
                [ 'status'=>'ok',
                  'message'=>'vehiculo estacionado', 
                  'data'=>''
                ]
             );
         }catch (\Exception $e) {
             return response()->json(
                 [   'status'=>'error',
                  'message'=>'error al ocupar ubicacion ', 
                  'data'=>$e
                 ]
               );
            //throw $th;
         }
    }
    public function optionsSearch($type){
        $options=ParkingLot::select('id','lote')->where('type_vehicle',$type)->get();
        $optionsData=[];
        foreach($options as $option){
         $optionsData[]=['text'=>$option->lote,'value'=>$option->id];  
        }
        return response()->json(
            [
               'status'=>'ok',
               'message'=>'', 
               'data'=>$optionsData   
            ]
        );
    }
    public function changeFree($id){
        $ParkingLot=ParkingLot::find($id);
         try {
             $data=[
                'status'=>'libre',
                'vehicle_id'=>null
             ];
             $ParkingLot->update($data);
             return response()->json(
                [ 'status'=>'ok',
                  'message'=>'tiempo en la ubicacion cerrado', 
                  'data'=>''
                ]
             );
         }catch (\Exception $e) {
             return response()->json(
                 [   'status'=>'error',
                  'message'=>'error al cerrar ubicacion ', 
                  'data'=>$e
                 ]
               );
            //throw $th;
         }
    }
} 

