<?php

namespace App\Domains\Ingreditents\Models;

use App\Domains\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class IngredientTranslation extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ingredient_translations';
    protected $fillable = [
        'name',
        'ingredient_id',
        'locale'
    ];

}
