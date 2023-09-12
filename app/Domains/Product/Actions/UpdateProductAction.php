<?php

namespace App\Domains\Product\Actions;

use App\Domains\Product\DTO\ProductData;
use App\Domains\Product\Models\Product;

class UpdateProductAction
{
    public function __invoke(ProductData $data, Product $product): Product
    {
        $prepareForUpdate = [
            'name:en' => $data->nameEn,
            'name:ar' => $data->nameAr,
            'price' => $data->price
        ];
        $product->update($prepareForUpdate);
        $prepareSyncData = [];
        foreach ($data->ingredients as $ingredient) {
            $prepareSyncData[$ingredient->id] = ['quantity_required' => $ingredient->quantity_required, 'unit_measure' => $ingredient->unit_measure];
        }

        $product->ingredients()->sync($prepareSyncData, false);
        return $product;

    }
}
