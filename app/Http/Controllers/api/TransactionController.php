<?php

namespace App\Http\Controllers\api;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ValidationTransaction;
use App\Transaction;
use App\Exports\TransactionsReport;

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
        return Excel::download(new TransactionsReport($request),'reports.xlsx');
    }
    public function findSearch(Request $request ){
         $parametros=[];
         $search=[];
        if($request->parking_lot_id !=null || $request->parking_lot_id !=''){
          $parametros[]=['parking_lot_id','=',$request->parking_lot_id];
         }
        if($request->vehicle_id !=null || $request->vehicle_id !=''){
            $parametros[]=['vehicle_id','=',$request->vehicle_id];
           }
        if($request->client_id !=null || $request->client_id !=''){
             $parametros[]=['client_id','=',$request->client_id];
        }
        if($request->date_start!=null || $request->date_start !=''){
            $parametros[]=['date_start','=',$request->date_start];
           }
        if($request->date_stop !=null || $request->date_stop !=''){
            $parametros[]=['date_stop','=',$request->date_stop];
        }
        if($request->type!='' || $request->type!=null){
           $type=$request->type;
           $search=Transaction::with(['vehicle'=>function($query)use($type){
              $query->where('type_vehicle',$type); 
           }])
           ->with('parkingLot','client','tariff','bill')
           ->where($parametros)->get(); 
           //var_dump($search); 
        }else{
            $search=Transaction::with('parkingLot','client','tariff','vehicle','bill')->where($parametros)->get();  
        }
        if(count($search)==0){
            return response()->json([
                'status'=>'ok',
                'message'=>'No se encontraron resultados',
                'data'=>$search
            ]);
        }
        else{
            return response()->json([
                'status'=>'ok',
                'message'=>'se encontraron'.count($search). ' resultados',
                'data'=>$search
            ]); 
        }
    }
          
}

