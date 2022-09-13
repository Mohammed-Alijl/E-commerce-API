<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email'=>$this->email,
            'phone'=>$this->phone,
            'nick_name'=>$this->nick_name,
            'date_of_birth'=>$this->date_of_birth,
            'image'=>'public/img/users/profile/' . $this->image,
            'address'=>$this->addresses
        ];
    }
}
