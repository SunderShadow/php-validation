# PHP Validator
`composer require sander/validation`

[Packagist](https://packagist.org/packages/sander/validation)

[Github](https://github.com/SunderShadow/php-validation)

## How to use

```php
// 1. Create validator bag
$bag = new \Sander\Validation\ValidatorBag();

// 2. Add required rules to bag
// All rules must implement Sander\Validation\Contracts\IRule interface
$bag->addRule('eval', new class implements \Sander\Validation\Contracts\IRule {
    public function check(mixed $data) : bool
    {
        return is_int($data) && ($data % 2 === 0)
    }
    
    // If check fails rule returns message 
    public function getMessage(string $keyName) : string
    {
        return "$keyName must be int|eval";
    }
});

// 3. Create Validator with rules
/**
 * @param IValidatorBag $bag
 * @param string|IRule[] $rules
 */
$validator = new \Sander\Validation\Validator($bag, [
    'fieldName' => 'string',
    'alternativeField' => [new RuleName(), new OtherRule(), new ThirdPartyRule, 'with_string']
])

try {
    // 4. Validate
    $validator->validate();
} catch (\Sander\Validation\Exceptions\ValidationException $e) {
    SomeLogComponent::log($e->getMessage());
}
```

## Possible exceptions (namespace `Sander\Validation\Exceptions`)
### `UndefinedRule`
Throws when validator trying to get rule by its string definition but it is undefined

### `ValidationException`
Throws when array contains wrong data

### `UndefinedDataKey` implements `ValidationException`
Throws when rules key is undefined in data to validate