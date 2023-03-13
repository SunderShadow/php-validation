<?php
namespace Sander\Validation\Contracts;

use Sander\Validation\Exceptions\ValidationException;

interface IValidator
{
    /**
     * @param IValidatorBag $bag
     * @param string|IRule[] $rules
     */
    public function __construct(IValidatorBag $bag, array $rules = []);

    /**
     * @throws ValidationException
     * @return void
     *
     * Validate by rules
     */
    public function validate(array $data): void;
}