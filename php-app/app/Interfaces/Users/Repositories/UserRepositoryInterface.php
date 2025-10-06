<?php

namespace App\Interfaces\Users\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function all(): Collection;
    public function findById(int $id);
    public function store(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}