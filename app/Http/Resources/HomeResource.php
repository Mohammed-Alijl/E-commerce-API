<?php

namespace App\Http\Resources;

use App\Models\Image;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeResource extends JsonResource
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
            'image'=> 'img/products/'. Image::where('id',$this->id)->first()->image,
            'name'=>$this->name,
            'price'=>$this->price
        ];
    }
}
