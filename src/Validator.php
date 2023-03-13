<?php

namespace Sander\Validation;

use Sander\Validation\Contracts\IRule;
use Sander\Validation\Contracts\IValidator;
use Sander\Validation\Contracts\IValidatorBag;
use Sander\Validation\Exceptions\UndefinedDataKey;
use Sander\Validation\Exceptions\ValidationException;

class Validator implements IValidator
{
    const RULE_SEPARATOR = ',';

    public function __construct(
        protected IValidatorBag $bag,
        protected array $rules = []
    )
    {
    }

    public function validate(array $data): void
    {
        foreach ($this->rules as $dataKey => $rules) {
            if (is_string($rules)) {
                $rules = $this->castRuleStringToArray($rules);
            }

            foreach ($rules as $rule) {
                if (is_string($rule)) {
                    $rule = $this->bag->getRule($rule);
                }

                if (!array_key_exists($dataKey, $data)) {
                    throw new UndefinedDataKey($dataKey);
                }

                if (!$rule->check($data[$dataKey])) {
                    throw new ValidationException($dataKey, $rule->getMessage($dataKey));
                }
            }
        }
    }

    /**
     * @return IRule[]
     */
    private function castRuleStringToArray(string $rules): array
    {
        return array_map(
            fn($it) => $this->bag->getRule($it),
            explode(self::RULE_SEPARATOR, $rules)
        );
    }
}