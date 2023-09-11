<?php

namespace App\Domains\Product\Models;

use App\Domains\Ingredients\Models\Ingredient;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes, Translatable;

    public $translationModel = ProductTranslation::class;
    public $translatedAttributes = [
        'name'
    ];
    protected $table = 'products';
    protected $fillable = [
        'price'
    ];

    public function stockable(): MorphTo
    {
        return $this->morphTo();
    }

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class, 'ingredients_products', 'product_id', 'ingredient_id')
            ->withTimestamps()
            ->withPivot([
                'quantity_required']);
    }
}
