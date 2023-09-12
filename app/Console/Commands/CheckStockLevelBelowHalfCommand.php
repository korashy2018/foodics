<?php

namespace App\Console\Commands;

use App\Domains\Ingredients\Models\Ingredient;
use App\Domains\Stock\Actions\SendNotificationToMerchant;
use Illuminate\Console\Command;

class CheckStockLevelBelowHalfCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-stock-level-below-half';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check-stock-level-below-half';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $ingredients = Ingredient::where('notification_sent', false)->get();
        foreach ($ingredients as $ingredient) {
            $checkBelowHalf = (new SendNotificationToMerchant())($ingredient);
            if ($checkBelowHalf) {
                (new SendNotificationToMerchant())($ingredient);
            }
        }
    }
}
