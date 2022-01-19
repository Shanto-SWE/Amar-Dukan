<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
 
    protected $guarded = [];
    use HasFactory;
    protected $fillable = [ 'FullName', 'email','phone','delivery_zone','delivery_area', 'delivery_address','occupation', 'gender','photo','password','registration_date'];
}
