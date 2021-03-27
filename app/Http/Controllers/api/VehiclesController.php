<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Vehicle;
class VehiclesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicle=vehicle::orderBy('created_at','ASC');
        return response()->json(
            [ 'status'=>'ok',
              'message'=>'', 
              'data'=>$vehicle
            ]
        );
    }
    public function options($type){
        $options=Vehicle::select('id','plate')->where('type_vehicle',$type)->get();
        $optionsData=[];
        foreach($options as $option){
         $optionsData[]=['text'=>$option->plate,'value'=>$option->id];  
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
            Vehicle::create($request->all());
            return response()->json(
                [ 'status'=>'ok',
                  'message'=>' vehiculo guardado exitosamente', 
                  'data'=>''
                ]
            );
         } catch (\Exception $e) {
             //dd($e);
            return response()->json(
                ['status'=>'error',
                'message'=>'error al guardar vehiculo', 
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
        $vehicle=Vehicle::find($id);
        if(!$vehicle){
            return response()->json(
                [ 'status'=>'error',
                  'message'=>'vehiculo no existe!', 
                  'data'=>''
                ]
            );
        }
        try {
            $vehicle->update($request->all());
            return response()->json(
                [ 'status'=>'ok',
                  'message'=>' vehiculo actualizado exitosamente', 
                  'data'=>''
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                ['status'=>'error',
                'message'=>'error al actualizar vehiculo', 
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
        $vehicle=Vehicle::find($id);
        if(!$vehicle){
            return response()->json(
                [ 'status'=>'error',
                  'message'=>'vehiculo no existe!', 
                  'data'=>''
                ]
            );
        }
        try {
            $vehicle->delete();
            return response()->json(
                [ 'status'=>'ok',
                  'message'=>'vehiculo eliminado', 
                  'data'=>''
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                ['status'=>'error',
                'message'=>'error al eliminar vehiculo ', 
                 'data'=>$e
                ]
            );
            //throw $th;
        }
    }
   
}
