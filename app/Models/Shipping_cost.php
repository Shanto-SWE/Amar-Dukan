<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use\App\Models\District;
class Shipping_cost extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = ['district_id','shipping_cost','date','status'];

    public function district(){
        return $this->belongsTo(District::class,'district_id');
    }

}
