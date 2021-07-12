<?php

namespace App\Tests\Entity;

use App\Entity\Prediction;
use PHPUnit\Framework\TestCase;

class PredictionTest extends TestCase
{

    private Prediction $prediction;
    protected function setUp(): void
    {
        $this->prediction = new Prediction();
    }

    public function testSetMarketType()
    {
        $this->prediction->setMarketType('1x2');
        $this->assertEquals("1x2", $this->prediction->getMarketType());
    }

    public function testGetPrediction()
    {
        $this->prediction->setMarketType('1');
        $this->assertEquals("1", $this->prediction->getMarketType());
    }

    public function testGetCreatedAt()
    {
        $this->prediction->setCreatedAt(new \DateTimeImmutable());
        $this->assertInstanceOf(\DateTimeImmutable::class, $this->prediction->getCreatedAt());
    }

    public function testSetUpdatedAt()
    {
        $this->prediction->setUpdatedAt(new \DateTime());
        $this->assertInstanceOf(\DateTime::class, $this->prediction->getUpdatedAt());
    }

    public function testGetEventId()
    {
        $this->prediction->setEventId(2);
        $this->assertEquals(2, $this->prediction->getEventId());
    }

    public function testGetMarketType()
    {
        $this->prediction->setMarketType("1x2");
        $this->assertEquals("1x2", $this->prediction->getMarketType());
    }

    public function testGetStatus()
    {
        $this->prediction->setStatus('won');
        $this->assertEquals("won", $this->prediction->getStatus());
    }

    public function testGetUpdatedAt()
    {
        $this->assertInstanceOf(\DateTime::class, $this->prediction->getUpdatedAt());
    }

    public function testGetId()
    {
        $this->assertEquals(null, $this->prediction->getId());
    }

    public function testSetStatus()
    {
        $this->prediction->setStatus('won');
        $this->assertEquals("won", $this->prediction->getStatus());
    }

    public function test__construct()
    {
        $this->assertInstanceOf(Prediction::class, new Prediction());
    }

    public function testSetPrediction()
    {
        $this->prediction->setPrediction('2');
        $this->assertEquals("2", $this->prediction->getPrediction());
    }

    public function testSetCreatedAt()
    {
        $this->prediction->setCreatedAt(new \DateTimeImmutable());
        $this->assertInstanceOf(\DateTimeImmutable::class, $this->prediction->getCreatedAt());
    }

    public function testSetEventId()
    {
        $this->prediction->setEventId(2);
        $this->assertEquals(2, $this->prediction->getEventId());
    }
}
