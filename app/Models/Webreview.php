<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Webreview extends Model
{
    protected $guarded = [];
    use HasFactory;
    protected $fillable = [ 'user_id', 'name','review','rating','review_date','religion'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
