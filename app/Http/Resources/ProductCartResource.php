<?php

namespace App\Http\Resources;

use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductCartResource extends JsonResource
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
            'product_name'=>Product::find($this->product_id)->name,
            'color'=>Color::find($this->color_id)->color,
            'size'=>Size::find($this->size_id)->size,
            'quantity'=>$this->quantity,
        ];
    }
}
