<?php


namespace App\Validator\Constraints;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use UnexpectedValueException;

class StatusValidator extends ConstraintValidator
{
    private PossibleValues $possibleValues;

    public function __construct(PossibleValues $possibleValues)
    {
        $this->possibleValues = $possibleValues;
    }

    /**
     * @inheritDoc
     */
    public function validate($value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedValueException("Unexpected Value, value must by string type");
        }

        if(!in_array($value, $this->possibleValues->getPossibleValues(StatusTypeInterface::class))) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->setParameter('{{ possible_values }}', $this->possibleValues->getPossibleValuesAsString(StatusTypeInterface::class))
                ->setCode(Response::HTTP_BAD_REQUEST)
                ->addViolation();
            return false;
        }

        return true;
    }
}