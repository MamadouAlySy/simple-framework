<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Entities\User;
use MamadouAlySy\SimpleFramework\Repository;

class UserRepository extends Repository
{
    protected string $table = 'users';
    protected string $entity = User::class;
}