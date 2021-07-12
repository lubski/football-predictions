<?php

namespace App\Tests\DBAL;

use App\DBAL\EnumType;
use App\Tests\AbstractTesting;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class EnumTypeTest extends AbstractTesting
{
    private $enumAbstractMock;
    private $abstractPlatform;
    protected function setUp():void
    {
        $this->enumAbstractMock = $this->getMockForAbstractClass(EnumType::class);
        $this->abstractPlatform = $this->getMockBuilder(AbstractPlatform::class)->getMock();
    }

    public function testGetSQLDeclarationWithValue()
    {
        $this->setProtectedProperty($this->enumAbstractMock, 'name', 'Test1');
        $this->assertEquals('Test1', $this->enumAbstractMock->getSQLDeclaration([],$this->abstractPlatform));
    }

    public function testGetSQLDeclarationReturnNull()
    {
        $this->assertEquals(null, $this->enumAbstractMock->getSQLDeclaration([],$this->abstractPlatform));
    }

    public function testGetSQLDeclarationException()
    {
        $this->expectException(\TypeError::class);
        $this->assertEquals(null, $this->enumAbstractMock->getSQLDeclaration("",$this->abstractPlatform));
    }

    public function testGetNameWithValue()
    {
        $this->setProtectedProperty($this->enumAbstractMock, 'name', 'Test2');
        $this->assertEquals('Test2', $this->enumAbstractMock->getName());
    }

    public function testGetNameReturnNull()
    {
        $this->assertEquals(null, $this->enumAbstractMock->getName());
    }

    public function testConvertToDatabaseValueCorrectValue()
    {
        $this->assertEquals('Test3', $this->enumAbstractMock->convertToDatabaseValue("Test3", $this->abstractPlatform));
    }

    public function testConvertToDatabaseValueExpectedException()
    {
        $this->expectException(\TypeError::class);
        $this->assertEquals('Test3', $this->enumAbstractMock->convertToDatabaseValue("Test3", null));
    }

    public function testConvertToPHPValueCorrectValue()
    {
        $this->assertEquals('Test4', $this->enumAbstractMock->convertToPHPValue("Test4", $this->abstractPlatform));
    }

    public function testConvertToPHPValueExpectedException()
    {
        $this->expectException(\TypeError::class);
        $this->assertEquals('Test4', $this->enumAbstractMock->convertToPHPValue("Test4", null));
    }

    public function testRequiresSQLCommentHint()
    {
        $this->assertIsBool(true , $this->enumAbstractMock->requiresSQLCommentHint($this->abstractPlatform));
    }

    public function testRequiresSQLCommentHintExpectedException()
    {
        $this->expectException(\TypeError::class);
        $this->assertIsBool(true , $this->enumAbstractMock->requiresSQLCommentHint(null));
    }
}
