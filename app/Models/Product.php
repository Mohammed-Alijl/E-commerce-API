<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=['name','category_id','price','description','quantity'];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function images(){
        return $this->hasMany(Image::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class,'likes');
    }
    public function colors(){
        return $this->hasMany(Color::class);
    }
    public function sizes(){
        return $this->hasMany(Size::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function cartItems(){
        return $this->hasMany(CartItem::class);
    }
}
