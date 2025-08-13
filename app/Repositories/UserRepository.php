<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function __construct(private User $model)
    {}

    public function create(array $data): User
    {
        return $this->model->newQuery()->create($data);
    }

    public function update(User $user, array $data): User
    {
        $user->update($data);
        
        return $user;
    }

    public function find(int $id): ?User
    {
        return $this->model->newQuery()->find($id);
    }

    public function all()
    {
        return $this->model->newQuery()->get();
    }

    public function delete(User $user): void
    {
        $user->delete();
    }
}
