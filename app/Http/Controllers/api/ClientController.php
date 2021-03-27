<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients=Client::with('vehicles.parkingLot')->orderBy('created_at','ASC')->get();
        return response()->json(
            [ 'status'=>'ok',
              'message'=>'', 
              'data'=>$clients
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
           Client::create($request->all());
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
    public function options(){
        $options=Client::select('id','name')->get();
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
        $client=Client::find($id);
        if(!$client){
            return response()->json(
                [ 'status'=>'error',
                  'message'=>'cliente no existe!', 
                  'data'=>''
                ]
            );
        }
        try {
            $client->update($request->all());
            return response()->json(
                [ 'status'=>'ok',
                  'message'=>'actualizado exitosamente', 
                  'data'=>''
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                ['status'=>'error',
                'message'=>'error al actualizar', 
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
        $client=Client::find($id);
        if(!$client){
            return response()->json(
                [ 'status'=>'error',
                  'message'=>'cliente no existe!', 
                  'data'=>''
                ]
            );
        }
        try {
            $client->delete();
            return response()->json(
                [ 'status'=>'ok',
                  'message'=>'eliminado', 
                  'data'=>''
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                ['status'=>'error',
                'message'=>'error al eliminar', 
                 'data'=>$e
                ]
            );
            //throw $th;
        }
    }
}