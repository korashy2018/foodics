<?php

namespace App\Domains\Stock\Enums;

enum StockableUnitOfMeasureEnums: string
{
    case litres = 'L';
    case grams = 'gm';
    case pieces = 'piece(s)';

}
