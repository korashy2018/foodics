<?php

namespace App\Http\Controllers\Api;

use App\Domains\Ingredients\Actions\CreateIngredientAction;
use App\Domains\Ingredients\Actions\DeleteIngredientAction;
use App\Domains\Ingredients\Actions\UpdateIngredientAction;
use App\Domains\Ingredients\Actions\UpdateIngredientStockAction;
use App\Domains\Ingredients\DTO\IngredientData;
use App\Domains\Ingredients\DTO\IngredientUpdateStockData;
use App\Domains\Ingredients\Models\Ingredient;
use App\Http\Resources\Ingredients\IngredientCollectionResource;
use App\Http\Resources\Ingredients\IngredientResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Spatie\RouteAttributes\Attributes\Middleware;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Resource;
use Throwable;


#[Prefix('{lang}')]
#[Resource(resource: 'ingredients', apiResource: true)]
#[Middleware(['auth:sanctum', 'Locale'])]
class IngredientController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $ingredients = Ingredient::with('stock')->orderBy('id', 'ASC')->paginate(5);
            return $this->sendResponse(new IngredientCollectionResource($ingredients), '');
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
     * Store a newly created resource in storage.
     */
    public function store(IngredientData $dto, CreateIngredientAction $createIngredientAction): JsonResponse
    {
        try {
            $ingredient = $createIngredientAction($dto);
            return $this->sendResponse(new IngredientResource($ingredient), 'Created Successfully', 201);
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
    public function show(Ingredient $ingredient): JsonResponse
    {
        try {
            return $this->sendResponse(new IngredientResource($ingredient), '');
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
    public function update(IngredientData $dto, UpdateIngredientAction $updateIngredientAction, Ingredient $ingredient): JsonResponse
    {
        try {
            $ingredient = $updateIngredientAction($dto, $ingredient);
            return $this->sendResponse(new IngredientResource($ingredient), 'Updated Successfully');
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
    public function destroy(Ingredient $ingredient, DeleteIngredientAction $deleteIngredientAction): JsonResponse
    {
        try {
            if ($deleteIngredientAction($ingredient)) return $this->sendResponse([], 'Deleted Successfully');
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

    #[Put(uri: '/ingredients/{ingredient}/updateStock', name: 'updateStock')]
    public function updateStock(Ingredient $ingredient, UpdateIngredientStockAction $updateIngredientStockAction, IngredientUpdateStockData $dto): JsonResponse
    {
        try {
            $ingredient = $updateIngredientStockAction($dto, $ingredient);
            return $this->sendResponse(new IngredientResource($ingredient), 'Updated Successfully');
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
