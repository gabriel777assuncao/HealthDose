<?php

namespace App\Enums\Users;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Values;

enum Roles: string
{
    use InvokableCases;
    use Values;

    case ADMIN = 'admin';
    case USER = 'user';
}
