<?php

namespace App\Tests\Validator\Constraints;

use App\Tests\AbstractTesting;
use App\Validator\Constraints\MarketTypeValidator;
use App\Validator\Constraints\PossibleValues;
use Symfony\Component\Validator\Constraint;

class MarketTypeValidatorTest extends AbstractTesting
{
    protected Constraint $constraint;
    protected MarketTypeValidator $marketTypeValidatorMock;
    protected PossibleValues $possibleValues;

    protected function setUp(): void
    {
        $this->constraint = $this->getMockBuilder(Constraint::class)->getMock();
        $this->possibleValues = $this->createMock(PossibleValues::class);
        $this->marketTypeValidatorMock = $this->getMockBuilder(MarketTypeValidator::class)
            ->onlyMethods(['makeViolation'])
            ->setConstructorArgs([$this->possibleValues])
            ->getMock();
    }

    public function testValidateCorrectlyValue()
    {
        $this->possibleValues->method('getPossibleValues')->willReturn(['ONEXTWO' => '1x2', 'CORRECT_SCORE' => 'correct_score']);
        $marketValidate = new MarketTypeValidator($this->possibleValues);
        $this->assertEquals(true, $marketValidate->validate("correct_score", $this->constraint));
    }

    public function testValidateEmptyValue()
    {
        $this->possibleValues->method('getPossibleValues')->willReturn(['ONEXTWO' => '1x2', 'CORRECT_SCORE' => 'correct_score']);
        $marketValidate = new MarketTypeValidator($this->possibleValues);
        $this->assertEquals(false, $marketValidate->validate("", $this->constraint));
    }

    public function testValidateNotStringValueValue()
    {
        $this->possibleValues->method('getPossibleValues')->willReturn(['ONEXTWO' => '1x2', 'CORRECT_SCORE' => 'correct_score']);
        $marketValidate = new MarketTypeValidator($this->possibleValues);
        $this->expectException(\UnexpectedValueException::class);
        $marketValidate->validate([], $this->constraint);
    }

    public function testValidateWrongValueValue()
    {
        $this->possibleValues->method('getPossibleValues')->willReturn(['ONEXTWO' => '1x2', 'CORRECT_SCORE' => 'correct_score']);
        $this->marketTypeValidatorMock->expects($this->once())->method('makeViolation');
        $this->assertEquals(false, $this->marketTypeValidatorMock->validate("aaaa", $this->constraint));
    }
}
