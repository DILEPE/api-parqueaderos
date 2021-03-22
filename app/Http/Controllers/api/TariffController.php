<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Tariff;
class TariffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tariff=Tariff::orderBy('created_at','ASC')->get();
        return response()->json(
            [ 'status'=>'ok',
              'message'=>'', 
              'data'=>$tariff

            ]
        );
        
    }
     public function options($type){
         $options=Tariff::select('id','name')->where('type_vehicle',$type)->get();
         $optionsData=[];
         foreach($options as $option){
          $optionsData[]=['text'=>$option->name,'value'=>$option->id];  
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
            Tariff::create($request->all());
            return response()->json(
                [ 'status'=>'ok',
                  'message'=>' tarifa guardada exitosamente', 
                  'data'=>''
                ]
            );
         } catch (\Exception $e) {
             //dd($e);
            return response()->json(
                ['status'=>'error',
                'message'=>'error al guardar tarifa', 
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
        $tariff=Tariff::find($id);
        if(!$tariff){
            return response()->json(
                [ 'status'=>'error',
                  'message'=>'tarifa no existe!', 
                  'data'=>''
                ]
            );
        }
        try {
            $tariff->update($request->all());
            return response()->json(
                [ 'status'=>'ok',
                  'message'=>' tarifa actualizado exitosamente', 
                  'data'=>''
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                ['status'=>'error',
                'message'=>'error al actualizar la tarifa', 
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
        $tariff=Tariff::find($id);
        if(!$tariff){
            return response()->json(
                [ 'status'=>'error',
                  'message'=>'tarifa no existe!', 
                  'data'=>''
                ]
            );
        }
        try {
            $tariff->delete();
            return response()->json(
                [ 'status'=>'ok',
                  'message'=>'tarifa eliminado', 
                  'data'=>''
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                ['status'=>'error',
                'message'=>'error al eliminar tarifa ', 
                 'data'=>$e
                ]
            );
            //throw $th;
        }
    }
    
}
