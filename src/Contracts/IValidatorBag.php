<?php

namespace Sander\Validation\Contracts;

interface IValidatorBag
{
    public function addRule(string $name, IRule $rule);

    public function getRule(string $name): IRule;
}