<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $fillable = ['color','product_id'];
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
