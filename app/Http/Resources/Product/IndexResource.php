<?php

namespace App\Http\Resources\Product;

use App\Models\Image;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'image'=> 'public/img/products/'. Image::where('id',$this->id)->first()->image,
            'name'=>$this->name,
            'price'=>$this->price
        ];
    }
}
