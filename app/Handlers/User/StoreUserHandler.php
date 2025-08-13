<?php

namespace App\Handlers\User;

use App\Factories\UserFactory;
use Illuminate\Http\JsonResponse;
use App\Validation\UserRules;
use Illuminate\Contracts\Validation\Factory as ValidatorFactory;

class StoreUserHandler
{
    public function __construct(
        private UserFactory $factory,
        private ValidatorFactory $validator,
        private UserRules $rules
    ) {
    }

    public function __invoke(array $payload): JsonResponse
    {
        $validator = $this->validator->make($payload, $this->rules->createRules());

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = $this->factory->create($validator->validated());
        
        return response()->json($user, 201);
    }
}
