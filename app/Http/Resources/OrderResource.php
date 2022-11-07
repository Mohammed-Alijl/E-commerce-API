<?php

namespace App\Http\Resources;

use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use App\Models\ShippingType;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $product = Product::find($this->product_id);
        if (auth('dashboard')->user()->tokenCan('dashboard'))
            return [
                'order_id' => $this->id,
                'products_id' => $this->product_id,
                'products_name' => $product->name,
                'address' => $this->address->title,
                'date' => Carbon::parse($this->created_at)->format('d/m/Y'),
                'price' => $this->quantity * $product->price,
                'status' => $this->status_id
            ];
        elseif (!empty($this->size_id)) {
            $shippingType = ShippingType::find($this->shippingType_id);
            return [
                'order_id' => $this->id,
                'product_id' => $this->product_id,
                'products_name' => $product->name,
                'color' => Color::find($this->color_id)->color,
                'size' => Size::find($this->size_id)->size,
                'image_url' => asset('img/products/' . Image::where('product_id', $this->product_id)->first()->image),
                'address' => $this->address->title,
                'shipping_type' => $shippingType->title,
                'product_price' => $product->price,
                'quantity' => $this->quantity,
                'status' => $this->status_id,
                'min_arrival_days' => Carbon::parse($this->created_at)->addDays($shippingType->minNumberDaysArrivalDays)->format('d/m/Y'),
                'max_arrival_days' => Carbon::parse($this->created_at)->addDays($shippingType->maxNumberDaysArrivalDays)->format('d/m/Y'),
            ];
        } else {
            $shippingType = ShippingType::find($this->shippingType_id);
            return [
                'order_id' => $this->id,
                'product_id' => $this->product_id,
                'products_name' => $product->name,
                'color' => Color::find($this->color_id)->color,
                'image_url' => asset('img/products/' . Image::where('product_id', $this->product_id)->first()->image),
                'address' => $this->address->title,
                'shipping_type' => $shippingType->title,
                'product_price' => $product->price,
                'quantity' => $this->quantity,
                'status' => $this->status_id,
                'min_arrival_date' => Carbon::parse($this->created_at)->addDays($shippingType->minNumberDaysToArrival)->format('d/m/Y'),
                'max_arrival_date' => Carbon::parse($this->created_at)->addDays($shippingType->maxNumberDaysToArrival)->format('d/m/Y')
            ];
        }

    }
}
