<?php

namespace App\Handlers\User;

use App\Factories\UserFactory;
use Illuminate\Http\JsonResponse;

class IndexUserHandler
{
    public function __construct(private UserFactory $factory)
    {
    }

    public function __invoke(): JsonResponse
    {
        return response()->json($this->factory->getAll());
    }
}
