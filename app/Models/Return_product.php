<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Return_product extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['order_id','request_id','user_id','user_name','product_id','product_name','shop_name','return_reason','return_status','comment','date'];
}
