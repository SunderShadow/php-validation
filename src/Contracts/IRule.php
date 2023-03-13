<?php

namespace Sander\Validation\Contracts;

interface IRule
{
    /**
     * Check is data follows current rule
     * @param mixed $data
     * @return bool
     */
    public function check(mixed $data): bool;

    /**
     * Message on failed check
     * @param string $keyName
     * @return string
     */
    public function getMessage(string $keyName): string;
}