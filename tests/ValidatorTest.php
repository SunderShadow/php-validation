<?php

use Sander\Validation\Contracts\IValidatorBag;

class ValidatorTest extends \PHPUnit\Framework\TestCase
{
    protected IValidatorBag $bag;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        $this->registerValidatorBag();
        parent::__construct($name, $data, $dataName);
    }

    private function registerValidatorBag()
    {
        $this->bag = new \Sander\Validation\ValidatorBag();
        $this->bag->addRule('string', new \Test\Rules\StringRule());
    }

    // Tests
    public function test_validation()
    {
        $validator = new \Sander\Validation\Validator($this->bag, [
            'key1' => 'string'
        ]);

        try {
            $validator->validate([
                'key1' => 'true'
            ]);
            $this->assertTrue(true);
        } catch (\Sander\Validation\Exceptions\ValidationException) {
            $this->fail();
        }
    }

    public function test_undefined_rule()
    {
        $validator = new \Sander\Validation\Validator($this->bag, [
            'key1' => 'someUndefinedRule'
        ]);

        try {
            $validator->validate([
                'key1' => 'true'
            ]);
            $this->fail();
        } catch (\Sander\Validation\Exceptions\UndefinedRule) {
            $this->assertTrue(true);
            return;
        }
    }

    public function test_undefined_data_key()
    {
        $validator = new \Sander\Validation\Validator($this->bag, [
            'someUndefinedKey' => 'string'
        ]);

        try {
            $validator->validate([
                'key1' => 'true'
            ]);
            $this->fail();
        } catch (\Sander\Validation\Exceptions\UndefinedDataKey) {
            $this->assertTrue(true);
            return;
        }
    }
}