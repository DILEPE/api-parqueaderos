<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ValidationTransaction;
use App\Transaction;

class TransactionController extends Controller
{
    public function store(ValidationTransaction $request){
       try {
         Transaction::create($request->all());  
         return response()->json([
             'status'=>'ok',
              'message'=>'el registro se guardo exitosamente',
              
         ]);
       } catch (\Exception $e) {
            return response()->json([
                'status'=>'error',
                 'message'=>'error al guardar el registro',
                 'data'=>$e
            ]);
                 
       }      

    }
    public function list()
    {
        $transaction=Transaction::with('parkingLot','client','tariff','vehicle','bill')->orderBy('created_at','ASC')->get();
        return response()->json(
            [ 'status'=>'ok',
              'message'=>'', 
              'data'=>$transaction
            ]
        );
    } 
    public function update(Request $request, $id)
    {
        $transaction=Transaction::find($id);
        //dd($transaction);
        if(!$transaction){
            return response()->json(
                [ 'status'=>'error',
                  'message'=>'registro no existe!', 
                  'data'=>''
                ]
            );
        }
        try {
            $transaction->update($request->all());
            return response()->json(
                [ 'status'=>'ok',
                  'message'=>' registro actualizado exitosamente', 
                  'data'=>''
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                ['status'=>'error',
                'message'=>'error al actualizar el registro', 
                 'data'=>$e
                ]
            );
        }
    }
     public function exportReport( Request $request){
            $condiction=[];
    }
    public function findSearch(Request $request ){
         $parametros=[];
         if($request->parking_lot_id !=null || $request->parking_lot_id !=''){
          $parametros[]=['parking_lot_id','=',$request->parking_lot_id];
         }
         if($request->parking_lot_id !=null || $request->parking_lot_id !=''){
            $parametros[]=['parking_lot_id','=',$request->parking_lot_id];
           }
    }
          
}

