<?php

declare(strict_types=1);

namespace App\Providers;

use App\Domains\Ingreditents\Models\Ingredient;
use App\Domains\Product\Models\Product;
use App\Domains\Stock\Enums\StockableEnums;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class MorphToServiceProvider extends ServiceProvider
{
    /**
     * Boot method
     *
     * @return void
     */
    public function boot(): void
    {
        Relation::morphMap(
            [
                StockableEnums::Products->value => Product::class,
                StockableEnums::Ingredient->value => Ingredient::class,
            ]
        );
    }
}
