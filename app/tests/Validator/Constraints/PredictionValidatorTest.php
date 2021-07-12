<?php

namespace App\Tests\Validator\Constraints;

use App\Entity\Prediction;
use App\Tests\AbstractTesting;
use App\Validator\Constraints\PossibleValues;
use App\Validator\Constraints\PredictionValidator;
use Symfony\Component\Validator\Constraint;

class PredictionValidatorTest extends AbstractTesting
{
    private PossibleValues $possibleValues;
    private Constraint $constraint;
    private Prediction $prediction;

    protected function setUp(): void
    {
        $this->constraint = $this->getMockBuilder(Constraint::class)->getMock();
        $this->possibleValues = $this->createMock(PossibleValues::class);
        $this->prediction = $this->createMock(Prediction::class);
    }

    public function testValidateCorrectValueMarketTypeCorrectScore()
    {
        $this->possibleValues->method('getPossibleValues')->willReturn(['ONEXTWO' => '1x2', 'CORRECT_SCORE' => 'correct_score']);
        $this->prediction->expects($this->any())->method('getMarketType')->willReturn('correct_score');
        $this->prediction->method('getPrediction')->willReturn('2:1');
        $predictionValidator = new PredictionValidator($this->possibleValues);
        $this->assertEquals(true, $predictionValidator->validate($this->prediction, $this->constraint));
    }

    public function testValidateCorrectValueMarketTypeOneXTwo()
    {
        $this->possibleValues->method('getPossibleValues')->willReturn(['ONEXTWO' => '1x2', 'CORRECT_SCORE' => 'correct_score']);
        $this->prediction->expects($this->any())->method('getMarketType')->willReturn('1x2');
        $this->prediction->method('getPrediction')->willReturn('1');
        $predictionValidator = new PredictionValidator($this->possibleValues);
        $this->assertEquals(true, $predictionValidator->validate($this->prediction, $this->constraint));
    }

    public function testValidateWrongMarketType()
    {
        $this->possibleValues->method('getPossibleValues')->willReturn(['ONEXTWO' => '1x2', 'CORRECT_SCORE' => 'correct_score']);
        $this->prediction->expects($this->any())->method('getMarketType')->willReturn('aaaaa');
        $this->prediction->method('getPrediction')->willReturn('1');
        $predictionValidator = new PredictionValidator($this->possibleValues);
        $this->assertEquals(false, $predictionValidator->validate($this->prediction, $this->constraint));
    }
}
