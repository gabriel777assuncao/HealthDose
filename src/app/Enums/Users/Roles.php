<?php

namespace App\Enums\Users;

use ArchTech\Enums\{InvokableCases, Values};

enum Roles: string
{
    use InvokableCases;
    use Values;

    case ADMIN = 'admin';
    case USER = 'user';
}
