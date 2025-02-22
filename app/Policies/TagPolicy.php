<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Tag;

class TagPolicy
{
    private function isAdmin(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function create(User $user): bool
    {
        return $this->isAdmin($user);
    }

    public function update(User $user, Tag $tag): bool
    {
        return $this->isAdmin($user);
    }

    public function delete(User $user, Tag $tag): bool
    {
        return $this->isAdmin($user);
    }
}
