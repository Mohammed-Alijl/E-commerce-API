<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCart extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','color_id','size_id','cart_id','quantity'];
    public $timestamps = false;
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function color(){
        return $this->belongsTo(Color::class);
    }
    public function size(){
        return $this->belongsTo(Size::class);
    }
    public function cart(){
        return $this->belongsTo(Cart::class);
    }

}
