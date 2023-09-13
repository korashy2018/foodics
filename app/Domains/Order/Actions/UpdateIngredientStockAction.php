<?php

namespace App\Domains\Order\Actions;

use App\Domains\Product\Models\Product;
use App\Domains\Stock\Actions\CheckStockQuantityBelowHalfAction;
use App\Domains\Stock\Actions\SendNotificationToMerchant;
use App\Domains\Stock\Enums\StockTransactionTypeEnums;

class UpdateIngredientStockAction
{
    public function __invoke(Product $product, $quantityOrdered): void
    {
        foreach ($product->ingredients as $ingredient) {
            $quantityToWithdraw = $ingredient->pivot->quantity_required * $quantityOrdered;
            //TODO to check stock level for each ingredient not below zero before updating the transaction and throw erro
            $ingredient->stock->transactions()->create([
                'type' => StockTransactionTypeEnums::WITHDRAW,
                'quantity' => $quantityToWithdraw,
                'is_addition' => false,
            ]);
            $checkIngredientStockBelowHalf = (new CheckStockQuantityBelowHalfAction())($ingredient);
            if ($checkIngredientStockBelowHalf) {
                (new SendNotificationToMerchant())($ingredient);
            }
        }
    }
}
