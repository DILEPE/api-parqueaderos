<?php
namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
class TransactionsReport implements FromCollection,WithMapping,WithHeadings{
     use Exportable;
    protected $list;
     
    public function __construct($list){
        $this->list=$list;
    }
    public function collection(){
         return $this->list;
    }
    public function headings():array{
         return[
             'cliente',
             'tipo identificacion',
             'identificacion',
             'tipo de vehiculo',
             'placa vehiculo',
             'ubicacion',
             'hora de inicio',
             'fecha de inicio',
             'hora final',
             'fecha final',
             'numero factura',

         ];
    }
    public function map($list):array{
        $bill='';
        if($list['bill']['id']){
         $bill=$list['bill']['id'];
        }else{
            $bill='no generado';
        }
        return[
             $list['client']['name'],
             $list['client']['type_document'],
             $list['client']['document'],
             $list['vehicle']['type_vehicle'],
             $list['vehicle']['plate'],
             $list['parking_lot']['lote'],
             $list['time_start'],
             $list['date_start'],
             $list['time_stop'],
             $list['date_stop'],
             $bill,


        ];
      
    }
}