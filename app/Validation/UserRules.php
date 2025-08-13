<?php

namespace App\Validation;

class UserRules
{
    public function __construct(private RuleFactory $rules)
    {}

    /** Instance method: rules for creating a user */
    public function createRules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => ['required','string','max:255','email', $this->rules->unique('users','email')],
            'password' => 'required|string|min:6',
            'team_ids' => 'sometimes|array',
            'team_ids.*' => 'integer|exists:teams,id',
        ];
    }

    /** Instance method: rules for updating a user */
    public function updateRules(?int $userId = null): array
    {
    $emailRule = [$this->rules->unique('users','email', $userId)];

        return [
            'name' => 'sometimes|required|string|max:255',
            'email' => ['sometimes','required','string','max:255','email', ...$emailRule],
            'password' => 'sometimes|nullable|string|min:6',
            'team_ids' => 'sometimes|array',
            'team_ids.*' => 'integer|exists:teams,id',
        ];
    }
}
