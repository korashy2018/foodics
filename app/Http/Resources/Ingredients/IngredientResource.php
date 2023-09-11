<?php

namespace App\Http\Resources\Ingredients;

use App\Http\Resources\Stocks\StockResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IngredientResource extends JsonResource
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
            'expiry_date' => $this->expiry_date,
            'name' => $this->name,
            'quantity_required' => $this->whenPivotLoaded('ingredients_products', function () {
                return $this->pivot->quantity_required;
            }),
            'stock_available' => new StockResource($this->whenLoaded('stock'))
        ];
    }
}
