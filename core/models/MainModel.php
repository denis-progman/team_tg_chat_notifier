<?php

namespace models;

class MainModel
{
    protected function toCamelCase(string $string): string
    {
        return lcfirst(str_replace('_', '', ucwords($string, '_')));
    }

    public function get(): static
    {
        return $this;
    }
}