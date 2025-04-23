<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $config): void {
    $config->paths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    $config->sets([
        SetList::DEAD_CODE,
        SetList::CODE_QUALITY,
        SetList::PHP_83,
    ]);
};
