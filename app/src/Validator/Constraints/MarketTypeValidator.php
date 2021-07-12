<?php


namespace App\Validator\Constraints;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use UnexpectedValueException;

class MarketTypeValidator extends ConstraintValidator
{
    private PossibleValues $possibleValues;

    public function __construct(PossibleValues $possibleValues)
    {
        $this->possibleValues = $possibleValues;
    }

    public function validate($value, Constraint $constraint)
    {

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedValueException("Unexpected Value, value must by string type");
        }

        if(!in_array($value, $this->possibleValues->getPossibleValues(MarketTypeInterface::class))) {
            $this->makeViolation($value, $constraint);
            return false;
        }

        return true;
    }

    public function makeViolation($value, $constraint) {

        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ string }}', $value)
            ->setParameter('{{ possible_values }}', $this->possibleValues->getPossibleValuesAsString(MarketTypeInterface::class))
            ->setCode(Response::HTTP_BAD_REQUEST)
            ->addViolation();

    }
}