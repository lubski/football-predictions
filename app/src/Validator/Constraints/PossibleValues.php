<?php


namespace App\Validator\Constraints;

use ReflectionClass;

class PossibleValues
{
    public function getPossibleValues(string $class): array {
        $reflection = new ReflectionClass($class);
        return $reflection->getConstants();
    }

    public function getPossibleValuesAsString(string $class)
    {
        return implode(", ", self::getPossibleValues($class));
    }
}