<?php

namespace App\Tests\Validator\Constraints;

use App\Tests\AbstractTesting;
use App\Validator\Constraints\PossibleValues;
use App\Validator\Constraints\StatusValidator;
use Symfony\Component\Validator\Constraint;

class StatusValidatorTest extends AbstractTesting
{
    protected Constraint $constraint;
    protected PossibleValues $possibleValues;

    protected function setUp(): void
    {
        $this->constraint = $this->getMockBuilder(Constraint::class)->getMock();
        $this->possibleValues = $this->createMock(PossibleValues::class);
        $this->possibleValues->method('getPossibleValues')->willReturn([
            'WIN' => 'win',
            'LOST' => 'lost',
            'UNRESOLVED' => 'unresolved'
        ]);
    }

    public function testValidateCorrectValue()
    {
        $marketValidate = new StatusValidator($this->possibleValues);
        $this->assertEquals(true, $marketValidate->validate("lost", $this->constraint));
    }

    public function testValidateEmptyValue()
    {
        $marketValidate = new StatusValidator($this->possibleValues);
        $this->assertEquals(false, $marketValidate->validate("", $this->constraint));
    }

    public function testValidateNotStringValue()
    {
        $this->expectException(\UnexpectedValueException::class);
        $marketValidate = new StatusValidator($this->possibleValues);
        $marketValidate->validate([], $this->constraint);
    }
}
