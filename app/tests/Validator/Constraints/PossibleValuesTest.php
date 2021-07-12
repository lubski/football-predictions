<?php

namespace App\Tests\Validator\Constraints;

use App\Tests\AbstractTesting;
use App\Validator\Constraints\MarketTypeInterface;
use App\Validator\Constraints\PossibleValues;

class PossibleValuesTest extends AbstractTesting
{
    private PossibleValues $possibleValues;

    protected function setUp(): void
    {
        $this->possibleValues = new PossibleValues();
    }


    public function testGetPossibleValuesAsString()
    {
        $this->assertEquals(['ONEXTWO' => '1x2', 'CORRECT_SCORE' => 'correct_score'], $this->possibleValues->getPossibleValues(MarketTypeInterface::class));
    }

    public function testGetPossibleValues()
    {
        $this->assertEquals('1x2, correct_score', $this->possibleValues->getPossibleValuesAsString(MarketTypeInterface::class));
    }
}
