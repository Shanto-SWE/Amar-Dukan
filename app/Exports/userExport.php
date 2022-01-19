<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use\Maatwebsite\Excel\Concerns\WithHeadings;
use\App\Models\User;

class userExport implements WithHeadings, FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        // for return selected columns
     $userData=User::select('id','FullName','email','phone','delivery_zone','delivery_area','delivery_address','occupation','gender','registration_date')->orderBy('id','Desc')->get();

     return $userData;

    }

    public function headings(): array{
        return['Id','FullName','Email','Phone','Delivery_zone','Delivery_area','Delivery_address','Occupation','Gender','Registration On'];
    }
}
