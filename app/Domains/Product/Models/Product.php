<?php

namespace App\Domains\Product\Models;

use App\Domains\Ingredients\Models\Ingredient;
use App\Domains\Stock\Contracts\Stockable;
use App\Domains\Stock\Models\Stock;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model implements Stockable
{
    use HasFactory, SoftDeletes, Translatable;

    public $translationModel = ProductTranslation::class;
    public $translatedAttributes = [
        'name',
        'notification_sent'

    ];
    protected $table = 'products';
    protected $fillable = [
        'price'
    ];

    public function stock(): MorphOne
    {
        return $this->morphOne(Stock::class, 'stockable');
    }

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class, 'ingredients_products', 'product_id', 'ingredient_id')
            ->withTimestamps()
            ->withPivot([
                'quantity_required', 'unit_measure']);
    }
}
