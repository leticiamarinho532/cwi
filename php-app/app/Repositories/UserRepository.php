<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\Users\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection<User>
     */
    public function all(): Collection
    {
        return User::all();
    }

    /**
     * @param int $id
     * @return \App\Models\User|null
     */
    public function findById(int $id)
    {
        return User::find($id);
    }

    /**
     * @param array $data
     * @return \App\Models\User
     */
    public function store(array $data)
    {
        return User::create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return \App\Models\User|null
     */
    public function update(int $id, array $data)
    {
        $user = User::find($id);

        if ($user) {
            $user->update($data);
            return $user;
        }

        return null;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        $user = User::find($id);

        if ($user) {
            return $user->delete();
        }

        return false;
    }
}
