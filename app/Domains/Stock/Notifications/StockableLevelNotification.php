<?php

namespace App\Domains\Stock\Notifications;

use App\Domains\Stock\Contracts\Stockable;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StockableLevelNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Stock Are below 50% ';

    /**
     * Create a new notification instance.
     */
    public function __construct(private Stockable $stockable)
    {
        //
    }

    public function build()
    {
        return $this->from('admin@foodics.com', 'Foodics')->to('merchant@foodics.com')->view('emails.stock_level')->with(['stockable' => $this->stockable]);

    }
}
