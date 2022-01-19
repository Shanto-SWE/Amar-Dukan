<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use\App\Models\Categories;
use\App\Models\SubCategories;
use\App\Models\childcategories;
use\App\Models\Brand;
use\App\Models\Pickup_point;
use\App\Models\Shop;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['category_id','subcategory_id','childcategory_id','brand_id','pickup_point_id','shop_id','name','quantity','slug','code','unit','tags','video','purchase_price','selling_price','discount_price','stock_quantity','shop_id','description','thumbnail','featured','status','product_slider','trendy_product','view_product','admin_id','campaign_product','campaign_id','date','month'];

    
    public function category(){
        return $this->belongsTo(Categories::class,'category_id');
    }

    public function subcategory(){
        return $this->belongsTo(SubCategories::class,'subcategory_id');
    }

    public function childcategory(){
        return $this->belongsTo(childcategories::class,'childcategory_id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function pickuppoint(){
        return $this->belongsTo(Pickup_point::class,'pickup_point_id');
    }
    public function shop(){
        return $this->belongsTo(Shop::class,'shop_id');
    }

}
