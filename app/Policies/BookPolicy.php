<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Book;

class BookPolicy
{
    /**
     * Determine if the user is an admin.
     */
    private function isAdmin(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Only admin can create a book.
     */
    public function create(User $user): bool
    {
        return $this->isAdmin($user);
    }

    /**
     * Only admin can update a book.
     */
    public function update(User $user, Book $book): bool
    {
        return $this->isAdmin($user);
    }

    /**
     * Only admin can delete a book.
     */
    public function delete(User $user, Book $book): bool
    {
        return $this->isAdmin($user);
    }

    /**
     * Only admin can attach tags.
     */
    public function attachTags(User $user): bool
    {
        return $this->isAdmin($user);
    }

    /**
     * Only admin can detach tags.
     */
    public function detachTags(User $user): bool
    {
        return $this->isAdmin($user);
    }
}
