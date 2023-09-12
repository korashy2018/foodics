<?php

namespace App\Domains\Stock\Actions;

use App\Domains\Stock\Contracts\Stockable;
use App\Domains\Stock\Notifications\StockableLevelNotification;

class SendNotificationToMerchant
{
    public function __invoke(Stockable $stockable): void
    {
        if (!$stockable->notification_sent) {
            (new StockableLevelNotification($stockable))->toMail(auth()->user());
            $stockable->notification_sent = true;
            $stockable->save();
        }
    }
}
