<?php

namespace App\Http\Resources;

use App\Models\ProductVariant;
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
            'title'=> $this->title,
            'description' => $this->description,
            'excerpt' => $this->excerpt,
            'slug' => $this->slug,
            'variants'=> ProductVariantResource::collection($this->variants)
        ];
    }
}
