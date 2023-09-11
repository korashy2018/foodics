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
        $unitOfMeasure = (!$this->is_countable) ? $this->unit_measure : 'pieces';
        return [
            'quantity' => $this->quantity,
            'unit_measure' => $unitOfMeasure
        ];
    }
}
