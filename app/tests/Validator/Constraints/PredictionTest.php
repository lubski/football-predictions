<?php

namespace App\Tests\Validator\Constraints;

use App\Tests\AbstractTesting;
use App\Validator\Constraints\Prediction;

class PredictionTest extends AbstractTesting
{

    public function testGetTargets()
    {
        $this->assertNotEmpty((new Prediction())->getTargets());
    }
}
