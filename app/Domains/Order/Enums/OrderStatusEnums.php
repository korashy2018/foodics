<?php

namespace App\Domains\Order\Enums;

enum OrderStatusEnums: int
{
    case PLACED = 0;
    case PENDING = 1;
    case IN_PROGRESS = 3;
    case Done = 4;

    public function toString(): string
    {
        return match ($this) {
            self::PLACED => 'placed',
            self::PENDING => 'pending',
            self::IN_PROGRESS => 'in_progress',
            self::Done => 'done',

        };
    }
}
