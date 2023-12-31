<?php

namespace App\Http\Resources\Products;

use App\Http\Resources\Ingredients\IngredientCollectionResource;
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
            'price' => $this->price,
            'name' => $this->name,
            'ingredients' => new IngredientCollectionResource($this->ingredients)
        ];
    }
}
