<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [ 'name', 'email','phone','password','position','role_admin', 'district','shop','category','product','shipping_cost', 'ticket','offer','order','pickup_point', 'currency','report_chart','report','setting','review','contact_message','role','subscriber','customer'];
}
