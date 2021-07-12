<?php


namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Prediction extends Constraint
{
    public string $message = 'Prediction "{{ string }}" contains an illegal character: it can only contain values: {{ possible_values }} for market type {{ market_type }}';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}