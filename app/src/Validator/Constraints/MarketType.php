<?php


namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class MarketType extends Constraint
{
    public string $message = 'Market Type "{{ string }}" contains an illegal character: it can only contain values: {{ possible_values }}';
}