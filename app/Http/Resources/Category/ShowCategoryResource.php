<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\Product\IndexResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowCategoryResource extends JsonResource
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
            'name'=>$this->name,
            'image_url'=>'public/img/categories/' . $this->image,
            'products'=>IndexResource::collection($this->products),
            'created_at'=>$this->created_at
        ];
    }
}
