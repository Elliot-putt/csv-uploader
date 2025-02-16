<?php

namespace App\Modules\Homeowner\Enums;

enum NameConnector: string
{
    case AND = ' and ';
    case AMPERSAND = ' & ';

    public static function pattern(): string
    {
        return '/' . implode('|', array_map(fn($case) =>
            preg_quote($case->value, '/'),
                self::cases()
            )) . '/';
    }

    public static function values(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }

    public static function hasConnector(string $string): bool
    {
        return str_contains($string, self::AND->value) ||
            str_contains($string, self::AMPERSAND->value);
    }
}
