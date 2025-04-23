<?php

namespace App\Tests\TestCi;

use App\TestCi\WantToTestPhpUnit;
use PHPUnit\Framework\TestCase;

class WantToTestPhpUnitTest extends TestCase
{
    public function testIndexToTestBool()
    {
        $instance = new WantToTestPhpUnit();
        $result = $instance->indexToTestBool();

        $this->assertTrue($result, 'The method indexToTestBool should return true.');
    }
}
