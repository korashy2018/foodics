<?php

namespace App\Http\Resources\Ingredients;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class IngredientCollectionResource extends ResourceCollection
{
    public $collects = IngredientResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->toArray();
    }
}

