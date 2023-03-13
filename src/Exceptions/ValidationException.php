<?php

namespace Sander\Validation\Exceptions;

class ValidationException extends \Exception
{
    public function __construct(
        protected string $fieldName,
        string $message
    )
    {
        parent::__construct($message);
    }

    public function getFieldName(): string
    {
        return $this->fieldName;
    }
}