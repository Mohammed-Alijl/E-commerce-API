<?php

namespace App\Http\Resources;

use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if(auth('dashboard')->check())
        return [
            'id'=>$this->id,
            'products_id'=>$this->product_id,
            'address'=>$this->address,
            'date'=>$this->created_at->isoFormat('d/mm/YYYY'),
            'price'=>$this->quantity * Product::find($this->product_id)->price,
            'status'=>$this->status
        ];
        else
            return [
                'order_id'=>$this->id,
                'product_id'=>$this->product_id,
                'products_name'=>Product::find($this->product_id)->name,
                'color'=>Color::find($this->color_id)->color,
                'size'=>Size::find($this->size_id)->size,
                'address'=>$this->address,
                'product_price'=>Product::find($this->product_id)->price,
                'status'=>$this->status
            ];
    }
}
