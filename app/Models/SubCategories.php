<?php

namespace App\Models;
use\App\Models\Categories;
use\App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [ 'Subcategory_name', 'Subcat_slug','category_id','shop_id','subcat_logo'];

    public function category() {
	    return $this->belongsTo(Categories::class);
    }
    public function shop() {
	    return $this->belongsTo(Shop::class);
    }
}
