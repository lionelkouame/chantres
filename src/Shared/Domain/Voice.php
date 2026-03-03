<?php

declare(strict_types=1);

namespace App\Shared\Domain;

enum Voice: string
{
    case SOPRANO = 'soprano';
    case ALTO = 'alto';
    case TENOR = 'tenor';
    case BASS = 'bass';
    case BAROTONE = 'baritone';
}
