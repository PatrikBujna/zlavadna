<?php

namespace App\Handlers\User;

use App\Factories\UserFactory;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Validation\UserRules;
use Illuminate\Contracts\Validation\Factory as ValidatorFactory;

class UpdateUserHandler
{
    public function __construct(
        private UserFactory $factory,
        private ValidatorFactory $validator,
        private UserRules $rules,
    ) {
    }

    public function __invoke(User $user, array $payload): JsonResponse
    {
        $validator = $this->validator->make($payload, $this->rules->updateRules($user->id));

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $updated = $this->factory->update($user, $validator->validated());
        
        return response()->json($updated);
    }
}
