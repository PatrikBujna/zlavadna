<?php

namespace App\Handlers\User;

use App\Factories\UserFactory;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class DestroyUserHandler
{
    public function __construct(private UserFactory $factory)
    {
    }

    public function __invoke(User $user): JsonResponse
    {
        $deleted = $this->factory->delete($user);
        if ($deleted) {
            return response()->json(null, 204);
        }
        
        return response()->json([
            'message' => 'User could not be deleted.'
        ], 400);
    }
}
