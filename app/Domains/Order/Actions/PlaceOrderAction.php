<?php

namespace App\Domains\Order\Actions;

use App\Domains\Order\DTO\OrderData;
use App\Domains\Order\Enums\OrderStatusEnums;
use App\Domains\Order\Models\Order;
use Carbon\Carbon;

class PlaceOrderAction
{


    public function __invoke(OrderData $data): Order
    {
        $prepareToCreate = [
            'customer_id' => $data->customer_id,
            'order_date' => $data->order_date ?? Carbon::now(),
            'current_status' => $data->current_status ?? OrderStatusEnums::PLACED
        ];

        $order = Order::create($prepareToCreate);
        $orderProducts = $data->products;
        foreach ($orderProducts as $orderProduct) {
            (new CreateOrderItemAction())($order, $orderProduct);
        }
        $order->statuses()->create([
            'status' => OrderStatusEnums::PLACED
        ]);


        return $order;

    }
}

Order::create(['customer_id' => 1, 'order_date' => '2023/12/15', 'current_status' => 0]);
