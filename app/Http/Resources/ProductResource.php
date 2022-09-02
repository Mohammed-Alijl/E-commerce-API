<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $images = Product::find($this->id)->images;
        $arrayImages = [];
        foreach ($images as $image){
            $arrayImages[] = 'img/products/' . $image->image;
        }
        return [
            'id'=>$this->id,
            'category_id'=>$this->category_id,
            'name'=>$this->name,
            'price'=>$this->price,
            'description'=>$this->description,
            'images'=>$arrayImages,
            'created_at'=>$this->created_at,
        ];
    }
}
