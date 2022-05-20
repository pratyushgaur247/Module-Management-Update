<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use App\Models\Contracts;
use App\Models\Product;

class TransactionExport implements FromCollection, WithHeadings{
    use Exportable;

    protected $allTransaction;
  
    public function __construct($allTransaction){
       $this->allTransaction = $allTransaction;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(){

        $array = [];
        foreach($this->allTransaction as $key => $transaction){
            if($transaction->unit == 1){
                $unit = 'kg';
            }else{
                $unit = 'pounds';
            }
            $arr_instrulist_excel[$key] = array(
                'S.NO'           => $key+1,
                'Transaction Id' =>  $transaction->id ?? '-',
                'Contract Id'    => $transaction->metadata['contract_id'] ?? '-',
                'Product Name'   => $transaction->metadata['product'] ?? '-',
                'Price'          => '$'.number_format(rtrim($transaction->amount,'00')).'.00',
                'Quantity'       => $transaction->metadata['quantity'].' '.$unit,
                /*'Description'   =>  $transaction['description'] ?? '-',*/
                'Status'        =>   $transaction['status'] ?? '-',
                'Created At'        =>   isset($transaction->created) && $transaction->created != '' ? gmdate("d-m-Y", $transaction->created )  : '-' ,
                'Available On'        =>  isset($transaction->available_on) && $transaction->available_on != '' ? gmdate("d-m-Y", $transaction->available_on )  : '-',
                'Nature of Transaction'        => 'Escrowed',
            );
        }
        return collect($arr_instrulist_excel);
    }

    public function headings(): array{
        return ['S.No', 'Transaction ID', 'Contract ID', 'Product Name', 'Price',  'Quantity', /* 'Description',*/ 'Status', 'Created At', 'Available On', 'Nature of Transaction'];
    }
}
