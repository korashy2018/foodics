<?php

namespace App\Http\Controllers\Api;

use App\Domains\Order\Actions\PlaceOrderAction;
use App\Domains\Order\DTO\OrderData;
use App\Domains\Order\Models\Order;
use App\Http\Resources\Orders\OrderCollectionResource;
use App\Http\Resources\Orders\OrderResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Middleware;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Throwable;


#[Prefix('orders')]
#[Middleware(['auth:sanctum'])]
class OrderController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     */

    #[Get('/', name: 'orders.index')]
    public function index(): JsonResponse
    {
        try {
            $orders = Order::orderBy('id', 'ASC')->paginate($this->perPage);
            return $this->sendResponse(new OrderCollectionResource($orders), '');
        } catch (Throwable $exception) {
            Log::error('error listing  the Orders ', [
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
    #[Post('/', name: 'orders.store')]
    public function store(OrderData $dto, PlaceOrderAction $placeOrderAction,)
    {
        try {
            DB::beginTransaction();
            $order = $placeOrderAction($dto);
            DB::commit();
            return $this->sendResponse(new OrderResource($order), 'Created Successfully', 201);
        } catch (Throwable $exception) {
            DB::rollBack();
            Log::error('error creating the Order ', [
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
    #[Get('/{order}', name: 'orders.show')]
    public function show(Order $order): JsonResponse
    {
        try {
            return $this->sendResponse(new OrderResource($order), '');
        } catch (Throwable $exception) {
            Log::error('error listing the order ', [
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'message' => $exception->getMessage(),
                'Trace' => $exception->getTrace()
            ]);
            return $this->sendError(error: $exception->getMessage(), code: 500);
        }
    }


}
