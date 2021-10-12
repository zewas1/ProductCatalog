<?php

declare(strict_types=1);

namespace App\Modifier\User;

use App\Entity\User;

class UserModifier
{
    public function modify(User $user, string $newPassword, array $roles): User
    {
        $user->setPassword($newPassword);
        $user->setRoles($roles);

        return $user;
    }
}
