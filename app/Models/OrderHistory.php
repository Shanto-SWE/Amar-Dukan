<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['order_id','request_id','order_status','reason','updated_by','time','delivery_man_name','delivery_man_phone'];
}
