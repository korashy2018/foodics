<?php

namespace App\Domains\Stock\Actions;

use App\Domains\Stock\Contracts\Stockable;

class CheckStockQuantityBelowHalfAction
{
    public function __invoke(Stockable $stockable): bool
    {
        $stock = $stockable->stock->quantity;

        $allWithdrawnQuantity = $stockable->stock->transactions->where('is_addition', false)->sum('quantity');
        $currentStock = $stock - $allWithdrawnQuantity;
        return $currentStock < $stock / 2;
    }
}
