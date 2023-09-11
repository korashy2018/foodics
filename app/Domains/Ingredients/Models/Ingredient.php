<?php

namespace App\Domains\Ingredients\Models;

use App\Domains\Product\Models\Product;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredient extends Model
{
    use HasFactory, SoftDeletes, Translatable;

    public $translationModel = IngredientTranslation::class;
    public $translatedAttributes = [
        'name'
    ];
    protected $table = 'ingredients';
    protected $fillable = [
        'expiry_date'
    ];

    /**
     * @return MorphTo
     */
    public function stockable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'ingredients_products', 'ingredient_id', 'product_id')
            ->withTimestamps()
            ->withPivot([
                'quantity_required']);
    }
}
