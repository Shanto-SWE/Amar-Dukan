<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [ 'shop_id','category_name', 'category_slug','category_logo','category_thumbnail','home_page'];
}
