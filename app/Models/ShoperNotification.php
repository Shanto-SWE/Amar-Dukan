<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoperNotification extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['shop_id','data','url','status','seen','time'];
}
