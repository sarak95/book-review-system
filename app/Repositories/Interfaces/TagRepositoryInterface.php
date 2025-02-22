<?php

namespace App\Repositories\Interfaces;

interface TagRepositoryInterface
{
    public function findById($id);
    
    public function all();

    public function create(array $data);

    public function update($tag, array $data);

    public function delete($tag);
}
