<?php

namespace Sander\Validation\Exceptions;

class UndefinedDataKey extends ValidationException
{
    public function __construct(string $fieldName)
    {
        parent::__construct($fieldName, 'Undefined key name ' . $fieldName);
    }
}