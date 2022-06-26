<?php

namespace App\Http\Resources;

use App\Models\ImageProduct;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'inventory' => $this->inventory,
            'main_image' => $this->main_image,
            'price' => $this->price()->first()->price,
            'images' => ImageProductResource::collection($this->whenLoaded('images')),
            'attributes' => json_decode($this->attributes),
        ];
    }
}
