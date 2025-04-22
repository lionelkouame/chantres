<?php
namespace App\Tests\TestCi;

use PHPUnit\Framework\TestCase;
use App\TestCi\WantToTestPhpUnit;

class WantToTestPhpUnitTest extends TestCase
{
    public function testIndexToTestBool()
    {
        $instance = new WantToTestPhpUnit();
        $result = $instance->indexToTestBool();

        $this->assertTrue($result, 'The method indexToTestBool should return true.');
    }
}
