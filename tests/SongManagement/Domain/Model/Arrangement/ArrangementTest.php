<?php

declare(strict_types=1);

namespace App\Tests\SongManagement\Domain\Model\Arrangement;

use App\SongManagement\Domain\Model\Arrangement\Arrangement;
use App\SongManagement\Domain\Model\Arrangement\ArrangementId;
use PHPUnit\Framework\TestCase;

final class ArrangementTest extends TestCase
{
    private const string UUID = '6ba7b810-9dad-11d1-80b4-00c04fd430ca';

    public function testItExposesArrangementId(): void
    {
        $id = ArrangementId::fromString(self::UUID);
        $arrangement = Arrangement::create($id);

        self::assertSame($id, $arrangement->arrangementId());
    }
}
