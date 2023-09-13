<?php

namespace App\Http\Resources\Stocks;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $allWithDrawnStock = $this->transactions->where('is_addition', false)->sum('quantity') ?? 0;
        $unitOfMeasure = (!$this->is_countable) ? $this->unit_measure : 'pieces';
        return [
            'available_stock' => $this->quantity - $allWithDrawnStock,
            'unit_measure' => $unitOfMeasure
        ];
    }
}
