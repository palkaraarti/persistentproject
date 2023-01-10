<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\RouterDetails;
use App\Models\ExcelUploadedData;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RouterDetailsImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row){
            ExcelUploadedData::create([
                'sapid' => $row['sapid'],
                'hostname' =>$row['hostname'],
                'loopback' =>$row['loopback'],
                'macaddress' =>$row['macaddress']
            ]);

        }
    }
}
