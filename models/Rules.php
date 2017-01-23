<?php


/**
 * Список правил
 */
class Rules
{
    /**
     * @var RegexRule[]
     */
    private $rules = [];

    /**
     * Загрузка массива настроек
     * @param array $config массив настроек, где key - регулярное выражение, value - замена
     * @param string $ruleType название класса правила
     */
    public function loadConfig(array $config, $ruleType = 'RegexRule')
    {
        foreach ($config as $regex => $replacement) {
            /** @var RegexRule $rule */
            $rule = new $ruleType;

            $rule->setRegex($regex);
            $rule->setReplacement($replacement);
            $this->addRule($rule);
        }
    }

    public function addRule(RegexRule $rule)
    {
        $this->rules[] = $rule;
    }

    public function replace($string)
    {
        foreach ($this->rules as $rule) {
            $appliedString = $rule->replace($string);

            if (null !== $appliedString) {
                return $appliedString;
            }
        }

        return null;
    }
}