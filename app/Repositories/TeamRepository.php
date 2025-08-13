<?php

namespace App\Repositories;

use App\Models\Team;

class TeamRepository
{
    public function __construct(private Team $model)
    {}

    /** @return \Illuminate\Support\Collection<int,Team> */
    public function all()
    {
        return $this->model->newQuery()->get();
    }

}
