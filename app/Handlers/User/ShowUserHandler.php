<?php

namespace App\Handlers\User;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class ShowUserHandler
{
    public function __invoke(User $user): JsonResponse
    {
        return response()->json($user);
    }
}
