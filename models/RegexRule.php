<?php


class RegexRule
{
    private $regex;

    private $replacement;

    protected static function prepareRegex($regex)
    {
        return '/^.*' . $regex . '.*$/i';
    }

    /**
     * @return string
     */
    public function getReplacement()
    {
        return $this->replacement;
    }

    /**
     * @param string $replacement
     */
    public function setReplacement($replacement)
    {
        $this->replacement = $replacement;
    }

    /**
     * @return string
     */
    public function getRegex()
    {
        return $this->regex;
    }

    /**
     * @param string $regex
     */
    public function setRegex($regex)
    {
        $this->regex = static::prepareRegex($regex);
    }

    public function replace($string)
    {
        return preg_filter($this->regex, $this->replacement, $string);
    }
}