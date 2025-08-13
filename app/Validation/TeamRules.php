<?php

namespace App\Validation;

class TeamRules
{
    /** @return array<string,mixed> */
    public static function create(): array
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }

    /** @return array<string,mixed> */
    public static function update(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
        ];
    }
}
