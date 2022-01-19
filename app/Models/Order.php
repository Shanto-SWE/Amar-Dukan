<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['customer_id','shop_name','c_name','c_email','c_city','c_area','c_address','c_phone','c_extra_phone','subtotal','total','coupon_code','coupon_discount','after_discount','payment_type','tax','shipping_cost','order_id','status','date','cancel_date','shipped_date','month','year'];

    public function user(){
        return $this->belongsTo(User::class,'customer_id');
    }

}
