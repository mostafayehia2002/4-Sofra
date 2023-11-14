<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class ClientResource extends JsonResource
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
            'regoin'=>$this->regoin_id,
            'image'=>asset('client_image/profile/'.$this->image),
        ];
    }
}
