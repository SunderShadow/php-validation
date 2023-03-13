<?php

namespace Test\Rules;

use Sander\Validation\Contracts\IRule;

class StringRule implements IRule
{
    public function check(mixed $data): bool
    {
        return is_string($data);
    }

    public function getMessage(string $keyName): string
    {
        return "$keyName must be type string";
    }
}