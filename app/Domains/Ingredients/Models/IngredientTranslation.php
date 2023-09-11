<?php

namespace App\Domains\Ingredients\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
