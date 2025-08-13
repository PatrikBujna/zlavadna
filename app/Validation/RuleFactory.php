<?php

namespace App\Validation;

use Illuminate\Validation\Rules\Unique;

class RuleFactory
{
    public function unique(string $table, string $column, ?int $ignoreId = null): Unique
    {
        $rule = new Unique($table, $column);
        if ($ignoreId !== null) {
            $rule = $rule->ignore($ignoreId);
        }

        return $rule;
    }
}
