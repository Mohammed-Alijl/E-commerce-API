<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ShippingTypeResource extends JsonResource
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
            'shippingType_id'=>$this->id,
            'title'=>$this->title,
            'price'=>$this->price,
            'min_arrival_days'=>$this->minNumberDaysToArrival,
            'max_arrival_days'=>$this->maxNumberDaysToArrival
        ];
    }
}
