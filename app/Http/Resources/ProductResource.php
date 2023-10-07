<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            // 'name' => $this->getTranslations('name'),
            // 'description' => $this->getTranslations('description'),
            // 'text' => $this->getTranslations('text'),
            'name' => $this->name,
            'description' => $this->description,
            'text' => $this->text,
            'price' => $this->price,
            'category' =>new CategoryResource($this->category),
            'photo' =>  PhotoResource::collection($this->photos),
        ];
    }
}
