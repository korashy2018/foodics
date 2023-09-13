<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Domains\Ingredients\Actions\CreateOrUpdateIngredientStockAction;
use App\Domains\Ingredients\DTO\IngredientUpdateStockData;
use App\Domains\Ingredients\Enums\IngredientUnitOfMeasureEnums;
use App\Domains\Ingredients\Models\Ingredient;
use App\Domains\Product\Models\Product;
use App\Domains\Stock\Models\Stock;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->truncateBeforeSeeding();
        $ingredientsData = [
            [
                "expiry_date" => "2023/10/17",
                "name:en" => "Beef",
                "name:ar" => "لحم",
            ],
            [
                "expiry_date" => "2024/11/17",
                "name:en" => "cheese",
                "name:ar" => "جبن",
            ],
            [
                "expiry_date" => "2024/11/17",
                "name:en" => "onion",
                "name:ar" => "بصل",
            ],
        ];
        $productData = [
            'name:en' => 'Burger',
            'name:ar' => 'برجر',
            'price' => "300"
        ];
        $product = Product::create($productData);

        foreach ($ingredientsData as $ingredient) {
            Ingredient::create($ingredient);
        }

        $ingredients = Ingredient::all();
        $ingredientsIds = $ingredients->pluck('id');

        $ingredientsStockData = IngredientUpdateStockData::from([
            "quantity" => rand(4000, 10000),
            "unit_measure" => "gm",

            "is_countable" => false

        ]);
        foreach ($ingredients as $ingredient) {
            (new CreateOrUpdateIngredientStockAction())($ingredientsStockData, $ingredient);
        }
        $prepareSyncData = [];
        foreach ($ingredientsIds as $ingredientId) {
            $prepareSyncData[$ingredientId] = ['quantity_required' => rand(50, 400), 'unit_measure' => IngredientUnitOfMeasureEnums::grams->value];
        }

        $product->ingredients()->sync($prepareSyncData);

    }

    private function truncateBeforeSeeding(): void
    {
        Ingredient::truncate();
        Product::truncate();
        Stock::truncate();
        DB::table('ingredients_products')->truncate();
    }
}
