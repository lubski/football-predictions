<?php


namespace App\Validator\Constraints;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use App\Entity\Prediction;

class PredictionValidator extends ConstraintValidator
{
    public const POSSIBLE_PREDICTIONS = ['1x2', 'correct_score'];

    /**
     * @var Prediction $prediction
     */
    private Prediction $prediction;

    /**
     * @var Constraint $constraint
     */
    private Constraint $constraint;
    private PossibleValues $possibleValues;

    public function __construct(PossibleValues $possibleValues)
    {
        $this->possibleValues = $possibleValues;
    }


    /**
     * @param Prediction $prediction
     * @param Constraint $constraint
     */
    public function validate($prediction, Constraint $constraint)
    {
        $this->prediction = $prediction;
        $this->constraint = $constraint;
        if(in_array($this->prediction->getMarketType(), $this->possibleValues->getPossibleValues(MarketTypeInterface::class))) {

            if($this->prediction->getMarketType() == MarketTypeInterface::ONEXTWO) {
                return $this->validateThreeWayResult();
            } else if($this->prediction->getMarketType() == MarketTypeInterface::CORRECT_SCORE) {
                return $this->validateCorrectScore();
            }
        }

        return false;
    }

    private function validateThreeWayResult() {
        if(!in_array($this->prediction->getPrediction(), PredictionTypeInterface::ONEXTWO)) {
            $this->makeViolation(implode(",", PredictionTypeInterface::ONEXTWO));
            return false;
        }
        return true;
    }

    private function validateCorrectScore() {
        if(!preg_match('/^(?:\d+|\d*:\d+)$/', $this->prediction->getPrediction())) {
            $this->makeViolation("number:number");
            return false;
        }

        return true;
    }

    private function makeViolation (string $possibleValues) {
        $this->context->buildViolation($this->constraint->message)
            ->setParameter("{{ string }}", $this->prediction->getPrediction())
            ->setParameter("{{ possible_values }}", $possibleValues)
            ->setParameter("{{ market_type }}", $this->prediction->getMarketType())
            ->setCode(Response::HTTP_BAD_REQUEST)
            ->addViolation();
    }
}