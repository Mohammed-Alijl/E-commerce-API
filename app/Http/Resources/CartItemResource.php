<?php

namespace App\Http\Resources;

use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $product = Product::find($this->product_id);
        return [
            'item_id'=>$this->id,
            'product_id'=>$this->product_id,
            'product_name'=>$product->name,
            'image_url'=>'public/img/products' . Image::where('product_id',$this->product_id)->first()->image,
            'product_price'=>$product->price,
            'color'=>Color::find($this->color_id),
            'size'=>Size::find($this->size_id),
            'quantity'=>$this->quantity,
            'total_price'=>$product->price * $this->quantity,
        ];
    }
}
