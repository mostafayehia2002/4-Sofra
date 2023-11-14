<?php

namespace App\Http\Resources\Restaurant;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'token'=>$this->api_token,
             'id'=>$this->id,
            'name' =>$this->name,
            'email'  =>$this->email,
            'phone'=>$this->phone,
            'whatsapp'=>$this->whatsapp,
            'regoin'=>$this->regoin_id,
            'minimum_order'=>$this->minimum_order,
            'delivary_cost'=>$this->delivary_cost,
            'image'=>asset('restaurant_image/profile/'.$this->image),
        ];
    }
}
