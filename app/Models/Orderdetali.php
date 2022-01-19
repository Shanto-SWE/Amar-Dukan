<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use\App\Models\Shop;
use\App\Models\Product;

class Orderdetali extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['order_id','product_id','shop_id','product_name','quantity','weight','single_price','subtotal_price','item_status'];
    public function shop(){
        return $this->belongsTo(Shop::class,'shop_id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
