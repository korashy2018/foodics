<?php


// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domains\Product\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_that_the_order_is_placed_correctly(): void
    {
        dump('========testing order placed successfully==========');
        $orderData = [
            "customer_id" => 1,
            "products" => [
                [
                    "id" => 1,
                    "quantity" => 10

                ],

            ]
        ];
        $response = $this->post('/api/v1/orders', $orderData, $this->getTokenHeaders());
        $response->assertStatus(201);
    }

    public function test_the_placing_order_withdraw_from_Stock(): void
    {
        dump('========testing stock withdraw after order placement successfully==========');

        $product = Product::find(1);
        $ingredient = $product->ingredients->first();
        $ingredientQuantityRequired = $ingredient->pivot->quantity_required;
        $productOrderedQuantity = 10;
        $orderedQuantityStockToCompare = $productOrderedQuantity * $ingredientQuantityRequired;
        $orderData = [
            "customer_id" => 1,
            "products" => [
                [
                    "id" => $product->id,
                    "quantity" => $productOrderedQuantity

                ],

            ]
        ];
        $response = $this->post('/api/v1/orders', $orderData, $this->getTokenHeaders());
        $ingredientStockAfterOrderPlaced = $ingredient->stock->transactions->where('is_addition', false)->sum('quantity');
        $this->assertEquals($orderedQuantityStockToCompare, $ingredientStockAfterOrderPlaced);
    }
}
