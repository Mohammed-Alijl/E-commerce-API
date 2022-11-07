<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\Product\IndexResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image_url' => asset('img/categories/' . $this->image),
            'products' => $this->products()->paginate(config('constants.CUSTOMER_PAGINATION')),
            'created_at' => $this->created_at
        ];
    }
}
