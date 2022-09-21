<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'color_id',
        'size_id',
        'address_id',
        'shippingType_id',
        'quantity',
        'status'
    ];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function color(){
        return $this->belongsTo(Color::class);
    }
    public function size(){
        return $this->belongsTo(Size::class);
    }
    public function address(){
        return $this->belongsTo(Address::class);
    }
    public function ShippingTypes(){
        return $this->belongsTo(ShippingType::class,'shippingType_id');
    }
}
