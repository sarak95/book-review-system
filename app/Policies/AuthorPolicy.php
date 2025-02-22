<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Author;

class AuthorPolicy
{
    private function isAdmin(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function create(User $user): bool
    {
        return $this->isAdmin($user);
    }

    public function update(User $user, Author $author): bool
    {
        return $this->isAdmin($user);
    }

    public function delete(User $user, Author $author): bool
    {
        return $this->isAdmin($user);
    }
}
