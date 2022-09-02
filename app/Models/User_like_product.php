<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_like_product extends Model
{
    use HasFactory;
    protected $fillable=['user_id','product_id'];
    public $timestamps=false;

    public function product(){
        return $this->belongsTo(Product::class);
    }public function user(){
        return $this->belongsTo(User::class);
    }
}
