<?php

namespace App\Factories;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Hashing\Hasher;

class UserFactory
{
    public function __construct(
        private Hasher $hasher,
        private UserRepository $repository,
    ) {}

    /** Create a new user from validated data */
    public function create(array $data): User
    {
        $data = $this->hashPassword($data);
        $teamIds = null;
        if (array_key_exists('team_ids', $data)) {
            $teamIds = $data['team_ids'];
            unset($data['team_ids']);
        }

        $user = $this->repository->create($data);
        if (is_array($teamIds)) {
            $user->teams()->sync($teamIds);
        }

        return $user->refresh();
    }

    /** Update an existing user. */
    public function update(User $user, array $data): User
    {
        $data = $this->hashPassword($data);
        $teamIds = null;
        if (array_key_exists('team_ids', $data)) {
            $teamIds = $data['team_ids'];
            unset($data['team_ids']);
        }

        $this->repository->update($user, $data);
        if (is_array($teamIds)) {
            $user->teams()->sync($teamIds);
        }

        return $user->refresh();
    }

    /** Return all users */
    public function getAll(): array
    {
        return $this->repository->all()->all();
    }

    /** Return all users with their teams eager-loaded */
    public function getAllWithTeams(): array
    {
        return $this->repository->all()->load('teams')->all();
    }

    /** Delete a user */
    public function delete(User $user): bool
    {
        $this->repository->delete($user);

        return true;
    }

    /**
     * Hash password if present.
     *
     * @param array<string,mixed> $data
     * @return array<string,mixed>
     */
    private function hashPassword(array $data): array
    {
        if (array_key_exists('password', $data)) {
            $pwd = $data['password'];
            if ($pwd === null || $pwd === '') {
                unset($data['password']);
                
                return $data;
            } 
            $data['password'] = $this->hasher->make((string) $pwd);
        }

        return $data;
    }
}
