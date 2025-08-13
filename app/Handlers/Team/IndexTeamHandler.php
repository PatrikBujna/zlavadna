<?php

namespace App\Handlers\Team;

use App\Factories\TeamFactory;
use Illuminate\Http\JsonResponse;

class IndexTeamHandler
{
    public function __construct(private TeamFactory $factory)
    {}

    public function __invoke(): JsonResponse
    {
        return response()->json($this->factory->getAll());
    }
}
