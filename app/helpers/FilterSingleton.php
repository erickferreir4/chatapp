<?php declare(strict_types=1);

namespace app\helpers;

class FilterSingleton
{
    public static function chars($value)
    {
        return filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public static function email($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}
