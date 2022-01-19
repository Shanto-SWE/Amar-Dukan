<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use\App\Models\District;

class Shop extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [ 'shop_name','shop_owner_name','shop_owner_email','shop_owner_photo','shop_slug', 'shop_city','district_id','district_name','shop_area','shop_phone','shop_another_phone','shop_photo','open_time','close_time','status','registration_date','password'];

    public function district(){
        return $this->belongsTo(District::class,'district_id');
    }
}
