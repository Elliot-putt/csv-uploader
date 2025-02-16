<?php

namespace App\Modules\Homeowner\Enums;

use InvalidArgumentException;

enum Title: string
{
    case MR = 'Mr';
    case MRS = 'Mrs';
    case MS = 'Ms';
    case MISS = 'Miss';
    case DR = 'Dr';
    case PROF = 'Prof';
    case PROFESSOR = 'Professor';
    case MISTER = 'Mister';

    public static function fromString(string $title): self
    {
        return match (strtolower(trim($title))) {
            'mr', 'mister' => self::MR,
            'mrs' => self::MRS,
            'ms' => self::MS,
            'miss' => self::MISS,
            'dr' => self::DR,
            'prof', 'professor' => self::PROF,
            default => throw new InvalidArgumentException("Invalid title: {$title}")
        };
    }
}
