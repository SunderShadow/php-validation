<?php

namespace Sander\Validation\Exceptions;

use Exception;

class UndefinedRule extends Exception
{
    public function __construct(string $ruleName, int $code = 500, ?\Throwable $previous = null)
    {
        parent::__construct("Undefined rule $ruleName", $code, $previous);
    }
}