<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingType extends Model
{
    use HasFactory;
    protected $fillable = ['title','price','minNumberDaysToArrival','maxNumberDaysToArrival'];

    public function order(){
        return $this->hasMany(Order::class,'shippingType_id');
    }
}
