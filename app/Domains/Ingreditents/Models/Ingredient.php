<?php

namespace App\Domains\Ingreditents\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Ingredient extends Model
{
    use HasFactory;
    public function stockable(): MorphTo
    {
        return $this->morphTo();
    }
}
