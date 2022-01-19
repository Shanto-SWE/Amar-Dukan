<?php

namespace App\Models;
use App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = ['question_id','user_id','shop_id','product_id','answer','answer_date'];
    public function shop(){
        return $this->belongsTo(Shop::class,'shop_id');
    }
}
