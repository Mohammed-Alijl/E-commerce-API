<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $fillable=['product_id','size'];
    public $timestamps = false;
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function order(){
        return $this->hasOne(Order::class);
    }
    public function cartItems(){
        return $this->hasMany(CartItem::class);
    }

}
