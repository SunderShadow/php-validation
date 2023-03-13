<?php

namespace Sander\Validation;

use Sander\Validation\Contracts\IRule;
use Sander\Validation\Contracts\IValidatorBag;
use Sander\Validation\Exceptions\UndefinedRule;

class ValidatorBag implements IValidatorBag
{
    /**
     * @var IRule[]
     */
    protected array $rules = [];

    public function addRule(string $name, IRule $rule): void
    {
        $this->rules[$name] = $rule;
    }

    /**
     * @throws UndefinedRule
     */
    public function getRule(string $name): IRule
    {
        if (!array_key_exists($name, $this->rules)) {
            throw new UndefinedRule($name);
        }

        return $this->rules[$name];
    }
}