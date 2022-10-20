<?php

namespace App\Http\Resources\Product;

use App\Models\Image;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if (auth('dashboard')->check() && auth('dashboard')->user()->tokenCan('dashboard'))
            return [
                'id' => $this->id,
                'name' => $this->name,
                'image' => config('constants.URL') . '/public/img/products/' . Image::where('product_id', $this->id)->first()->image,
                'price' => $this->price,
                'colors' => $this->colors,
                'sizes' => $this->sizes,
                'quantity' => $this->quantity
            ];
        else
            return [
                'id' => $this->id,
                'name' => $this->name,
                'image' => config('constants.URL') . '/public/img/products/' . Image::where('product_id', $this->id)->first()->image,
                'price' => $this->price,
            ];
    }
}
