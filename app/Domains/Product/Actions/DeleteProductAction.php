<?php

namespace App\Domains\Product\Actions;

use App\Domains\Product\Models\Product;

class DeleteProductAction
{
    public function __invoke(Product $product): bool
    {

        try {
            $product->delete();
            $product->ingredients()->sync([]);
            return true;
        } catch (\Throwable) {
            return false;
        }

    }
}
