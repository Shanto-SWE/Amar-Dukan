<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use\Maatwebsite\Excel\Concerns\WithHeadings;
use\App\Models\Order;
use\App\Models\Orderdetali;

class orderExport implements WithHeadings, FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
           // for return selected columns
     $orderData=Order::select('id','order_id','customer_id','c_name','c_email','c_phone','c_city','c_area','c_address','subtotal','total','coupon_code','coupon_discount','after_discount','payment_type','shipping_cost','status','date')->orderBy('id','Desc')->get();

     foreach($orderData as $key=> $value){
         $orderitems=Orderdetali::select('product_name','quantity','weight','single_price','item_status')->where('order_id',$value->id)->get();

         $product_name="";
         $quantity="";
         $weight="";
         $single_price="";
         $item_status="";
               
         foreach($orderitems as $item){

            $product_name.=$item['product_name'].",";
            $quantity.=$item['quantity'].",";
            $weight.=$item['weight'].",";
            $single_price.=$item['single_price']." tk,";
            $item_status.=$item['item_status']."";
         }
         $orderData[$key]['product_name']=$product_name;
         $orderData[$key]['quantity']=$quantity;
         $orderData[$key]['weight']=$weight;
         $orderData[$key]['single_price']=$single_price;
         $orderData[$key]['item_status']=$item_status;
     }

     return $orderData;
    }
    public function headings(): array{
        return['Id','Order_id','Customer_id','Customer Name','Customer Email','Custome Phone','District','Area','Address','Subtotal','total','Coupon Code','Coupon Discount','After Discount','Payment Type','Shipping Cost','Status','Order Date','product_name','quantity','weight','single_price','item_status'];
    }
}
