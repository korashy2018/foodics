<?php

namespace App\Domains\Ingredients\Models;

use App\Domains\Product\Models\Product;
use App\Domains\Stock\Contracts\Stockable;
use App\Domains\Stock\Models\Stock;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredient extends Model implements Stockable
{
    use HasFactory, SoftDeletes, Translatable;

    public $translationModel = IngredientTranslation::class;
    protected array $translatedAttributes = ['name'];

    protected $table = 'ingredients';
    protected $fillable = [
        'expiry_date',
        'notification_sent'
    ];


    public function stock()
    {
        return $this->morphOne(Stock::class, 'stockable');
    }

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'ingredients_products', 'ingredient_id', 'product_id')
            ->withTimestamps()
            ->withPivot([
                'quantity_required', 'unit_measure']);
    }
}
