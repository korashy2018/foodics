<?php

namespace App\Http\Controllers\Api;

use App\Domains\Product\Actions\CreateProductAction;
use App\Domains\Product\Actions\DeleteProductAction;
use App\Domains\Product\Actions\UpdateProductAction;
use App\Domains\Product\DTO\ProductData;
use App\Domains\Product\Models\Product;
use App\Http\Resources\Products\ProductCollectionResource;
use App\Http\Resources\Products\ProductResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Spatie\RouteAttributes\Attributes\Middleware;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Resource;
use Throwable;

#[Prefix('{lang}')]
#[Resource(resource: 'products', apiResource: true)]
#[Middleware(['auth:sanctum', 'Locale'])]
class ProductController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            $products = Product::with('ingredients')->orderBy('id', 'ASC')->paginate(5);
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
    public function store(ProductData $dto, CreateProductAction $createProductAction): JsonResponse
    {
        try {
            $product = $createProductAction($dto);
            return $this->sendResponse(new ProductResource($product), 'Created Successfully', 201);
        } catch (Throwable $exception) {
            Log::error('error creating the ingredient ', [
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'message' => $exception->getMessage(),
                'Trace' => $exception->getTrace()
            ]);
            return $this->sendError(error: $exception->getMessage(), code: 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): JsonResponse
    {
        try {
            return $this->sendResponse(new ProductResource($product), 'Listed Successfully');
        } catch (Throwable $exception) {
            Log::error('error creating the ingredient ', [
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'message' => $exception->getMessage(),
                'Trace' => $exception->getTrace()
            ]);
            return $this->sendError(error: $exception->getMessage(), code: 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductData $dto, UpdateProductAction $updateProductAction, Product $product)
    {
        try {
            $product = $updateProductAction($dto, $product);
            return $this->sendResponse(new ProductResource($product), 'updated Successfully');
        } catch (Throwable $exception) {
            Log::error('error creating the ingredient ', [
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'message' => $exception->getMessage(),
                'Trace' => $exception->getTrace()
            ]);
            return $this->sendError(error: $exception->getMessage(), code: 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, DeleteProductAction $deleteProductAction)
    {
        try {
            if ($deleteProductAction($product)) return $this->sendResponse([], 'Deleted Successfully');
            return $this->sendError(error: 'error deleting resource', code: 500);
        } catch (Throwable $exception) {
            Log::error('error creating the ingredient ', [
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'message' => $exception->getMessage(),
                'Trace' => $exception->getTrace()
            ]);
            return $this->sendError(error: $exception->getMessage(), code: 500);
        }
    }
}
