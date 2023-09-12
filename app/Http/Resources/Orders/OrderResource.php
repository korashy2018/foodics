<?php

namespace App\Http\Resources\Orders;

use App\Domains\Order\Enums\OrderStatusEnums;
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
        return [
            'id' => $this->id,
            'ordered_date' => $this->order_date->format('Y/m/d H:i:s'),
            'status' => OrderStatusEnums::tryFrom($this->status)->toString(),
            'customer_id' => $this->customer_id,
            'customer_name' => $this->customer->name,
            'items' => OrderItemResource::collection($this->items)
        ];
    }
}
