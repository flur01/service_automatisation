<?php

namespace App\Imports;

use App\Product;
use App\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{

    private $is_header = true;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(!$this->is_header && isset($row[1])){
            $dublicate_serial_number = Product::where('serial_number', $row[1])->first();
            
            if(!$dublicate_serial_number){
                Product::insert([
                    [
                        'shop_id' => Auth::user()->id,
                        'name' => $row[0],
                        'serial_number' => $row[1]
                    ]
                ]);

            }
        }
        $this->is_header = false;
        
    }
}
