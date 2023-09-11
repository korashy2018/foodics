<?php

namespace App\Http\Controllers\Api;

use App\Domains\Product\Models\Product;
use App\Http\Requests\Products\StoreProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Http\Resources\Products\ProductCollectionResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Middleware;
use Spatie\RouteAttributes\Attributes\Resource;
use Throwable;

#[Resource(resource: 'products', apiResource: true)]
#[Middleware('auth:sanctum')]
class ProductController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     */
    #[Get(uri: '/', name: 'index')]
    public function index(): JsonResponse
    {
        try {
            $products = Product::all();
            return $this->sendResponse(new ProductCollectionResource($products), '');
        } catch (Throwable $exception) {
            Log::error('error creating the product ', [
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'message' => $exception->getMessage(),
                'Trace' => $exception->getTrace()
            ]);
            return $this->sendError(error: $exception->getMessage(), code: 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
