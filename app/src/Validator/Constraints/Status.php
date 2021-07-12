<?php

namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Status extends Constraint
{
    public string $message = 'Status "{{ string }}" contains an illegal character: it can only contain values: {{ possible_values }}';
}