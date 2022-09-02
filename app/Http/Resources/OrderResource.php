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
        return [
            'id'=>$this->id,
            'products_name'=>Product::find($this->product_id)->name,
            'address'=>$this->address,
            'date'=>$this->created_at->isoFormat('d/mm/YYYY'),
            'price'=>$this->price,
            'status'=>$this->status

        ];
    }
}
