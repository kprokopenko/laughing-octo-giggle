<?php


/**
 * Выражение, встречающееся в строке
 */
class RegexAnyPlace extends RegexRule
{
    protected static function prepareRegex($regex)
    {
        return '/^.*' . $regex . '.*$/i';
    }
}