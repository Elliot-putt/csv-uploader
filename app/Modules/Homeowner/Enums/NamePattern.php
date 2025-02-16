<?php

namespace App\Modules\Homeowner\Enums;


enum NamePattern: string
{
    case INITIAL = '/^([A-Z])\.?$/';

    /**
     * Checks if a string is a single initial (e.g., "J" or "J.")
     */
    public static function isInitial(string $string): bool
    {
        return preg_match(self::INITIAL->value, $string) === 1;
    }

    /**
     * Extracts the initial from a string (e.g., "J." becomes "J")
     */
    public static function extractInitial(string $string): ?string
    {
        if (preg_match(self::INITIAL->value, $string, $matches)) {
            return $matches[1];
        }

        return null;
    }
}
