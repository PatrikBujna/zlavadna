<?php
namespace App\Factories;

use App\Repositories\TeamRepository;

class TeamFactory
{
    public function __construct(private TeamRepository $repository) {}

    /** Return all teams */
    public function getAll(): array
    {
        return $this->repository->all()->all();
    }
}