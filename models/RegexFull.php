<?php


/**
 * Выражение, действуюшее на всю строку
 */
class RegexFull extends RegexRule
{
    protected static function prepareRegex($regex)
    {
        return '/^' . $regex . '$/i';
    }
}