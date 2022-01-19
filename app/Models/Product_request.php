<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use\App\Models\Shop;
use\App\Models\User;

class Product_request extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['shop_id','customer_id','product_name','product_origin','product_weight','product_quantity','product_description','product_photo','name','email','phone','city','delivery_area','delivery_address','delivery_date','request_id','total_price','subtotal_price','shipping_cost','status','item_status','date','month','year'];

    public function shop(){
        return $this->belongsTo(Shop::class,'shop_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'customer_id');
    }

}
