<?php

namespace App\Http\Controllers\Api;

use App\Domains\Order\Models\Order;
use App\Http\Requests\Orders\StoreOrderRequest;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Middleware;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;


#[Prefix('orders')]
#[Middleware(['auth:sanctum'])]
class OrderController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     */

    #[Get('/', name: 'orders.index')]
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    #[Post('/', name: 'orders.store')]
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    #[Get('/{order}', name: 'orders.show')]
    public function show(Order $order)
    {
        //
    }


}
