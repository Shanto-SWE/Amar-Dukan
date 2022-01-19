<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use\Maatwebsite\Excel\Concerns\WithHeadings;
use\App\Models\Shop;

class shopExport implements WithHeadings, FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
                   // for return selected columns
     $userData=Shop::select('id','shop_name','shop_owner_name','shop_owner_email','shop_city','shop_area','district_name','shop_phone','open_time','close_time','status','registration_date')->orderBy('id','Desc')->get();

     return $userData;
    }
    public function headings(): array{
        return['Id','Shop Name','Shop Owner Name','Owner Email','Shop City','Shop Area','District Name','Owner Phone','Open Time','Close Time','Status',' Registration Date'];
    }
}
