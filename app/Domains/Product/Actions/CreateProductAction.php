<?php

namespace App\Domains\Product\Actions;

use App\Domains\Product\DTO\ProductData;
use App\Domains\Product\Models\Product;

class CreateProductAction
{
    public function __invoke(ProductData $data): Product
    {
        $prepareToCreate = [
            'name:en' => $data->nameEn,
            'name:ar' => $data->nameAr,
            'price' => $data->price
        ];
        $product = Product::create($prepareToCreate);
        $prepareSyncData = [];
        foreach ($data->ingredients as $ingredient) {
            $prepareSyncData[$ingredient->id] = ['quantity_required' => $ingredient->quantity_required, 'unit_measure' => $ingredient->unit_measure];
        }

        $product->ingredients()->sync($prepareSyncData);
        return $product;

    }
}
