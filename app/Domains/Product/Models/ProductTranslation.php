<?php

namespace App\Domains\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductTranslation extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product_translations';
    protected $fillable = [
        'name',
        'locale',
        'product_id'
    ];


}
