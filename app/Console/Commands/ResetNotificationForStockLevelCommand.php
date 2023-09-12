<?php

namespace App\Console\Commands;

use App\Domains\Ingredients\Models\Ingredient;
use App\Domains\Stock\Actions\CheckStockQuantityAboveHalfAction;
use Illuminate\Console\Command;

class ResetNotificationForStockLevelCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset-notification-for-stock-level';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $ingredients = Ingredient::where('notification_sent', true)->get();
        foreach ($ingredients as $ingredient) {
            $checkAboveHalf = (new CheckStockQuantityAboveHalfAction())($ingredient);
            if ($checkAboveHalf) {
                $ingredient->notification_sent = false;
                $ingredient->save();
            }
        }
    }
}
