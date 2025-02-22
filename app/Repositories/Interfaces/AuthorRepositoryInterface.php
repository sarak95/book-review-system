<?php

namespace App\Repositories\Interfaces;

interface AuthorRepositoryInterface
{

    public function findById($id);

    public function all();

    public function create(array $data);

    public function update($author, array $data);

    public function delete($author);
}
