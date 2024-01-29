<?php

namespace services;

use models\Rule;

class RuleService
{
    public static function  getRules(): array
    {
        $rules = [];
        $ruleFiles = glob(RULES_FOLDER . '*.json');
        foreach ($ruleFiles as $ruleFile) {
            $rules[] = new Rule($ruleFile);
        }
        return $rules;
    }
}