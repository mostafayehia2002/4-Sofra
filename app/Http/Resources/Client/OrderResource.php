<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $productArray = [];

        // Assuming $this->products is a collection
        foreach ($this->products as $product) {
            $productArray[] = [
                'name' => $product->name,
                'price' => $product->pivot['price'],
                'quantity' => $product->pivot['quantity'],
                'note' => $product->pivot['notes'],
            ];
        };
        return [
            'id'=>$this->id,
            'cost'=>$this->cost,
            'delivary_cost'=>$this->delivary_cost,
            'total_cost'=>$this->total_cost,
            'status'=>$this->status,
            'address'=>$this->address,
            'commission'=>$this->commission,
            'confirm'=>$this->confirm,
            'note'=>$this->note,
            'products'=> $productArray,


        ];
    }
}
