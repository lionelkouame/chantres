<?php

declare(strict_types=1);

namespace App\Shared\Domain;

enum Gender: string
{
    case MALE = 'male';
    case FEMALE = 'female';
    case OTHER = 'other';
}
