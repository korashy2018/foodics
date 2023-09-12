<?php

namespace App\Domains\Stock\Actions;

use App\Domains\Stock\Contracts\Stockable;
use App\Domains\Stock\Notifications\StockableLevelNotification;
use Illuminate\Support\Facades\Mail;

class SendNotificationToMerchant
{
    public function __invoke(Stockable $stockable): void
    {
        if (!$stockable->notification_sent) {
            Mail::send(new StockableLevelNotification($stockable));
            $stockable->notification_sent = true;
            $stockable->save();
        }
    }
}
