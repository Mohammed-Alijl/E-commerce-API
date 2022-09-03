<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\Product\IndexResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowResource extends JsonResource
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
            'name'=>'public/img/categories/' . $this->name,
            'image'=>$this->image,
            'products'=>IndexResource::collection($this->products),
            'created_at'=>$this->created_at
        ];
    }
}
