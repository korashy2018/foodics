<?php

namespace App\Domains\Order\Actions;

use App\Domains\Order\DTO\OrderProductData;
use App\Domains\Order\Models\Order;
use App\Domains\Product\Models\Product;

class CreateOrderItemAction
{
    public function __invoke(Order $order, OrderProductData $orderProductData): void
    {

        $product = Product::find($orderProductData->id);
        $order->items()->create([
            'item_id' => $product->id,
            'price' => $product->price,
            'quantity_ordered' => $orderProductData->quantity,
            'item_name' => $product->name
        ]);
        (new UpdateIngredientStockAction())($product, $orderProductData->quantity);

    }
}
